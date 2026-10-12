<?php

declare(strict_types=1);

namespace App\Services\PricingEngine;

class PackageManager
{
    public function getPackages(): array
    {
        return [
            ['id' => 1, 'name' => 'Starter App', 'price' => 4999.00, 'platform' => 'Android'],
            ['id' => 2, 'name' => 'Pro Combo', 'price' => 8999.00, 'platform' => 'Android + iOS'],
            ['id' => 3, 'name' => 'Enterprise Suite', 'price' => 14999.00, 'platform' => 'All Platforms + Dedicated Support'],
        ];
    }
}