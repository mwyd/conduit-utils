<?php

namespace ConduitUtils\Agent;

use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\SteamApi;
use ConduitUtils\Resources\DopplerKnife;
use ConduitUtils\Resources\DopplerWeapon;
use Psr\Log\LoggerInterface;

use function ConduitUtils\{array_find_index, format_hash_name, get_steam_market_item_collection};

class SdAgent implements AgentInterface
{
    /**
     * @param array{
     *     start: int,
     *     per_page: int,
     *     limit: int,
     *     page_delay: int,
     *     request_delay: int
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
        $this->fetchWeapons();
        $this->fetchKnives();
    }

    private function fetchWeapons(): void
    {
        foreach (DopplerWeapon::$icons as $name => $icons) {
            $this->handleDoppler($name, $icons);
        }
    }

    private function fetchKnives(): void
    {
        $stattraks = DopplerKnife::$hasStattrak ? ['★', '★ StatTrak™'] : ['★'];

        foreach (DopplerKnife::$icons as $name => $icons) {
            foreach (DopplerKnife::$exteriors as $exterior) {
                foreach ($stattraks as $prefix) {
                    $this->handleDoppler(str_replace('★', $prefix, $name) . ' SdAgent.php' . $exterior, $icons);
                }
            }
        }
    }

    private function handleDoppler(string $hashName, array $icons): void
    {
        $items = [];
        $itemsProcessed = 0;

        for ($i = 0; $i < $this->options['limit']; $i++) {
            try {
                $res = $this->steamApi->getMarketItemListings($hashName, '730', [
                    'query' => '',
                    'start' => $itemsProcessed,
                    'count' => $this->options['per_page'],
                    'currency' => 1,
                    'language' => 'english'
                ], true);

                $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

                if (!$resJson->success) {
                    sleep($this->options['page_delay']);
                    $i--;

                    continue;
                }

                $listings = (array) $resJson->listinginfo;

                if (count($listings)) {
                    foreach ($listings as $listing) {
                        $items[$listing->asset->id] = [
                            'price' => (($listing->converted_price ?? 0) + ($listing->converted_fee ?? 0)) / 100
                        ];
                    }

                    foreach ($resJson->assets->{'730'}->{'2'} as $asset) {
                        $items[$asset->id]['icon'] = $asset->icon_url;
                        $items[$asset->id]['icon_large'] = $asset->icon_url_large;
                        $items[$asset->id]['name_color'] = "#{$asset->name_color}";
                        $items[$asset->id]['type'] = $asset->type;
                        $items[$asset->id]['collection'] = get_steam_market_item_collection($asset->descriptions);
                    }
                }

                $itemsProcessed += count($listings);

                if ($itemsProcessed >= $resJson->total_count) {
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

            $this->logger->info("Got {$itemsProcessed} of " . $this->options['limit'] * $this->options['per_page'] . " items");
        }

        usort($items, fn($a, $b) => $a['price'] - $b['price']);

        $groupedItems = array_reduce($items, function ($carry, $item) use ($hashName, $icons) {
            $index = array_find_index($carry, fn($v) => $v['icon'] == $item['icon']);

            if ($index === false) {
                $carry[] = $item + [
                    'hash_name' => $hashName,
                    'volume' => 1,
                    'phase' => $icons[$item['icon']] ?? $icons[$item['icon_large']] ?? null
                ];
            } else {
                $carry[$index]['volume']++;
            }

            return $carry;
        }, []);

        foreach (array_filter($groupedItems, fn($item) => $item['phase'] != null) as $item) {
            $item['hash_name'] = format_hash_name($item['hash_name'], $item['phase']);

            $this->conduitApi->upsertSteamMarketCsgoItem($item);
        }
    }
}
