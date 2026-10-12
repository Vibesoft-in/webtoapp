<?php

declare(strict_types=1);

namespace App\Services\Integrations\WooCommerce;

class Orders
{
    private WooCommerceAPI $api;

    public function __construct(WooCommerceAPI $api)
    {
        $this->api = $api;
    }

    public function list(int $customerId = 0): array
    {
        return $this->api->request('orders', 'GET', $customerId ? ['customer' => $customerId] : []) ?: [];
    }

    public function create(array $orderData): ?array
    {
        return $this->api->request('orders', 'POST', $orderData);
    }
}