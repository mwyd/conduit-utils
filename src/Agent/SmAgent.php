<?php

namespace ConduitUtils\Agent;

use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\SteamApi;
use Psr\Log\LoggerInterface;

use function ConduitUtils\get_steam_market_item_collection;

class SmAgent implements AgentInterface
{
    /**
     * @param array{
     *     start: int,
     *     per_page: int,
     *     limit: int,
     *     request_small_delay: int,
     *     request_delay: int,
     *     ignore_dopplers: bool
     * } $options
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ConduitApi $conduitApi,
        private readonly SteamApi $steamApi,
        private readonly array $options
    ) {
    }

    public function run(): void
    {
        $itemsProcessed = $this->options['start'];

        for ($i = 0; $i < ceil($this->options['limit'] / $this->options['per_page']); $i++) {
            try {
                $res = $this->steamApi->getMarketItems([
                    'query' => '',
                    'start' => $itemsProcessed,
                    'count' => $this->options['per_page'],
                    'search_descriptions' => 0,
                    'sort_column' => 'name',
                    'sort_dir' => 'asc',
                    'appid' => 730,
                    'norender' => 1,
                    'l' => 'english'
                ], true);

                $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

                if (empty($resJson->results) && $resJson->searchdata->total_count == 0) {
                    sleep($this->options['request_small_delay']);
                    $i--;

                    continue;
                }

                foreach ($resJson->results as $item) {
                    if ($this->options['ignore_dopplers'] && str_contains($item->hash_name, 'Doppler (')) {
                        continue;
                    }

                    $this->conduitApi->upsertSteamMarketCsgoItem([
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

                if ($itemsProcessed >= $resJson->searchdata->total_count) {
                    break;
                }
            } catch (\Exception $e) {
                if ($e->getCode() == 429 || $e->getCode() == 403) {
                    sleep($this->options['request_delay']);
                    $i--;
                } else {
                    $this->logger->warning($e->getMessage());
                }
            }
        }

        $this->logger->info("Got {$itemsProcessed} of {$this->options['limit']} items");
    }
}
