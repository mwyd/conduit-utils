<?php

require_once __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\HasSteamMarketCsgoItems;
use Dotenv\Dotenv;
use GuzzleHttp\Client as HttpClient;
use pSockets\Utils\Logger;

class SmAgent
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
        $itemsProcessed = $_ENV['ITEMS_START'];

        for($i = 0; $i < ceil($_ENV['ITEMS_LIMIT'] / $_ENV['ITEMS_PER_PAGE']); $i++)
        {
            try
            {
                $res = $this->httpClient->get($_ENV['STEAM_MARKET_API_URL'] . '/search/render/', [
                    'headers' => [
                        'Accept' => 'application/json'
                    ],
                    'query' => [
                        'query'                 => '',
                        'start'                 => $itemsProcessed,
                        'count'                 => $_ENV['ITEMS_PER_PAGE'],
                        'search_descriptions'   => 0,
                        'sort_column'           => 'popular',
                        'sort_dir'              => 'desc',
                        'appid'                 => 730,
                        'norender'              => 1,
                        'l'                     => 'english'
                    ]
                ]);
        
                $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

                if(empty($resJson->results) && $resJson->searchdata->total_count == 0)
                {
                    sleep($_ENV['REQUEST_DELAY_SMALL']);
                    $i--;

                    continue;
                }

                foreach($resJson->results as $item)
                {
                    if(!$_ENV['BASE_DOPPLERS'] && str_contains($item->hash_name, 'Doppler')) continue;

                    $this->upsertConduitSteamItem([
                        'hash_name'     => $item->hash_name,
                        'volume'        => $item->sell_listings,
                        'price'         => $item->sell_price / 100,
                        'icon'          => $item->asset_description->icon_url,
                        'icon_large'    => $item->asset_description->icon_url_large ?? null,
                        'name_color'    => "#{$item->asset_description->name_color}",
                        'type'          => $item->asset_description->type
                    ]);
                }

                $itemsProcessed += count($resJson->results);
        
                $this->logger->log("Got {$itemsProcessed} of {$_ENV['ITEMS_LIMIT']} items", 1);

                if($itemsProcessed >= $resJson->searchdata->total_count) break;
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
    }
}

try
{
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $_ENV['BASE_DOPPLERS'] = filter_var($_ENV['BASE_DOPPLERS'], \FILTER_VALIDATE_BOOLEAN);

    $smAgent = new SmAgent();
    $smAgent->run();
}
catch(\Exception $e)
{
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}