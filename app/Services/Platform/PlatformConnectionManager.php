<?php

declare(strict_types=1);

namespace App\Services\Platform;

use App\Models\PlatformConfig;
use App\Models\WebsiteCredential;
use App\Services\WebsiteAnalyzer\PlatformDetector;
use App\Services\WebsiteAnalyzer\SSLChecker;
use App\Services\WebsiteAnalyzer\MobileCompatibility;

class PlatformConnectionManager
{
    private PlatformConfig $platformConfig;
    private WebsiteCredential $credentialModel;
    private WordPressConnector $wpConnector;
    private WooCommerceConnector $wooConnector;
    private ShopifyConnector $shopifyConnector;
    private PlatformDetector $detector;
    private SSLChecker $sslChecker;
    private MobileCompatibility $mobileChecker;

    public function __construct()
    {
        $this->platformConfig = new PlatformConfig();
        $this->credentialModel = new WebsiteCredential();
        $this->wpConnector = new WordPressConnector();
        $this->wooConnector = new WooCommerceConnector();
        $this->shopifyConnector = new ShopifyConnector();
        $this->detector = new PlatformDetector();
        $this->sslChecker = new SSLChecker();
        $this->mobileChecker = new MobileCompatibility();
    }

    /**
     * Detect platform from URL.
     */
    public function detect(string $url): array
    {
        $cleanUrl = trim($url);
        if (!preg_match('#^https?://#i', $cleanUrl)) {
            $cleanUrl = 'https://' . $cleanUrl;
        }

        $detected = $this->detector->detect($cleanUrl);
        $platformKey = $detected['platform'];
        
        $config = null;
        if (in_array($platformKey, ['wordpress', 'woocommerce', 'shopify'])) {
            $config = $this->platformConfig->getByKey($platformKey);
        }

        return [
            'success' => true,
            'url' => $cleanUrl,
            'domain' => parse_url($cleanUrl, PHP_URL_HOST) ?: $cleanUrl,
            'platform' => in_array($platformKey, ['wordpress', 'woocommerce', 'shopify']) ? $platformKey : null,
            'confidence' => $detected['confidence'] ?? 50,
            'details' => $detected['details'] ?? [],
            'config' => $config,
        ];
    }

    /**
     * Check if an entered URL belongs to the selected platform.
     */
    public function verifyUrlMatchesPlatform(string $url, string $selectedPlatform): array
    {
        return $this->detector->verifyUrlMatchesPlatform($url, $selectedPlatform);
    }

    /**
     * Verify credentials for chosen platform.
     */
    public function verifyConnection(string $platform, array $credentials, ?int $websiteId = null): array
    {
        $result = [
            'success' => false,
            'message' => 'Unknown platform selected.',
        ];

        switch ($platform) {
            case 'wordpress':
                $url = (string)($credentials['url'] ?? '');
                $username = (string)($credentials['username'] ?? '');
                $password = (string)($credentials['application_password'] ?? '');

                if (empty($url) || empty($username) || empty($password)) {
                    return [
                        'success' => false,
                        'message' => 'Please fill in all required fields: Website URL, Username, and Application Password.',
                    ];
                }

                $result = $this->wpConnector->verify($url, $username, $password);
                break;

            case 'woocommerce':
                $url = (string)($credentials['url'] ?? '');
                $ck = (string)($credentials['consumer_key'] ?? '');
                $cs = (string)($credentials['consumer_secret'] ?? '');

                if (empty($url) || empty($ck) || empty($cs)) {
                    return [
                        'success' => false,
                        'message' => 'Please fill in all required fields: Store URL, Consumer Key, and Consumer Secret.',
                    ];
                }

                $result = $this->wooConnector->verify($url, $ck, $cs);
                break;

            case 'shopify':
                $url = (string)($credentials['url'] ?? '');
                $token = (string)($credentials['access_token'] ?? '');

                if (empty($url) || empty($token)) {
                    return [
                        'success' => false,
                        'message' => 'Please fill in all required fields: Shopify Store URL and Admin API Access Token.',
                    ];
                }

                $result = $this->shopifyConnector->verify($url, $token);
                break;
        }

        // Securely store credentials if websiteId is provided
        if ($websiteId) {
            $this->credentialModel->saveCredentials(
                $websiteId,
                $platform,
                $credentials,
                $result['success'],
                $result['success'] ? null : ($result['message'] ?? 'Failed')
            );
        }

        return $result;
    }

