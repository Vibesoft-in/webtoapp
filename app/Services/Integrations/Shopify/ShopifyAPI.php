<?php

declare(strict_types=1);

namespace App\Services\Integrations\Shopify;

class ShopifyAPI
{
    private string $shopDomain;
    private string $accessToken;

    public function __construct(string $shopDomain, string $accessToken = '')
    {
        $this->shopDomain = rtrim($shopDomain, '/');
        $this->accessToken = $accessToken;
    }

    public function request(string $endpoint, string $method = 'GET', array $data = []): ?array
    {
        $url = "https://{$this->shopDomain}/admin/api/2024-01/" . ltrim($endpoint, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-Shopify-Access-Token: {$this->accessToken}",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res ? json_decode($res, true) : null;
    }
}