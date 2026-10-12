<?php

declare(strict_types=1);

namespace App\Services\WebsiteAnalyzer;

class CompatibilityEngine
{
    public function evaluate(array $results): array
    {
        $sslScore = $results['ssl']['score'] ?? 0;
        $mobileScore = $results['mobile']['score'] ?? 50;
        $apiSupported = $results['api']['supported'] ?? false;
        $platform = $results['platform']['platform'] ?? 'custom';

        $apiScore = $apiSupported ? 100 : 40;
        $platformBonus = in_array($platform, ['wordpress', 'woocommerce', 'shopify']) ? 100 : 50;

        $overallScore = (int)round(($sslScore * 0.25) + ($mobileScore * 0.25) + ($apiScore * 0.3) + ($platformBonus * 0.2));

        $recommendations = [];
        if ($sslScore < 100) {
            $recommendations[] = 'Enable an active SSL certificate to ensure secure mobile API data transit.';
        }
        if (!$apiSupported) {
            $recommendations[] = 'Verify that REST API endpoints are public and not blocked by firewall rules.';
        }
        if ($mobileScore < 80) {
            $recommendations[] = 'Ensure mobile viewport meta tag is properly configured for optimal rendering.';
        }

        return [
            'overall_score' => $overallScore,
            'platform' => $platform,
            'ssl_status' => $sslScore >= 100 ? 'passed' : 'failed',
            'api_status' => $apiSupported ? 'ready' : 'limited',
            'mobile_score' => $mobileScore,
            'recommendations' => $recommendations,
            'raw' => $results,
        ];
    }
}