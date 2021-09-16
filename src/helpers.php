<?php

function array_find_index(array $haystack, \Closure $callback) : int|string
{
    foreach($haystack as $key => $needle)
    {
        if($callback($needle)) return $key;
    }

    return -1;
}

function format_hash_name(string $hashName, string $phase) : string
{
    return str_replace('(', "{$phase} (", $hashName);
}

function get_steam_market_item_collection(array $descriptions) : ?string
{
    foreach($descriptions as $description)
    {
        if(str_contains($description->value, 'Collection')) return $description->value; 
    }

    return null;
}