    /**
     * Run full website compatibility analysis once connected.
     */
    public function runFullAnalysis(string $url, string $platform, ?array $connectionDetails = null): array
    {
        $cleanUrl = trim($url);
        if (!preg_match('#^https?://#i', $cleanUrl)) {
            $cleanUrl = 'https://' . $cleanUrl;
        }

        $sslResult = $this->sslChecker->check($cleanUrl);
        $mobileResult = $this->mobileChecker->check($cleanUrl);
        
        $sslScore = $sslResult['score'] ?? 0;
        $mobileScore = $mobileResult['score'] ?? 85;
        $apiConnected = !empty($connectionDetails['success']) || !empty($connectionDetails['permissions']);

        $apiScore = $apiConnected ? 100 : 30;
        $platformScore = in_array($platform, ['wordpress', 'woocommerce', 'shopify']) ? 100 : 40;

        // Calculate score
        $overallScore = (int)round(($sslScore * 0.3) + ($mobileScore * 0.25) + ($apiScore * 0.35) + ($platformScore * 0.1));

        $isCompatible = ($overallScore >= 65) && ($sslScore >= 100) && $apiConnected;

        $issues = [];
        if ($sslScore < 100) {
            $issues[] = [
                'problem' => 'Missing or Incomplete SSL Certificate (HTTPS)',
                'why' => 'Apple App Store and Google Play require all API data transmission to be encrypted via HTTPS.',
                'solution' => 'Install and enable a valid SSL certificate on your web hosting server.',
            ];
        }

        if (!$apiConnected) {
            $issues[] = [
                'problem' => 'REST API / Token Authentication Failed',
                'why' => 'Without verified API access, the mobile app cannot fetch live products, cart, or user accounts.',
                'solution' => 'Generate valid API credentials following the step-by-step platform guide.',
            ];
        }

        if ($mobileScore < 70) {
            $issues[] = [
                'problem' => 'Mobile Viewport Incomplete',
                'why' => 'Certain mobile elements may cause layout clipping or responsive display anomalies in WebViews.',
                'solution' => 'Ensure meta name="viewport" is properly set to width=device-width, initial-scale=1.0.',
            ];
        }

        return [
            'overall_score' => $overallScore,
            'is_compatible' => $isCompatible,
            'platform' => $platform,
            'ssl_status' => $sslScore >= 100 ? 'passed' : 'failed',
            'api_status' => $apiConnected ? 'ready' : 'limited',
            'mobile_score' => $mobileScore,
            'metrics' => [
                'Platform' => ucfirst($platform) . ' (Supported)',
                'HTTPS / SSL' => $sslScore >= 100 ? 'Active & Valid' : 'Insecure / Missing',
                'API Connection' => $apiConnected ? 'Verified & Authenticated' : 'Not Connected',
                'Data Access' => $apiConnected ? 'Real-Time Sync Ready' : 'Limited',
                'Mobile Viewport' => "{$mobileScore}% Responsive",
                'App Readiness' => $isCompatible ? '100% Native Compilation Ready' : 'Needs Technical Improvements',
            ],
            'issues' => $issues,
            'summary' => $isCompatible
                ? "Your website is fully verified and ready for native iOS & Android compilation."
                : "Your website requires a few technical adjustments before AppifyHub can build your mobile app.",
        ];
    }
}
