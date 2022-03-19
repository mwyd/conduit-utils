<?php

require_once __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\HasConduitSteamMarketCsgoItems;
use ConduitUtils\Api\HasSteamMarketItems;
use ConduitUtils\Resources\DopplerKnife;
use ConduitUtils\Resources\DopplerWeapon;
use Dotenv\Dotenv;
use pSockets\Utils\Logger;

class SdAgent
{
    use HasConduitSteamMarketCsgoItems, HasSteamMarketItems;

    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger($_ENV['LOG_LEVEL']);
    }

    public function run() : void
    {
        $this->fetchWeapons();
        $this->fetchKnives();
    }

    private function fetchWeapons() : void
    {
        foreach(DopplerWeapon::$icons as $name => $icons)
        {
            $this->handleDoppler($name, $icons);
        }
    }

    private function fetchKnives() : void
    {
        $stattraks = DopplerKnife::$hasStattrak ? ['★', '★ StatTrak™'] : ['★'];

        foreach(DopplerKnife::$icons as $name => $icons)
        {
            foreach(DopplerKnife::$exteriors as $exterior)
            {
                foreach($stattraks as $prefix)
                {
                    $this->handleDoppler(str_replace('★', $prefix, $name) . ' ' . $exterior, $icons);
                }
            }
        }
    }

    private function handleDoppler(string $hashName, array $icons) : void
    {
        $this->logger->log("Fetching {$hashName}");

        $items = [];
        $itemsProcessed = 0;

        for($i = 0; $i < $_ENV['DOPPLER_PAGE_LIMIT']; $i++)
        {
            try
            {
                $res = $this->getSteamMarketItemListings($hashName, '730', [
                    'query'         => '',
                    'start'         => $itemsProcessed,
                    'count'         => $_ENV['DOPPLER_PER_PAGE'],
                    'currency'      => 1,
                    'language'      => 'english'
                ], true);

                $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

                if(!$resJson->success)
                {
                    sleep($_ENV['REQUEST_DELAY_SMALL']);
                    $i--;

                    continue;
                }

                $listings = (array) $resJson->listinginfo;

                if(count($listings))
                {
                    foreach($listings as $listing)
                    {
                        $items[$listing->asset->id] = [
                            'price' => (($listing->converted_price ?? 0) + ($listing->converted_fee ?? 0)) / 100
                        ];
                    }

                    foreach($resJson->assets->{'730'}->{'2'} as $asset)
                    {
                        $items[$asset->id]['icon'] = $asset->icon_url;
                        $items[$asset->id]['icon_large'] = $asset->icon_url_large;
                        $items[$asset->id]['name_color'] = "#{$asset->name_color}";
                        $items[$asset->id]['type'] = $asset->type;
                        $items[$asset->id]['collection'] = get_steam_market_item_collection($asset->descriptions);
                    }
                }

                $itemsProcessed += count($listings);

                $this->logger->log("Got {$itemsProcessed} of " . $_ENV['DOPPLER_PAGE_LIMIT'] * $_ENV['DOPPLER_PER_PAGE'] . " items", 1);

                if($itemsProcessed >= $resJson->total_count) break;
            }
            catch(\Exception $e)
            {
                Logger::warn($e->getMessage() . ': ' . $e->getCode());

                if($e->getCode() == 429 || $e->getCode() == 403)
                {
                    sleep($_ENV['REQUEST_DELAY']);
                    $i--;
                }
            }
        }

        usort($items, fn($a, $b) => $a['price'] - $b['price']);

        $groupedItems = array_reduce($items, function($carry, $item) use ($hashName, $icons) {
            $index = array_find_index($carry, fn($v) => $v['icon'] == $item['icon']);

            if($index == -1)
            {
                $carry[] = $item + [
                    'hash_name'     => $hashName,
                    'volume'        => 1,
                    'phase'         => $icons[$item['icon']] ?? $icons[$item['icon_large']] ?? null
                ];
            }
            else $carry[$index]['volume']++;

            return $carry;
        }, []);

        foreach(array_filter($groupedItems, fn($item) => $item['phase'] != null) as $item)
        {
            $item['hash_name'] = format_hash_name($item['hash_name'], $item['phase']);

            $this->upsertConduitSteamMarketCsgoItem($item);
        }
    }
}

try
{
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $smAgent = new SdAgent();
    $smAgent->run();
}
catch(\Exception $e)
{
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}