<?php

namespace ConduitUtils\Observer;

use Amp\Websocket\Client\WebsocketConnection;
use Amp\Websocket\Client\WebsocketHandshake;
use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\ShadowpayApi;
use Revolt\EventLoop;

use function Amp\Websocket\Client\connect;
use function ConduitUtils\format_hash_name;

class ShadowpayObserver
{
    public const METHOD_DATA = 9;

    public const METHOD_PING = 7;

    private readonly WebsocketConnection $connection;

    private int $emitCounter = 0;

    private array $emits = [];

    public function __construct(
        private readonly ConduitApi $conduitApi,
        private readonly ShadowpayApi $shadowpayApi,
        private readonly array $options
    ) {
        $handshake = (new WebsocketHandshake($this->options['uri']))
            ->withHeader('origin', $this->options['origin']);

        $this->connection = connect($handshake);
    }

    public function run(): void
    {
        $this->authenticate();

        while ($message = $this->connection->receive()) {
            $this->handlePayload($message->buffer());
        }

        $this->close();
    }

    private function authenticate(): void
    {
        $response = $this->shadowpayApi->isLogged();

        $json = json_decode($response->getBody());

        if (!$json || $json->status != 'success') {
            $this->close();

            return;
        }

        $this->emit([
            'params' => [
                'token' => $json->wss_token
            ]
        ], function () {
            echo 'Authenticated' . \PHP_EOL;
        });

        $payload = $this->connection->receive()?->buffer();

        if (!$payload) {
            $this->close();

            return;
        }

        $this->handlePayload($payload);

        $this->schedulePing();

        $this->getFirstStat();
    }

    private function handlePayload(string $payload): void
    {
        $response = json_decode($payload);

        if (!is_object($response)) {
            return;
        }

        $id = $response->id ?? null;

        if ($id && array_key_exists($id, $this->emits)) {
            $this->emits[$id]($response);

            unset($this->emits[$id]);

            return;
        }

        $result = $response->result->data->data ?? null;

        if ($result?->type == 'live_items') {
            foreach ($result->data as $item) {
                $this->dumpItem($item);
            }
        }
    }

    private function emit(array $payload, \Closure $onResponse): void
    {
        $id = ++$this->emitCounter;

        $this->emits[$id] = $onResponse;

        $this->connection->send(
            json_encode(['id' => $id] + $payload)
        );
    }

    private function schedulePing(): void
    {
        EventLoop::delay($this->options['ping_interval'], function () {
            if ($this->connection->isClosed()) {
                return;
            }

            $this->emit(['method' => self::METHOD_PING], function () {
                $this->schedulePing();
            });
        });
    }

    private function getFirstStat(): void
    {
        $this->emit([
            'method' => self::METHOD_DATA,
            'params' => [
                'data' => [],
                'method' => 'send_first_stat'
            ]
        ], function () {
            echo 'Got first stat' . \PHP_EOL;
        });
    }

    private function close(): void
    {
        $this->connection->close();
    }

    private function dumpItem(object $item): void
    {
        $this->conduitApi->createShadowpaySoldItem($this->buildSchema($item));
    }

    private function buildSchema(object $item): array
    {
        $hashName = $item->name;

        $hashName .= match ($item->shorten_exterior) {
            'FN' => ' (Factory New)',
            'MW' => ' (Minimal Wear)',
            'FT' => ' (Field-Tested)',
            'WW' => ' (Well-Worn)',
            'BS' => ' (Battle-Scarred)',
            default => ''
        };

        if ($item->is_stattrak) {
            $hashName = str_contains($hashName, '★')
                ? str_replace('★', '★ StatTrak™', $hashName)
                : 'StatTrak™ ' . $hashName;
        }

        $conduitSteamPrice = null;
        $shadowpaySteamPrice = null;

        if (str_contains($item->name, 'Doppler')) {
            $doppler = $this->getConduitDoppler($item->name, $item->shorten_exterior, $item->is_stattrak, $item->icon);

            if ($doppler) {
                $shadowpaySteamPrice = $this->getShadowpaySteamPrice($hashName, $doppler->phase);
                $conduitSteamPrice = $doppler->price;

                $hashName = format_hash_name($hashName, $doppler->phase);
            }
        } else {
            $shadowpaySteamPrice = $this->getShadowpaySteamPrice($hashName);
            $conduitSteamPrice = $this->getConduitSteamPrice($hashName);
        }

        $schema['transaction_id'] = $item->id;
        $schema['hash_name'] = $hashName;
        $schema['suggested_price'] = $shadowpaySteamPrice;
        $schema['steam_price'] = $conduitSteamPrice;
        $schema['discount'] = $item->discount_percent ?? 0;
        $schema['sold_at'] = $item->time_created;

        return $schema;
    }

    private function getConduitSteamPrice(string $hashName): ?float
    {
        $response = $this->conduitApi->getSteamMarketCsgoItem($hashName);

        if ($response->getStatusCode() != 200) {
            return null;
        }

        $json = json_decode($response->getBody());

        return $json->data->price;
    }

    private function getShadowpaySteamPrice(string $hashName, ?string $phase = null): ?float
    {
        $response = $this->shadowpayApi->getSteamItem([
            'project' => 'csgo',
            'search' => $hashName,
            'limit' => 50
        ]);

        $json = json_decode($response->getBody());

        if ($response->getStatusCode() != 200 || $json->status != 'success') {
            return null;
        }

        foreach ($json->data as $item) {
            if ($item->steam_market_hash_name == $hashName && $item->phase == $phase) {
                return $item->suggested_price;
            }
        }

        return null;
    }

    private function getConduitDoppler(string $name, string $exterior, string $isStattrak, string $icon): ?object
    {
        $response = $this->conduitApi->getSteamMarketCsgoItems([
            'search' => $name,
            'exteriors' => $exterior,
            'is_stattrak' => $isStattrak
        ]);

        if ($response->getStatusCode() != 200) {
            return null;
        }

        $json = json_decode($response->getBody());

        foreach ($json->data as $item) {
            if ($item->icon == $icon || $item->icon_large == $icon) {
                return $item;
            }
        }

        return null;
    }
}
