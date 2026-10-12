<?php

declare(strict_types=1);

namespace App\Services\WebsiteAnalyzer;

class WebsiteAnalyzer
{
    private PlatformDetector $platformDetector;
    private SSLChecker $sslChecker;
    private MobileCompatibility $mobileCompatibility;
    private APICompatibility $apiCompatibility;
    private CompatibilityEngine $engine;

    public function __construct()
    {
        $this->platformDetector = new PlatformDetector();
        $this->sslChecker = new SSLChecker();
        $this->mobileCompatibility = new MobileCompatibility();
        $this->apiCompatibility = new APICompatibility();
        $this->engine = new CompatibilityEngine();
    }

    public function analyze(string $url): array
    {
        $sanitizedUrl = $this->sanitizeUrl($url);
        
        $sslResult = $this->sslChecker->check($sanitizedUrl);
        $platformResult = $this->platformDetector->detect($sanitizedUrl);
        $mobileResult = $this->mobileCompatibility->check($sanitizedUrl);
        $apiResult = $this->apiCompatibility->test($sanitizedUrl, $platformResult['platform']);

        return $this->engine->evaluate([
            'url' => $sanitizedUrl,
            'ssl' => $sslResult,
            'platform' => $platformResult,
            'mobile' => $mobileResult,
            'api' => $apiResult,
        ]);
    }

    private function sanitizeUrl(string $url): string
    {
        $url = trim($url);
        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://' . $url;
        }
        return rtrim($url, '/');
    }
}