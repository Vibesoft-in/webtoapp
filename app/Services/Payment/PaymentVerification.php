<?php

declare(strict_types=1);

namespace App\Services\Payment;

class PaymentVerification
{
    public static function verifySignature(string $orderId, string $paymentId, string $signature, string $secret): bool
    {
        $expected = hash_hmac('sha256', "{$orderId}|{$paymentId}", $secret);
        return hash_equals($expected, $signature);
    }
}