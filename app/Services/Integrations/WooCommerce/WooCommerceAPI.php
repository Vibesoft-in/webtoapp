<?php

declare(strict_types=1);

namespace App\Services\Integrations\WooCommerce;

class WooCommerceAPI
{
    private string $baseUrl;
    private string $consumerKey;
    private string $consumerSecret;

    public function __construct(string $baseUrl, string $consumerKey = '', string $consumerSecret = '')
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
    }

    public function request(string $endpoint, string $method = 'GET', array $data = []): ?array
    {
        $url = $this->baseUrl . '/wp-json/wc/v3/' . ltrim($endpoint, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->consumerKey}:{$this->consumerSecret}");
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }
        $response = curl_exec($ch);
        curl_close($ch);
        return $response ? json_decode($response, true) : null;
    }
}