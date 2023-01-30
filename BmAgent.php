<?php

require_once __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\HasConduitBuffMarketCsgoItems;
use ConduitUtils\Api\HasBuffMarketItems;
use ConduitUtils\Api\HasNbpExchangeRates;
use Dotenv\Dotenv;
use pSockets\Utils\Logger;

class BmAgent
{
    use HasConduitBuffMarketCsgoItems, HasBuffMarketItems, HasNbpExchangeRates;

    private float $yuanDollarExchangeRate;

    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger($_ENV['LOG_LEVEL']);

        $this->initYuanDollarExchangeRate();
    }

    public function run(): void
    {
        $itemsProcessed = $_ENV['BUFF_ITEMS_START'];

        for ($i = 0; $i < ceil($_ENV['BUFF_ITEMS_LIMIT'] / $_ENV['BUFF_ITEMS_PER_PAGE']); $i++) {
            $res = $this->getConduitBuffMarketCsgoItems([
                'offset' => $itemsProcessed,
                'limit' => $_ENV['BUFF_ITEMS_PER_PAGE']
            ]);

            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

            if (!$resJson->success) {
                continue;
            }

            $this->handleBuffMarketCsgoItems($resJson->data);

            $itemsProcessed += count($resJson->data);

            $this->logger->log("Got {$itemsProcessed} of {$_ENV['BUFF_ITEMS_LIMIT']} items", 1);

            if (count($resJson->data) < $_ENV['BUFF_ITEMS_PER_PAGE']) {
                break;
            }
        }
    }

    private function handleBuffMarketCsgoItems(array $items): void
    {
        for ($i = 0; $i < count($items); $i++) {
            try {
                $res = $this->getBuffMarketItemListings([
                    'game' => 'csgo',
                    'goods_id' => $items[$i]->good_id,
                    'page_num' => 1,
                    'sort_by' => 'default',
                    'mode' => '',
                    'allow_tradable_cooldown' => 1,
                    '_' => time()
                ], true);

                $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

                if ($resJson->code != 'OK' || count($resJson->data->items) == 0) {
                    continue;
                }

                $this->updateConduitBuffMarketCsgoItem($items[$i]->hash_name, [
                    'volume' => $resJson->data->total_count,
                    'price' => round($resJson->data->items[0]->price * $this->yuanDollarExchangeRate, 2)
                ]);
            } catch (\Exception $e) {
                Logger::warn($e->getMessage() . ': ' . $e->getCode());

                if ($e->getCode() == 429) {
                    sleep($_ENV['BUFF_REQUEST_DELAY']);
                    $i--;
                }
            }
        }
    }

    private function initYuanDollarExchangeRate(): void
    {
        $yuanDollarExchangeRate = 0.16;

        try {
            $res = $this->getPlnExchangeRate('CNY', true);
            $resJson = json_decode($res->getBody(), flags: \JSON_THROW_ON_ERROR);

            $plnYuanExchangeRate = $resJson->rates[0]->mid;

            $res = $this->getPlnExchangeRate('USD', true);
            $resJson = json_decode($res->getBody(), flags: \JSON_THROW_ON_ERROR);

            $plnDollarExchangeRate = $resJson->rates[0]->mid;

            $yuanDollarExchangeRate = round($plnYuanExchangeRate / $plnDollarExchangeRate, 4);
        } catch (\Exception $e) {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }

        $this->yuanDollarExchangeRate = $yuanDollarExchangeRate;
    }
}

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $bmAgent = new BmAgent();
    $bmAgent->run();
} catch (\Exception $e) {
    Logger::err($e->getMessage() . ': ' . $e->getCode());
}