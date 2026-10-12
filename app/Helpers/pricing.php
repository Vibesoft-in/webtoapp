<?php

declare(strict_types=1);

if (!function_exists('format_currency')) {
    function format_currency(float|int $amount, string $currency = 'INR'): string {
        return match ($currency) {
            'INR' => '₹' . number_format($amount, 2),
            'USD' => '$' . number_format($amount, 2),
            'EUR' => '€' . number_format($amount, 2),
            default => $currency . ' ' . number_format($amount, 2),
        };
    }
}

if (!function_exists('calculate_tax')) {
    function calculate_tax(float|int $amount, float $rate = 18.0): float {
        return round(($amount * $rate) / 100, 2);
    }
}