<?php

require_once __DIR__ . "/vendor/autoload.php";

use GuzzleHttp\Client;
use pSockets\WebSocket\WsClient;
use pSockets\WebSocket\WsMessage;
use pSockets\Utils\Logger;

class SpAgent extends WsClient
{
    const CONDUIT_API_URL   = 'http://localhost:8000/api';
    const SHADOWPAY_API_URL = 'https://api.shadowpay.com/api/market';

    const CONDUIT_API_TOKEN = 'qcIvRZIx5nM8o1Z0';

    protected function onOpen() : void
    {
	    
    }

    protected function onMessage(WsMessage $message) : void
    {
        try
        {
            $msg = $message->json();

	        switch($msg->type)
            {
            	case 'live_items':
                    foreach($msg->data as $item) $this->saveItem($item);
                    break;
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    }

    protected function onClose() : void
    {

    }

    private function saveItem(object $item) : void
    {
        try
        {
            $item = $this->buildSchema($item);
    
            $client = new Client();
            $client->request('POST', self::CONDUIT_API_URL . "/shadowpay-sold-items", [
                'headers' => [
                    'Token' => self::CONDUIT_API_TOKEN,
                    'Accept' => 'application/json'
                ],
                'form_params' => (array) $item
            ]);  
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
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
        $schema->sell_price = $this->getShadowpayPrice($hashName, $item->is_stattrak);
        $schema->steam_price = $this->getSteamPrice($hashName);
        $schema->discount = $item->discount_percent ?? 0;
        $schema->sold_at = $item->time_created;
    
        return $schema;
    }

    private function getSteamPrice(string $hashName) : ?int
    {
        $price = null;
    
        try
        {
            $client = new Client();
            $res = $client->request('GET', self::CONDUIT_API_URL . "/steam-market-csgo-items/{$hashName}", [
                'headers' => [
                    'Token' => self::CONDUIT_API_TOKEN,
                    'Accept' => 'application/json'
                ]
            ]);
    
            $resJson = json_decode($res->getBody());
            $price = $resJson->data->price;
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    
        return $price;
    }

    private function getShadowpayPrice(string $hashName, bool $isStattrak) : ?int
    {
        $price = null;
    
        try
        {
            $client = new Client();
            $res = $client->request('GET', self::SHADOWPAY_API_URL . "/get_items", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Origin' => 'https://shadowpay.com'
                ],
                'query' => [
                    'price_from' => 0,
                    'price_to' => 20000,
                    'game' => 'csgo',
                    'currency' => 'USD',
                    'sort_column' => 'price_rate',
                    'sort_dir' => 'desc',
                    'search' => $hashName,
                    'stack' => false,
                    'limit' => 50,
                    'offset' => 0
                ]
            ]);
    
            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
    
            if($resJson->status == 'success')
            {
                foreach($resJson->items as $item)
                {
                    if($item->is_stattrak == $isStattrak)
                    {
                        $price = floatval($item->price_real) * 100;
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

while(true)
{
    $ws = new SpAgent("wss://ws.shadowpay.com/websocket", [
    	'LOG_LEVEL'             => 1,
    	'ADDITIONAL_HEADERS'    => [
            'Origin: https://shadowpay.com'
    	]
    ]);
    $ws->run();

    sleep(60);
}
