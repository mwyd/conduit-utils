<?php

require_once __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\HasConduitSteamMarketCsgoItems;
use ConduitUtils\Api\HasSteamMarketItems;
use Dotenv\Dotenv;
use pSockets\Utils\Logger;

class SmAgent
{
    use HasConduitSteamMarketCsgoItems, HasSteamMarketItems;

    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger($_ENV['LOG_LEVEL']);
    }

    public function run(): void
    {
        $itemsProcessed = $_ENV['STEAM_ITEMS_START'];

        for ($i = 0; $i < ceil($_ENV['STEAM_ITEMS_LIMIT'] / $_ENV['STEAM_ITEMS_PER_PAGE']); $i++) {
            try {
                $res = $this->getSteamMarketItems([
                    'query' => '',
                    'start' => $itemsProcessed,
                    'count' => $_ENV['STEAM_ITEMS_PER_PAGE'],
                    'search_descriptions' => 0,
                    'sort_column' => 'name',
                    'sort_dir' => 'asc',
                    'appid' => 730,
                    'norender' => 1,
                    'l' => 'english'
                ], true);

                $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

                if (empty($resJson->results) && $resJson->searchdata->total_count == 0) {
                    sleep($_ENV['STEAM_REQUEST_DELAY_SMALL']);
                    $i--;

                    continue;
                }

                foreach ($resJson->results as $item) {
                    if (!$_ENV['STEAM_BASE_DOPPLERS'] && str_contains($item->hash_name, 'Doppler (')) {
                        continue;
                    }

                    $this->upsertConduitSteamMarketCsgoItem([
                        'hash_name' => $item->hash_name,
                        'volume' => $item->sell_listings,
                        'price' => $item->sell_price / 100,
                        'icon' => $item->asset_description->icon_url,
                        'icon_large' => $item->asset_description->icon_url_large ?? null,
                        'name_color' => "#{$item->asset_description->name_color}",
                        'type' => $item->asset_description->type,
                        'collection' => get_steam_market_item_collection($item->asset_description->descriptions ?? [])
                    ]);
                }

                $itemsProcessed += count($resJson->results);

                $this->logger->log("Got {$itemsProcessed} of {$_ENV['STEAM_ITEMS_LIMIT']} items", 1);

                if ($itemsProcessed >= $resJson->searchdata->total_count) {
                    break;
                }
            } catch (\Exception $e) {
                Logger::warn($e->getMessage() . ': ' . $e->getCode());

                if ($e->getCode() == 429 || $e->getCode() == 403) {
                    sleep($_ENV['STEAM_REQUEST_DELAY']);
                    $i--;
                }
            }
        }
    }
}

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $_ENV['STEAM_BASE_DOPPLERS'] = filter_var($_ENV['STEAM_BASE_DOPPLERS'], \FILTER_VALIDATE_BOOLEAN);

    $smAgent = new SmAgent();
    $smAgent->run();
} catch (\Exception $e) {
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}