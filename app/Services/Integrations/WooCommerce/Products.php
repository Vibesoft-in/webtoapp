<?php

declare(strict_types=1);

namespace App\Services\Integrations\WooCommerce;

class Products
{
    private WooCommerceAPI $api;

    public function __construct(WooCommerceAPI $api)
    {
        $this->api = $api;
    }

    public function list(int $page = 1, int $perPage = 20): array
    {
        return $this->api->request('products', 'GET', ['page' => $page, 'per_page' => $perPage]) ?: [];
    }

    public function get(int $id): ?array
    {
        return $this->api->request("products/{$id}");
    }
}