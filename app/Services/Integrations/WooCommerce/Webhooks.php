<?php

declare(strict_types=1);

namespace App\Services\Integrations\WooCommerce;

class Webhooks
{
    public function handle(string $topic, array $payload): bool
    {
        return true;
    }
}