<?php

require_once __DIR__ . "/vendor/autoload.php";

use GuzzleHttp\Client;
use pSockets\Utils\Logger;

$steamMarketApiUrl = 'https://steamcommunity.com/market/search/render/';

$pdo = new PDO('mysql:dbname=conduit;host=127.0.0.1', 'root', '');
$logger = new Logger(0);

$itemsLimit = 20000;
$perPage = 100;
$requestDelay = 60;
$itemsProcessed = 0;

for($i = 0; $i < ceil($itemsLimit / $perPage); $i++)
{
    try
    {
        $client = new Client();
        $res = $client->request('GET', $steamMarketApiUrl, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => [
                'query' => '',
                'start' => $i * $perPage,
                'count' => $perPage,
                'search_descriptions' => 0,
                'sort_column' => 'name',
                'sort_dir' => 'asc',
                'appid' => 730,
                'norender' => 1
            ]
        ]);

        $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
        
        if(empty($resJson->results))
        {
            if($resJson->searchdata->total_count != 0) break;
            else throw new \Exception('Too Many Requests', 429);
        }

        foreach($resJson->results as $item)
        {
            $stm = $pdo->prepare("select count(hash_name) as `exists` from steam_market_csgo_items where hash_name like :hash_name");
            $stm->bindValue(':hash_name', $item->hash_name, PDO::PARAM_STR);
            $stm->execute();
            
            $dbRes = $stm->fetch(PDO::FETCH_ASSOC);

            if($dbRes['exists'] == 0)
            {
                $stm = $pdo->prepare("insert into steam_market_csgo_items values(:hash_name, :volume, :price, :icon, :created_at, :updated_at)");
                $stm->bindValue(':hash_name', $item->hash_name, PDO::PARAM_STR);
                $stm->bindValue(':volume', $item->sell_listings, PDO::PARAM_INT);
                $stm->bindValue(':price', $item->sell_price / 100, PDO::PARAM_STR);
                $stm->bindValue(':icon', $item->asset_description->icon_url, PDO::PARAM_STR);
                $stm->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
		        $stm->bindValue(':updated_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                $stm->execute();
            }
            else
            {
                $stm = $pdo->prepare("update steam_market_csgo_items set price = :price, volume = :volume, updated_at = :updated_at where hash_name like :hash_name");
                $stm->bindValue(':hash_name', $item->hash_name, PDO::PARAM_STR);
                $stm->bindValue(':volume', $item->sell_listings, PDO::PARAM_INT);
                $stm->bindValue(':price', $item->sell_price / 100, PDO::PARAM_STR);
                $stm->bindValue(':updated_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                $stm->execute();
            }
        }

        $itemsProcessed += count($resJson->results);
        
        $logger->log("Got {$itemsProcessed} of {$itemsLimit} items");
    }
    catch(\Exception $e)
    {
        Logger::warn("[{$e->getCode()}] {$e->getMessage()}");
        sleep($requestDelay);
        $i--;
    }
}