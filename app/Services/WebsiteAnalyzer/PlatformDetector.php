<?php

declare(strict_types=1);

namespace App\Services\WebsiteAnalyzer;

class PlatformDetector
{
    /**
     * Detect platform from URL.
     */
    public function detect(string $url): array
    {
        $cleanUrl = trim($url);
        if (!preg_match('#^https?://#i', $cleanUrl)) {
            $cleanUrl = 'https://' . $cleanUrl;
        }

        $parsed = parse_url($cleanUrl);
        $host = strtolower($parsed['host'] ?? '');

        // 1. Immediate domain pattern checks
        if (str_ends_with($host, '.myshopify.com')) {
            return [
                'platform' => 'shopify',
                'confidence' => 100,
                'details' => ['domain_pattern' => 'myshopify.com'],
            ];
        }

        $page = $this->fetchPage($cleanUrl);
        $headers = $page['headers'];
        $html = $page['body'];

        // 2. Shopify detection (headers, CDN, scripts)
        $isShopify = (
            str_contains($headers, 'x-shopid') ||
            str_contains($headers, 'x-shopify-stage') ||
            str_contains($html, 'cdn.shopify.com') ||
            str_contains($html, 'cdn.shopifycdn.net') ||
            str_contains($html, 'Shopify.theme') ||
            str_contains($html, 'Shopify.currency') ||
            str_contains($html, 'window.Shopify') ||
            str_contains($html, 'myshopify.com')
        );

        if ($isShopify) {
            return [
                'platform' => 'shopify',
                'confidence' => 95,
                'details' => ['detected_signatures' => 'Shopify framework & assets'],
            ];
        }

        // 3. WordPress & WooCommerce detection
        $isWp = (
            str_contains($headers, 'x-pingback') ||
            str_contains($headers, 'api.w.org') ||
            str_contains($html, '/wp-content/') ||
            str_contains($html, '/wp-includes/') ||
            str_contains($html, 'wp-json') ||
            preg_match('/<meta[^>]+name=["\']generator["\'][^>]+content=["\'][^"\']*wordpress/i', $html)
        );

        $isWoo = (
            str_contains($html, 'woocommerce') ||
            str_contains($html, 'wc-ajax') ||
            str_contains($html, 'plugins/woocommerce') ||
            str_contains($html, 'wc-block') ||
            str_contains($html, 'woocommerce-price-amount') ||
            preg_match('/<meta[^>]+name=["\']generator["\'][^>]+content=["\'][^"\']*woocommerce/i', $html)
        );

        if ($isWp || $isWoo) {
            if ($isWoo) {
                return [
                    'platform' => 'woocommerce',
                    'confidence' => 95,
                    'details' => ['has_woocommerce' => true, 'is_wordpress' => true],
                ];
            }

            // Check WooCommerce REST API endpoint
            $wcApi = $this->fetchPage(rtrim($cleanUrl, '/') . '/wp-json/wc/v3');
            if (in_array($wcApi['http_code'], [200, 401, 403], true) && str_contains($wcApi['body'], 'woocommerce')) {
                return [
                    'platform' => 'woocommerce',
                    'confidence' => 95,
                    'details' => ['has_woocommerce_api' => true, 'is_wordpress' => true],
                ];
            }

            return [
                'platform' => 'wordpress',
                'confidence' => 90,
                'details' => ['is_wordpress' => true, 'has_woocommerce' => false],
            ];
        }

        // 4. Fallback heuristics if offline or blocked
        if (!$page['success'] || empty($html)) {
            if (str_contains($host, 'shopify')) {
                return ['platform' => 'shopify', 'confidence' => 80, 'details' => ['fallback' => 'host_keyword']];
            }
            if (str_contains($host, 'woo')) {
                return ['platform' => 'woocommerce', 'confidence' => 80, 'details' => ['fallback' => 'host_keyword']];
            }
            if (str_contains($host, 'wordpress') || str_contains($host, 'wp')) {
                return ['platform' => 'wordpress', 'confidence' => 80, 'details' => ['fallback' => 'host_keyword']];
            }
            return [
                'platform' => 'unknown',
                'confidence' => 0,
                'details' => ['unreachable' => true, 'error' => $page['error']],
            ];
        }

        return [
            'platform' => 'custom',
            'confidence' => 30,
            'details' => ['supported_cms' => false],
        ];
    }

