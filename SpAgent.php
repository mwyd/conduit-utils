<?php

require_once __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\HasConduitShadowpaySoldItems;
use ConduitUtils\Api\HasConduitSteamMarketCsgoItems;
use ConduitUtils\Api\HasShadowpayMarket;
use Dotenv\Dotenv;
use pSockets\WebSocket\WsClient;
use pSockets\WebSocket\WsMessage;
use pSockets\Utils\Logger;

class SpAgent extends WsClient
{
    use HasConduitSteamMarketCsgoItems, HasConduitShadowpaySoldItems, HasShadowpayMarket;

    public function __construct(string $address, array $config)
    {
        parent::__construct($address, $config);
    }

    protected function onClose() : void {}

    protected function onOpen() : void 
    {
        $res = $this->shadowpayIsLogged(true);

        $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

        $this->send(
            json_encode([
                'id' => 1,
                'params' => [
                    'token' => $resJson->wss_token
                ]
            ])
        );
    }

    protected function onMessage(WsMessage $message) : void
    {
        try
        {
            $msg = $message->json();

            if(isset($msg->id))
            {
                switch($msg->id)
                {
                    case 1:
                        $this->send(
                            json_encode([
                                'id' => 2,
                                'method' => 9,
                                'params' => [
                                    'data' => [],
                                    'method' => 'send_first_stat'
                                ]      
                            ])
                        );
                        break;
                }

                return;
            }

            $data = $msg->result->data->data;

            switch($data->type)
            {
                case 'live_items':
                    foreach($data->data as $item)
                    {
                        $this->createConduitShadowpaySoldItem($this->buildSchema($item), true);
                    }
                    break;
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    }

    private function buildSchema(object $item) : array
    {
        $hashName = $item->name;
    
        $hashName .= match($item->shorten_exterior) {
            'FN'        => ' (Factory New)',
            'MW'        => ' (Minimal Wear)',
            'FT'        => ' (Field-Tested)',
            'WW'        => ' (Well-Worn)',
            'BS'        => ' (Battle-Scarred)',
            default     => ''
        };
    
        if($item->is_stattrak)
        {
            $hashName = str_contains($hashName, '★') 
                ? str_replace('★', '★ StatTrak™', $hashName) 
                : 'StatTrak™ ' . $hashName;
        }
    
        $conduitSteamPrice = null;
        $shadowpaySteamPrice = null;

        if(str_contains($item->name, 'Doppler'))
        {
            $doppler = $this->getConduitDoppler($item->name, $item->shorten_exterior, $item->is_stattrak, $item->icon);

            if($doppler)
            {
                $shadowpaySteamPrice = $this->getShadowpaySteamPrice($hashName, $doppler->phase);
                $conduitSteamPrice = $doppler->price;

                $hashName = format_hash_name($hashName, $doppler->phase);
            }
        }
        else
        {
            $shadowpaySteamPrice = $this->getShadowpaySteamPrice($hashName);
            $conduitSteamPrice = $this->getConduitSteamPrice($hashName);
        }

        $schema['transaction_id']   = $item->id;
        $schema['hash_name']        = $hashName;
        $schema['suggested_price']  = $shadowpaySteamPrice;
        $schema['steam_price']      = $conduitSteamPrice;
        $schema['discount']         = $item->discount_percent ?? 0;
        $schema['sold_at']          = $item->time_created;
    
        return $schema;
    }

    private function getConduitSteamPrice(string $hashName) : ?float
    {
        $price = null;
    
        try
        {
            $res = $this->getConduitSteamMarketCsgoItem($hashName, true);
    
            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
            $price = $resJson->data->price;
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    
        return $price;
    }

    private function getShadowpaySteamPrice(string $hashName, ?string $phase = null) : ?float
    {
        $price = null;
    
        try
        {
            $res = $this->getShadowpaySteamItem([
                'token'     => $_ENV['SHADOWPAY_API_TOKEN'],
                'project'   => 'csgo',
                'search'    => $hashName,
                'limit'     => 50
            ], true);
    
            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
    
            if($resJson->status == 'success')
            {
                foreach($resJson->data as $item)
                {
                    if($item->steam_market_hash_name == $hashName && $item->phase == $phase)
                    {
                        $price = $item->suggested_price;
                        break;
                    }
                }
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    
        return $price;
    }

    private function getConduitDoppler(string $name, string $exterior, string $isStattrak, string $icon) : ?object
    {
        $doppler = null;

        try
        {
            $res = $this->getConduitSteamMarketCsgoItems([
                'search'        => $name,
                'exteriors'     => $exterior,
                'is_stattrak'   => $isStattrak
            ], true);
    
            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
            
            foreach($resJson->data as $item)
            {
                if($item->icon == $icon || $item->icon_large == $icon)
                {
                    $doppler = $item;
                    break;
                }
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }

        return $doppler;
    }
}

try
{
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    while(true)
    {
        $ws = new SpAgent($_ENV['SHADOWPAY_WS_URL'], [
            'LOG_LEVEL'             => $_ENV['LOG_LEVEL'],
            'ADDITIONAL_HEADERS'    => [
                'Origin: ' . $_ENV['SHADOWPAY_ORIGIN']
            ]
        ]);
        $ws->run();
    
        sleep($_ENV['SHADOWPAY_RECONNECT_DELAY']);
    }
}
catch(\Exception $e)
{
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}