<?php

declare(strict_types=1);

namespace App\Services\Integrations\Shopify;

class Webhooks
{
    public function verifyHmac(string $data, string $hmac, string $secret): bool
    {
        $calculated = base64_encode(hash_hmac('sha256', $data, $secret, true));
        return hash_equals($calculated, $hmac);
    }
}