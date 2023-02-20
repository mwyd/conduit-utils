<?php

namespace ConduitUtils\Agent;

use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\BuffApi;
use ConduitUtils\Api\NbpApi;
use Psr\Log\LoggerInterface;

class BmAgent implements AgentInterface
{
    private float $yuanDollarExchangeRate;

    /**
     * @param array{
     *     start: int,
     *     per_page: int,
     *     limit: int,
     *     request_delay: int
     * } $options
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly NbpApi $nbpApi,
        private readonly ConduitApi $conduitApi,
        private readonly BuffApi $buffApi,
        private readonly array $options
    ) {
        $this->initYuanDollarExchangeRate();
    }

    public function run(): void
    {
        $itemsProcessed = $this->options['start'];

        for ($i = 0; $i < ceil($this->options['limit'] / $this->options['per_page']); $i++) {
            $res = $this->conduitApi->getBuffMarketCsgoItems([
                'offset' => $itemsProcessed,
                'limit' => $this->options['per_page']
            ]);

            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

            if (!$resJson->success) {
                continue;
            }

            $this->handleBuffMarketCsgoItems($resJson->data);

            $itemsProcessed += count($resJson->data);

            if (count($resJson->data) < $this->options['per_page']) {
                break;
            }
        }

        $this->logger->info("Got {$itemsProcessed} of {$this->options['limit']} items");
    }

    private function handleBuffMarketCsgoItems(array $items): void
    {
        for ($i = 0; $i < count($items); $i++) {
            try {
                $res = $this->buffApi->getMarketItemListings([
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

                $this->conduitApi->updateBuffMarketCsgoItem($items[$i]->hash_name, [
                    'volume' => $resJson->data->total_count,
                    'price' => round($resJson->data->items[0]->price * $this->yuanDollarExchangeRate, 2)
                ]);
            } catch (\Exception $e) {
                if ($e->getCode() == 429) {
                    sleep($this->options['request_delay']);
                    $i--;
                } else {
                    $this->logger->warning($e->getMessage());
                }
            }
        }
    }

    private function initYuanDollarExchangeRate(): void
    {
        $yuanDollarExchangeRate = 0.15;

        try {
            $res = $this->nbpApi->getPlnExchangeRate('CNY', true);
            $resJson = json_decode($res->getBody(), flags: \JSON_THROW_ON_ERROR);

            $plnYuanExchangeRate = $resJson->rates[0]->mid;

            $res = $this->nbpApi->getPlnExchangeRate('USD', true);
            $resJson = json_decode($res->getBody(), flags: \JSON_THROW_ON_ERROR);

            $plnDollarExchangeRate = $resJson->rates[0]->mid;

            $yuanDollarExchangeRate = round($plnYuanExchangeRate / $plnDollarExchangeRate, 4);
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage());
        }

        $this->yuanDollarExchangeRate = $yuanDollarExchangeRate;
    }
}
