<?php

declare(strict_types=1);

namespace App\Services\Integrations\Shopify;

class Orders
{
    private ShopifyAPI $api;

    public function __construct(ShopifyAPI $api)
    {
        $this->api = $api;
    }

    public function list(): array
    {
        $data = $this->api->request('orders.json');
        return $data['orders'] ?? [];
    }
}