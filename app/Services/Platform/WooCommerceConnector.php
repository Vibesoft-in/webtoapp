<?php

declare(strict_types=1);

namespace App\Services\Platform;

class WooCommerceConnector
{
    public function verify(string $url, string $consumerKey, string $consumerSecret): array
    {
        $cleanUrl = rtrim(trim($url), '/');
        if (!preg_match('#^https?://#i', $cleanUrl)) {
            $cleanUrl = 'https://' . $cleanUrl;
        }

        $endpoint = $cleanUrl . '/wp-json/wc/v3/system_status';
        $ck = trim($consumerKey);
        $cs = trim($consumerSecret);

        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $ck . ':' . $cs,
            CURLOPT_TIMEOUT => 14,
            CURLOPT_CONNECTTIMEOUT => 8,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_USERAGENT => 'AppifyHub-Compatibility-Analyzer/2.0',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
            ],
        ]);

        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return [
                'success' => false,
                'message' => "Connection failed: {$curlError}. Please verify your Store URL.",
                'error_code' => 'NETWORK_ERROR',
            ];
        }

        if ($httpCode === 200 && $responseBody) {
            $data = json_decode($responseBody, true) ?: [];
            $environment = $data['environment'] ?? [];
            $storeName = $environment['site_title'] ?? parse_url($cleanUrl, PHP_URL_HOST);
            $wcVersion = $environment['version'] ?? 'Latest';
            $currency = $environment['currency'] ?? 'USD';

            return [
                'success' => true,
                'message' => "WooCommerce store connected successfully. Active store: {$storeName}.",
                'details' => [
                    'platform' => 'WooCommerce',
                    'store_name' => $storeName,
                    'wc_version' => $wcVersion,
                    'currency' => $currency,
                    'rest_endpoint' => $endpoint,
                    'permissions' => 'read_write',
                ],
            ];
        }

        // Test fallback endpoint in case system_status requires elevated host permissions
        if ($httpCode === 401 || $httpCode === 403) {
            $fallbackTest = $this->testFallbackProductsEndpoint($cleanUrl, $ck, $cs);
            if ($fallbackTest['success']) {
                return $fallbackTest;
            }

            return [
                'success' => false,
                'message' => "Connection failed (HTTP {$httpCode}). Invalid Consumer Key or Consumer Secret. Please verify keys in WooCommerce → Settings → Advanced → REST API.",
                'error_code' => 'AUTH_FAILED',
            ];
        }

        if ($httpCode === 404) {
            return [
                'success' => false,
                'message' => "WooCommerce REST API v3 endpoint not found. Ensure WooCommerce is installed and active, and permalinks are configured.",
                'error_code' => 'ENDPOINT_NOT_FOUND',
            ];
        }

        return [
            'success' => false,
            'message' => "WooCommerce server responded with HTTP {$httpCode}. Please check your store settings.",
            'error_code' => 'SERVER_ERROR',
        ];
    }

    private function testFallbackProductsEndpoint(string $cleanUrl, string $ck, string $cs): array
    {
        $endpoint = $cleanUrl . '/wp-json/wc/v3/products?per_page=1';
        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $ck . ':' . $cs,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);

        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code === 200) {
            return [
                'success' => true,
                'message' => "WooCommerce store connected successfully (Products API verified).",
                'details' => [
                    'platform' => 'WooCommerce',
                    'store_name' => parse_url($cleanUrl, PHP_URL_HOST),
                    'rest_endpoint' => $endpoint,
                    'permissions' => 'read_write',
                ],
            ];
        }

        return ['success' => false];
    }
}
