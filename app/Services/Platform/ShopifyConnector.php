<?php

declare(strict_types=1);

namespace App\Services\Platform;

class ShopifyConnector
{
    public function verify(string $url, string $accessToken): array
    {
        $domain = $this->normalizeShopifyDomain($url);
        $token = trim($accessToken);

        if (empty($domain)) {
            return [
                'success' => false,
                'message' => "Invalid Shopify store URL. Example: your-store.myshopify.com",
                'error_code' => 'INVALID_DOMAIN',
            ];
        }

        $endpoint = "https://{$domain}/admin/api/2024-01/shop.json";

        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 14,
            CURLOPT_CONNECTTIMEOUT => 8,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_USERAGENT => 'AppifyHub-Compatibility-Analyzer/2.0',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'X-Shopify-Access-Token: ' . $token,
            ],
        ]);

        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return [
                'success' => false,
                'message' => "Unable to connect: {$curlError}. Please verify your store URL.",
                'error_code' => 'NETWORK_ERROR',
            ];
        }

        if ($httpCode === 200 && $responseBody) {
            $data = json_decode($responseBody, true) ?: [];
            $shop = $data['shop'] ?? [];
            $shopName = $shop['name'] ?? $domain;
            $currency = $shop['currency'] ?? 'USD';
            $plan = $shop['plan_display_name'] ?? 'Shopify';

            return [
                'success' => true,
                'message' => "Shopify store connected successfully. Authenticated store: '{$shopName}'.",
                'details' => [
                    'platform' => 'Shopify',
                    'shop_name' => $shopName,
                    'domain' => $domain,
                    'currency' => $currency,
                    'plan' => $plan,
                    'api_version' => '2024-01',
                ],
            ];
        }

        if ($httpCode === 401) {
            return [
                'success' => false,
                'message' => "Unable to connect (HTTP 401). Invalid Shopify Admin API Access Token. Please ensure you copied the full token starting with shpat_.",
                'error_code' => 'AUTH_FAILED',
            ];
        }

        if ($httpCode === 403) {
            return [
                'success' => false,
                'message' => "Access forbidden (HTTP 403). Your Shopify app lacks required permissions. Ensure Products, Orders, and Store data scopes are enabled.",
                'error_code' => 'SCOPES_MISSING',
            ];
        }

        if ($httpCode === 404) {
            return [
                'success' => false,
                'message' => "Shopify store not found at {$domain}. Please verify your store myshopify.com address.",
                'error_code' => 'STORE_NOT_FOUND',
            ];
        }

        return [
            'success' => false,
            'message' => "Shopify responded with HTTP {$httpCode}. Please check your store settings and app status.",
            'error_code' => 'SERVER_ERROR',
        ];
    }

    private function normalizeShopifyDomain(string $url): string
    {
        $clean = trim($url);
        $clean = preg_replace('#^https?://#i', '', $clean);
        $clean = rtrim($clean, '/');

        // Extract host if path or query string was included
        $parts = explode('/', $clean);
        $host = $parts[0] ?? '';

        return $host;
    }
}
