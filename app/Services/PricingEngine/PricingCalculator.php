<?php

declare(strict_types=1);

namespace App\Services\PricingEngine;

class PricingCalculator
{
    public function calculate(float $basePrice, array $addons = [], float $taxRate = 18.0): array
    {
        $addonsTotal = array_sum(array_column($addons, 'price'));
        $subtotal = $basePrice + $addonsTotal;
        $tax = round(($subtotal * $taxRate) / 100, 2);
        $total = $subtotal + $tax;

        return [
            'base_price' => $basePrice,
            'addons_total' => $addonsTotal,
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $tax,
            'total_amount' => $total,
        ];
    }
}