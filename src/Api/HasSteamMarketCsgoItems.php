<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use pSockets\Utils\Logger;

trait HasSteamMarketCsgoItems
{
    private function upsertConduitSteamItem(array $formData) : void
    {
        try
        {
            $res = $this->updateConduitSteamItem($formData['hash_name'], [
                'volume'    => $formData['volume'],
                'price'     => $formData['price']
            ]);

            $data = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

            if(!$data->success && $data->error_message == 'not_found')
            {
                $this->createConduitSteamItem($formData);
            }
        }
        catch(\Exception $e)
        {
            Logger::warn($e->getMessage() . ': ' . $e->getCode());
        }
    }

    public function createConduitSteamItem(array $formData, bool $httpErrors = false) : ResponseInterface
    {
        return $this->httpClient->post($_ENV['CONDUIT_API_URL'] . '/v1/steam-market-csgo-items', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }

    private function updateConduitSteamItem(string $hashName, array $formData, bool $httpErrors = false) : ResponseInterface
    {
        return $this->httpClient->put($_ENV['CONDUIT_API_URL'] . "/v1/steam-market-csgo-items/{$hashName}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }
}