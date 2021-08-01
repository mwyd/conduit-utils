<?php

require_once __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use GuzzleHttp\Client as HttpClient;
use pSockets\Utils\Logger;
use Psr\Http\Message\ResponseInterface;

class SmAgent
{
    private HttpClient $httpClient;
    private Logger $logger;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
        $this->logger = new Logger($_ENV['LOG_LEVEL']);
    }

    public function run() : void
    {
        $itemsProcessed = 0;

        for($i = 0; $i < ceil($_ENV['ITEMS_LIMIT'] / $_ENV['ITEMS_PER_PAGE']); $i++)
        {
            try
            {
                $res = $this->httpClient->get($_ENV['STEAM_MARKET_API_URL'] . '/search/render', [
                    'headers' => [
                        'Accept' => 'application/json'
                    ],
                    'query' => [
                        'query' => '',
                        'start' => $i * $_ENV['ITEMS_PER_PAGE'],
                        'count' => $_ENV['ITEMS_PER_PAGE'],
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
                    if($resJson->searchdata->total_count > 0) break;
                    else
                    {
                        $i--;
                        continue;
                    }
                }

                foreach($resJson->results as $item) $this->upsertConduitSteamItem($item);

                $itemsProcessed += count($resJson->results);
        
                $this->logger->log("Got {$itemsProcessed} of {$_ENV['ITEMS_LIMIT']} items", 1);
            }
            catch(\Exception $e)
            {
                Logger::warn($e->getMessage() . ': ' . $e->getCode());

                if($e->getCode() == 429)
                {
                    sleep($_ENV['REQUEST_DELAY']);
                    $i--;
                }
            }
        }
    }

    private function upsertConduitSteamItem(object $item) : void
    {
        try
        {
            $res = $this->updateConduitSteamItem($item->hash_name, [
                'volume' => $item->sell_listings,
                'price' => $item->sell_price / 100,
            ]);

            $data = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

            if(!$data->success && $data->error_message == 'not_found')
            {
                $this->createConduitSteamItem([
                    'hash_name' => $item->hash_name,
                    'volume' => $item->sell_listings,
                    'price' => $item->sell_price / 100,
                    'icon' => $item->asset_description->icon_url
                ]);
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    }

    public function createConduitSteamItem(array $formParams) : ResponseInterface
    {
        return $this->httpClient->post($_ENV['CONDUIT_API_URL'] . '/v1/steam-market-csgo-items', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formParams,
            'http_errors' => false
        ]);
    }

    private function updateConduitSteamItem(string $hashName, array $formParams) : ResponseInterface
    {
        return $this->httpClient->put($_ENV['CONDUIT_API_URL'] . "/v1/steam-market-csgo-items/{$hashName}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formParams,
            'http_errors' => false
        ]);
    }
}

try
{
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $smAgent = new SmAgent();
    $smAgent->run();
}
catch(\Exception $e)
{
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}