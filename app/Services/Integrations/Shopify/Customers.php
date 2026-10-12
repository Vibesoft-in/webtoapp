<?php

declare(strict_types=1);

namespace App\Services\Integrations\Shopify;

class Customers
{
    private ShopifyAPI $api;

    public function __construct(ShopifyAPI $api)
    {
        $this->api = $api;
    }

    public function get(string $id): ?array
    {
        return $this->api->request("customers/{$id}.json");
    }
}