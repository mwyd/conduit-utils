<?php

require __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\ShadowpayApi;
use ConduitUtils\Observer\ShadowpayObserver;

use function ConduitUtils\{create_logger, env, load_env};

load_env(__DIR__);

$logger = create_logger('conduit', 'log/conduit.log');

set_exception_handler(function (\Throwable $e) use ($logger) {
   $logger->error($e->getMessage(), ['exception' => $e]);
});

$conduitApi = new ConduitApi(
    env('CONDUIT_API_TOKEN'),
    [
        'base_uri' => env('CONDUIT_API_URL')
    ]
);

$shadowpayApi = new ShadowpayApi(
    env('SHADOWPAY_API_TOKEN'),
    [
        'base_uri' => env('SHADOWPAY_API_URL'),
        'headers' => [
            'origin' => env('SHADOWPAY_ORIGIN')
        ]
    ]
);

while (true) {
    $shadowpayObserver = new ShadowpayObserver(
        $conduitApi,
        $shadowpayApi,
        [
            'uri' => env('SHADOWPAY_WS_URL'),
            'origin' => env('SHADOWPAY_ORIGIN'),
            'ping_interval' => (int) env('SHADOWPAY_PING_INTERVAL', 30)
        ]
    );

    $shadowpayObserver->run();

    sleep((int) env('SHADOWPAY_RECONNECT_DELAY', 60));
}