<?php

namespace ConduitUtils\Agent;

use Amp\Websocket\Client\WebsocketConnection;
use Amp\Websocket\Client\WebsocketHandshake;
use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\ShadowpayApi;
use Psr\Log\LoggerInterface;
use Revolt\EventLoop;

use function Amp\Websocket\Client\connect;
use function ConduitUtils\{env, format_hash_name};

class SpAgent implements AgentInterface
{
    public const METHOD_DATA = 9;

    public const METHOD_PING = 7;

    private WebsocketConnection $connection;

    private int $emitCounter = 0;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ConduitApi $conduitApi,
        private readonly ShadowpayApi $shadowpayApi,
        private readonly array $options
    ) {
        $handshake = (new WebsocketHandshake(env('SHADOWPAY_WS_URL')))
            ->withHeader('origin', env('SHADOWPAY_ORIGIN'));

        $this->connection = connect($handshake);
    }

    public function run(): void
    {
        $this->authenticate();

        while ($message = $this->read()) {
            $this->handleMessage($message);
        }

        $this->close();
    }

    private function authenticate(): void
    {
        $res = $this->shadowpayApi->isLogged(true);

        $resJson = json_decode($res->getBody());

        $this->emit([
            'params' => [
                'token' => $resJson->wss_token
            ]
        ]);

        $message = $this->read();

        if ($message->id != $this->emitCounter) {
            $this->close();

            return;
        }

        $this->schedulePing();

        $this->getFirstStat();
    }

    private function handleMessage(object $message): void
    {
        $id = $message->id ?? null;

        if ($id !== null && $id != $this->emitCounter) {
            $this->close();

            return;
        }

        $result = $message->result->data->data ?? null;

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
        EventLoop::delay(env('SHADOWPAY_PING_INTERVAL'), function () {
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

    private function read(): ?object
    {
        $message = $this->connection->receive()?->buffer();

        if ($message !== null) {
            return json_decode($message);
        }

        return null;
    }

    private function close(): void
    {
        $this->connection->close();
    }

    private function dumpItem(object $item): void
    {
        try {
            $this->conduitApi->createShadowpaySoldItem($this->buildSchema($item), true);
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage());
        }
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
        $price = null;

        try {
            $res = $this->conduitApi->getSteamMarketCsgoItem($hashName, true);

            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);
            $price = $resJson->data->price;
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage());
        }

        return $price;
    }

    private function getShadowpaySteamPrice(string $hashName, ?string $phase = null): ?float
    {
        $price = null;

        try {
            $res = $this->shadowpayApi->getSteamItem([
                'token' => env('SHADOWPAY_API_TOKEN'),
                'project' => 'csgo',
                'search' => $hashName,
                'limit' => 50
            ], true);

            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

            if ($resJson->status == 'success') {
                foreach ($resJson->data as $item) {
                    if ($item->steam_market_hash_name == $hashName && $item->phase == $phase) {
                        $price = $item->suggested_price;
                        break;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage());
        }

        return $price;
    }

    private function getConduitDoppler(string $name, string $exterior, string $isStattrak, string $icon): ?object
    {
        $doppler = null;

        try {
            $res = $this->conduitApi->getSteamMarketCsgoItems([
                'search' => $name,
                'exteriors' => $exterior,
                'is_stattrak' => $isStattrak
            ], true);

            $resJson = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

            foreach ($resJson->data as $item) {
                if ($item->icon == $icon || $item->icon_large == $icon) {
                    $doppler = $item;
                    break;
                }
            }
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage());
        }

        return $doppler;
    }
}