    /**
     * Check if entered URL matches selected platform.
     */
    public function verifyUrlMatchesPlatform(string $url, string $selectedPlatform): array
    {
        $selectedPlatform = strtolower(trim($selectedPlatform));
        $detection = $this->detect($url);
        $detectedPlatform = $detection['platform'];

        $names = [
            'woocommerce' => 'WooCommerce',
            'shopify' => 'Shopify',
            'wordpress' => 'WordPress',
        ];

        // Auto-detection mode (no platform manually locked by user)
        if (empty($selectedPlatform) || $selectedPlatform === 'auto') {
            if (in_array($detectedPlatform, ['woocommerce', 'shopify', 'wordpress'], true)) {
                $detectedName = $names[$detectedPlatform] ?? ucfirst($detectedPlatform);
                return [
                    'matches' => true,
                    'is_custom' => false,
                    'selected_platform' => $detectedPlatform,
                    'detected_platform' => $detectedPlatform,
                    'message' => "Website verified: Automatically detected and selected {$detectedName}.",
                ];
            }

            return [
                'matches' => false,
                'is_custom' => true,
                'selected_platform' => '',
                'detected_platform' => 'custom',
                'message' => "Custom Platform Detected: This website appears to be built on a custom platform. AppifyHub only converts websites built on WooCommerce, Shopify, or WordPress.",
            ];
        }

        $selectedName = $names[$selectedPlatform] ?? ucfirst($selectedPlatform);

        // Exact match
        if ($detectedPlatform === $selectedPlatform) {
            return [
                'matches' => true,
                'is_custom' => false,
                'selected_platform' => $selectedPlatform,
                'detected_platform' => $detectedPlatform,
                'message' => "Website verified as a {$selectedName} platform.",
            ];
        }

        // WooCommerce runs on WordPress; if user selected WordPress and store has WooCommerce, it's valid
        if ($selectedPlatform === 'wordpress' && $detectedPlatform === 'woocommerce') {
            return [
                'matches' => true,
                'is_custom' => false,
                'selected_platform' => $selectedPlatform,
                'detected_platform' => $detectedPlatform,
                'message' => "WordPress website verified (WooCommerce active).",
            ];
        }

        // Custom / unsupported platform site
        if ($detectedPlatform === 'unsupported' || $detectedPlatform === 'custom') {
            return [
                'matches' => false,
                'is_custom' => true,
                'selected_platform' => $selectedPlatform,
                'detected_platform' => 'custom',
                'message' => "Custom Platform Detected: This website appears to be built on a custom platform. AppifyHub only converts websites built on WooCommerce, Shopify, or WordPress.",
            ];
        }

        // User selected a supported platform but site is another supported platform
        if (in_array($detectedPlatform, ['woocommerce', 'shopify', 'wordpress'], true)) {
            $detectedName = $names[$detectedPlatform] ?? ucfirst($detectedPlatform);
            return [
                'matches' => false,
                'is_custom' => false,
                'selected_platform' => $selectedPlatform,
                'detected_platform' => $detectedPlatform,
                'message' => "The URL entered appears to be a {$detectedName} website, but you selected {$selectedName}. Please switch back to {$detectedName} or enter your {$selectedName} URL.",
            ];
        }

        // Unreachable (timeout / DNS / local test URL)
        if ($detectedPlatform === 'unknown') {
            $parsed = parse_url($url);
            $host = strtolower($parsed['host'] ?? $url);
            if (str_contains($host, 'myshopify.com') && $selectedPlatform !== 'shopify') {
                return [
                    'matches' => false,
                    'selected_platform' => $selectedPlatform,
                    'detected_platform' => 'shopify',
                    'message' => "The entered domain (*.myshopify.com) is a Shopify store, but you selected {$selectedName}. Please select Shopify.",
                ];
            }

            // Allow offline/local dev domain with note
            return [
                'matches' => true,
                'selected_platform' => $selectedPlatform,
                'detected_platform' => $selectedPlatform,
                'warning' => 'Unable to connect to website to verify platform headers in real-time. Verification will complete during API credential check.',
                'message' => "Platform accepted. Connection will be tested during API credential verification.",
            ];
        }

        return [
            'matches' => false,
            'selected_platform' => $selectedPlatform,
            'detected_platform' => $detectedPlatform,
            'message' => "The entered website does not match the selected {$selectedName} platform.",
        ];
    }

    /**
     * Fast cURL fetcher for headers & body with fallback.
     */
    private function fetchPage(string $url): array
    {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 3,
                CURLOPT_TIMEOUT => 6,
                CURLOPT_CONNECTTIMEOUT => 4,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 AppifyHub/1.0',
            ]);

            $response = curl_exec($ch);
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($response !== false) {
                return [
                    'success' => true,
                    'http_code' => $httpCode,
                    'headers' => strtolower(substr((string)$response, 0, $headerSize)),
                    'body' => substr((string)$response, $headerSize),
                    'error' => null,
                ];
            }
        }

        // Fallback using stream context
        $ctx = stream_context_create([
            'http' => [
                'timeout' => 5,
                'user_agent' => 'Mozilla/5.0 (AppifyHub Analyzer/1.0)',
                'ignore_errors' => true,
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $headers = @get_headers($url, true) ?: [];
        $html = @file_get_contents($url, false, $ctx) ?: '';

        if (!empty($html) || !empty($headers)) {
            return [
                'success' => true,
                'http_code' => 200,
                'headers' => strtolower(json_encode($headers) ?: ''),
                'body' => (string)$html,
                'error' => null,
            ];
        }

        return [
            'success' => false,
            'http_code' => 0,
            'headers' => '',
            'body' => '',
            'error' => 'Connection timed out or host unreachable',
        ];
    }
}