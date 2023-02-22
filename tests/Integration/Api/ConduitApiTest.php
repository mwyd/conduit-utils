<?php

use ConduitUtils\Api\ConduitApi;

use function ConduitUtils\env;

function get_conduit_api(): ConduitApi
{
    return new ConduitApi(
        env('CONDUIT_API_TOKEN'),
        [
            'base_uri' => env('CONDUIT_API_URL')
        ]
    );
}

it('gets steam market csgo items', function () {
    $response = get_conduit_api()->getSteamMarketCsgoItems();

    expect($response->getStatusCode())->toBe(200);

    $json = json_decode($response->getBody());

    expect($json)
        ->success->toBeTrue()
        ->data->toBeArray();
});

it('gets steam market csgo item', function () {
    $response = get_conduit_api()->getSteamMarketCsgoItem('Snakebite Case');

    expect($response->getStatusCode())->toBe(200);

    $json = json_decode($response->getBody());

    expect($json)
        ->success->toBeTrue()
        ->data->toBeObject();

    expect($json->data)
        ->hash_name->toBeString()
        ->volume->toBeInt()
        ->price->toBeFloat()
        ->icon->toBeString()
        ->icon_large->toBeNull()
        ->is_stattrak->toBeBool()
        ->name->toBeString()
        ->name_color->toBeString()
        ->exterior->toBeNull()
        ->phase->toBeNull()
        ->collection->toBeNull()
        ->type->toBeString()
        ->type_color->toBeString()
        ->updated_at->toBeString();
});
