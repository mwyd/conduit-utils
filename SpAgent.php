<?php

require_once __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use GuzzleHttp\Client as HttpClient;
use pSockets\WebSocket\WsClient;
use pSockets\WebSocket\WsMessage;
use pSockets\Utils\Logger;

class SpAgent extends WsClient
{
    private HttpClient $httpClient;

    public function __construct(string $address, array $config)
    {
        parent::__construct($address, $config);

        $this->httpClient = new HttpClient();
    }

    protected function onClose() : void {}

    protected function onOpen() : void 
    {
        $res = $this->httpClient->get($_ENV['SHADOWPAY_API_URL'] . '/market/is_logged', [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => $_ENV['ORIGIN']
            ]
        ]);

        $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
        $wssToken = $resJson->wss_token;

        $this->send(
            json_encode([
                'id' => 1,
                'params' => [
                    'token' => $wssToken
                ]
            ])
        );
    }

    protected function onMessage(WsMessage $message) : void
    {
        try
        {
            $msg = $message->json();

            $result = $msg->result;
            
            if(!isset($result->data)) return;

	        switch($result->data->data->type)
            {
            	case 'live_items':
                    foreach($result->data->data->data as $item) $this->saveItem($item);
                    break;
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    }

    private function saveItem(object $item) : void
    {
        $this->httpClient->post($_ENV['CONDUIT_API_URL'] . '/v1/shadowpay-sold-items', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => (array) $this->buildSchema($item)
        ]);
    }

    private function buildSchema(object $item) : object
    {
        $hashName = $item->name;
    
        $hashName .= match($item->shorten_exterior) {
            'FN' => ' (Factory New)',
            'MW' => ' (Minimal Wear)',
            'FT' => ' (Field-Tested)',
            'WW' => ' (Well-Worn)',
            'BS' => ' (Battle-Scarred)',
            default => ''
        };
    
        if($item->is_stattrak)
        {
            $hashName = str_contains($hashName, '★') ? str_replace('★', '★ StatTrak™', $hashName) : 'StatTrak™ ' . $hashName;
        }
    
        $schema = new stdClass;
        $schema->transaction_id = $item->id;
        $schema->hash_name = $hashName;
        $schema->suggested_price = $this->getShadowpayPrice($hashName);
        $schema->steam_price = $this->getSteamPrice($hashName);
        $schema->discount = $item->discount_percent ?? 0;
        $schema->sold_at = $item->time_created;
    
        return $schema;
    }

    private function getSteamPrice(string $hashName) : ?float
    {
        $price = null;
    
        try
        {
            $res = $this->httpClient->get($_ENV['CONDUIT_API_URL'] . "/v1/steam-market-csgo-items/{$hashName}", [
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
    
            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
            $price = $resJson->data->price;
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    
        return $price;
    }

    private function getShadowpayPrice(string $hashName) : ?float
    {
        $price = null;
    
        try
        {
            $res = $this->httpClient->get($_ENV['SHADOWPAY_API_URL'] . '/v2/user/items/steam', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Origin' => $_ENV['ORIGIN']
                ],
                'query' => [
                    'token' => $_ENV['SHADOWPAY_API_TOKEN'],
                    'project' => 'csgo',
                    'search' => $hashName,
                    'limit' => 50
                ]
            ]);
    
            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
    
            if($resJson->status == 'success')
            {
                foreach($resJson->data as $item)
                {
                    if($item->steam_market_hash_name == $hashName)
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
                'Origin: ' . $_ENV['ORIGIN']
            ]
        ]);
        $ws->run();
    
        sleep($_ENV['RECONNECT_DELAY']);
    }
}
catch(\Exception $e)
{
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}