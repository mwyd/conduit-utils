<?php

namespace ConduitUtils;

use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

function array_find_index(array $haystack, \Closure $callback): int|string|false
{
    foreach ($haystack as $key => $needle) {
        if ($callback($needle)) {
            return $key;
        }
    }

    return false;
}

function format_hash_name(string $hashName, string $phase): string
{
    return str_replace('(', "{$phase} (", $hashName);
}

function get_steam_market_item_collection(array $descriptions): ?string
{
    foreach ($descriptions as $description) {
        if (isset($description->color) && $description->color == '9da1a9') {
            return $description->value;
        }
    }

    return null;
}

function create_logger(string $name, string $file): LoggerInterface
{
    $logger = new Logger($name);
    $logger->pushHandler(new StreamHandler($file));

    return $logger;
}

function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? $default;
}

function load_env(string $path): void
{
    $dotenv = Dotenv::createImmutable($path);
    $dotenv->load();
}