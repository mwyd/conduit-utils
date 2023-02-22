<?php

use ConduitUtils\Api\ShadowpayApi;

use function ConduitUtils\env;

function get_shadowpay_api(): ShadowpayApi
{
    return new ShadowpayApi(
        env('SHADOWPAY_API_TOKEN'),
        [
            'base_uri' => env('SHADOWPAY_API_URL'),
            'headers' => [
                'origin' => env('SHADOWPAY_ORIGIN')
            ]
        ]
    );
}

it('gets login status', function () {
    $response = get_shadowpay_api()->isLogged();

    expect($response->getStatusCode())->toBe(200);

    $json = json_decode($response->getBody());

    expect($json)
        ->status->toBe('success')
        ->is_logged->toBeBool()
        ->is_deleted->toBeBool()
        ->is_banned->toBeBool()
        ->is_seller->toBeBool()
        ->wss_token->toBeString()
        ->is_market_delivery_online->toBeBool()
        ->country->toBeString();
});

it('gets steam market csgo item', function () {
    $response = get_shadowpay_api()->getSteamItem([
        'project' => 'csgo',
        'search' => 'Snakebite Case',
        'limit' => 50
    ]);

    expect($response->getStatusCode())->toBe(200);

    $json = json_decode($response->getBody());

    expect($json)
        ->status->toBe('success')
        ->data->toBeArray();
});
