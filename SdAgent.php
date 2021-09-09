<?php

require_once __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\HasSteamMarketCsgoItems;
use ConduitUtils\Resources\Doppler;
use Dotenv\Dotenv;
use GuzzleHttp\Client as HttpClient;
use pSockets\Utils\Logger;

class SdAgend
{
    use HasSteamMarketCsgoItems;

    private HttpClient $httpClient;
    private Logger $logger;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
        $this->logger = new Logger($_ENV['LOG_LEVEL']);
    }

    public function run() : void
    {
        $stattraks = Doppler::$hasStattrak ? ['★', '★ StatTrak™'] : ['★'];

        foreach(Doppler::$icons as $name => $icons)
        {
            foreach(Doppler::$exteriors as $exterior)
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
                $res = $this->httpClient->get($_ENV['STEAM_MARKET_API_URL'] . "/listings/730/{$hashName}/render/", [
                    'headers' => [
                        'Accept' => 'application/json'
                    ],
                    'query' => [
                        'query'         => '',
                        'start'         => $itemsProcessed,
                        'count'         => $_ENV['DOPPLER_PER_PAGE'],
                        'currency'      => 1,
                        'language'      => 'english'
                    ]
                ]);

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
                            'price' => ($listing->converted_price + $listing->converted_fee) / 100
                        ];
                    }

                    foreach($resJson->assets->{'730'}->{'2'} as $asset)
                    {
                        $items[$asset->id]['icon'] = $asset->icon_url;
                        $items[$asset->id]['icon_large'] = $asset->icon_url_large;
                        $items[$asset->id]['name_color'] = "#{$asset->name_color}";
                        $items[$asset->id]['type'] = $asset->type;
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
            $item['hash_name'] = str_replace('(', "{$item['phase']} (", $item['hash_name']);

            $this->upsertConduitSteamItem($item);
        }
    }
}

try
{
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $smAgent = new SdAgend();
    $smAgent->run();
}
catch(\Exception $e)
{
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}