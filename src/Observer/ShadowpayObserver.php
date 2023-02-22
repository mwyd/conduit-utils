<?php

namespace ConduitUtils\Observer;

use Amp\Websocket\Client\WebsocketConnection;
use Amp\Websocket\Client\WebsocketHandshake;
use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\ShadowpayApi;
use Revolt\EventLoop;

use function Amp\Websocket\Client\connect;
use function ConduitUtils\{format_hash_name};

class ShadowpayObserver
{
    public const METHOD_DATA = 9;

    public const METHOD_PING = 7;

    private WebsocketConnection $connection;

    private int $emitCounter = 0;

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
            $payload = json_decode($message->buffer());

            if (is_object($payload)) {
                $this->handlePayload($payload);
            }
        }

        $this->close();
    }

    private function authenticate(): void
    {
        $response = $this->shadowpayApi->isLogged(true);

        $json = json_decode($response->getBody());

        $this->emit([
            'params' => [
                'token' => $json->wss_token
            ]
        ]);

        $message = $this->connection->receive()?->buffer();

        if (!$message || json_decode($message)?->id != $this->emitCounter) {
            $this->close();

            return;
        }

        $this->schedulePing();

        $this->getFirstStat();
    }

    private function handlePayload(object $payload): void
    {
        $id = $payload->id ?? null;

        if ($id !== null && $id != $this->emitCounter) {
            $this->close();

            return;
        }

        $result = $payload->result->data->data ?? null;

        if ($result !== null && $result->type == 'live_items') {
            foreach ($result->data as $item) {
                $this->dumpItem($item);
            }

            return;
        }

        if ($id !== null && $result === null) {
            $this->schedulePing();
        }
    }

    private function emit(array $payload): void
    {
        $this->connection->send(
            json_encode(['id' => ++$this->emitCounter, ...$payload])
        );
    }

    private function schedulePing(): void
    {
        EventLoop::delay($this->options['ping_interval'], function () {
            if (!$this->connection->isClosed()) {
                $this->emit(['method' => self::METHOD_PING]);
            }
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
        ]);
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
