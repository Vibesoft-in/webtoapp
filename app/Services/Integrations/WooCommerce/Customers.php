<?php

declare(strict_types=1);

namespace App\Services\Integrations\WooCommerce;

class Customers
{
    private WooCommerceAPI $api;

    public function __construct(WooCommerceAPI $api)
    {
        $this->api = $api;
    }

    public function get(int $id): ?array
    {
        return $this->api->request("customers/{$id}");
    }
}