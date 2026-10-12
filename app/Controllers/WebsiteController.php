<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Models\Website;
use App\Models\ImprovementRequest;
use App\Models\PlatformConfig;
use App\Models\CompatibilityReport;
use App\Services\Platform\PlatformConnectionManager;

class WebsiteController extends Controller
{
    private Website $websiteModel;
    private ImprovementRequest $improvementModel;
    private PlatformConfig $platformModel;
    private CompatibilityReport $reportModel;
    private PlatformConnectionManager $connectionManager;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->websiteModel = new Website();
        $this->improvementModel = new ImprovementRequest();
        $this->platformModel = new PlatformConfig();
        $this->reportModel = new CompatibilityReport();
        $this->connectionManager = new PlatformConnectionManager();
    }

    /**
     * Interactive Compatibility Analyzer Wizard View
     */
    public function enterWebsite(): void
    {
        if (!Session::has('user_id')) {
            $currentUri = $_SERVER['REQUEST_URI'] ?? url('/convert');
            Session::set('intended_url', $currentUri);
            Session::flash('info', 'Please create an account or log in to analyze and convert your website.');
            $this->redirect(url('/register?redirect=' . urlencode($currentUri)));
            return;
        }

        $platforms = $this->platformModel->getAllActive();
        $currentUrl = (string)Session::get('current_website_url', '');
        $currentWebsiteId = Session::get('current_website_id');
        $currentPlatform = (string)Session::get('current_website_platform', '');
        $currentWebsiteName = (string)Session::get('current_website_name', '');

        // If not in session, load user's existing website record from DB
        if (empty($currentUrl) && Session::has('user_id')) {
            $userWebsites = $this->websiteModel->where('user_id', (int)Session::get('user_id'));
            if (!empty($userWebsites)) {
                $latest = end($userWebsites);
                $currentWebsiteId = (int)$latest['id'];
                $currentUrl = (string)$latest['url'];
                $currentPlatform = (string)$latest['platform'];
                Session::set('current_website_id', $currentWebsiteId);
                Session::set('current_website_url', $currentUrl);
                Session::set('current_website_platform', $currentPlatform);
            }
        }

        $this->render('website.enter-website', [
            'title' => 'Website Compatibility Analyzer - AppifyHub',
            'platforms' => $platforms,
            'currentUrl' => $currentUrl,
            'currentWebsiteId' => $currentWebsiteId,
            'currentPlatform' => $currentPlatform,
            'currentWebsiteName' => $currentWebsiteName,
        ], 'main');
    }

    /**
     * AJAX: Detect or suggest platform from website URL
     */
    public function detectPlatform(): void
    {
        if (!Session::has('user_id')) {
            $this->json([
                'success' => false,
                'message' => 'Please register or log in first.',
                'redirect' => url('/register?redirect=' . urlencode(url('/convert')))
            ], 401);
            return;
        }

        $url = trim((string)$this->request->input('url', ''));
        $selectedPlatform = strtolower(trim((string)$this->request->input('platform', '')));

        if (empty($url)) {
            $this->json(['success' => false, 'message' => 'Please enter a website URL.'], 400);
            return;
        }

        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://' . $url;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->json(['success' => false, 'message' => 'Invalid website URL format.'], 400);
            return;
        }

        $parsed = parse_url($url);
        $domain = $parsed['host'] ?? $url;
        $userId = Session::get('user_id');

        // Auto-detect platform
        $detection = $this->connectionManager->detect($url);
        $detectedPlatform = $detection['platform'] ?? 'unsupported';

        // Check if supported (strictly WooCommerce, WordPress, Shopify)
        if (!in_array($detectedPlatform, ['woocommerce', 'shopify', 'wordpress'], true)) {
            $this->json([
                'success' => false,
                'is_custom' => true,
                'unsupported' => true,
                'message' => 'Custom Platform Detected: This website appears to be built on a custom platform. We only convert websites built on WooCommerce, WordPress, and Shopify.',
            ], 422);
            return;
        }

        // Platform mismatch check against currently selected platform
        $platformMismatch = false;
        $mismatchMessage = '';
        if (!empty($selectedPlatform) && in_array($selectedPlatform, ['woocommerce', 'shopify', 'wordpress'], true)) {
            if ($selectedPlatform !== $detectedPlatform) {
                // WordPress with WooCommerce exception
                if (!($selectedPlatform === 'wordpress' && $detectedPlatform === 'woocommerce')) {
                    $platformMismatch = true;
                    $platformNames = ['woocommerce' => 'WooCommerce', 'shopify' => 'Shopify', 'wordpress' => 'WordPress'];
                    $selName = $platformNames[$selectedPlatform] ?? ucfirst($selectedPlatform);
                    $detName = $platformNames[$detectedPlatform] ?? ucfirst($detectedPlatform);
                    $mismatchMessage = "The entered website runs on {$detName}, but {$selName} is selected. Please switch your selection to {$detName} or enter a {$selName} URL.";
                }
            }
        }

        // Find or create website record
        $existing = $this->websiteModel->findWhere('domain', $domain);
        if ($existing) {
            $websiteId = (int)$existing['id'];
            $this->websiteModel->update($websiteId, [
                'url' => $url,
                'platform' => $detectedPlatform,
                'ssl_enabled' => str_starts_with($url, 'https://') ? 1 : 0,
                'last_checked_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $websiteId = (int)$this->websiteModel->create([
                'user_id' => $userId ?: null,
                'url' => $url,
                'domain' => $domain,
                'platform' => $detectedPlatform,
                'ssl_enabled' => str_starts_with($url, 'https://') ? 1 : 0,
                'status' => 'pending',
                'last_checked_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        Session::set('current_website_id', $websiteId);
        Session::set('current_website_url', $url);
        Session::set('current_website_platform', $detectedPlatform);

        $this->json([
            'success' => true,
            'website_id' => $websiteId,
            'url' => $url,
            'domain' => $domain,
            'detected_platform' => $detectedPlatform,
            'suggested_platform' => $detectedPlatform,
            'platform_mismatch' => $platformMismatch,
            'mismatch_message' => $mismatchMessage,
            'confidence' => $detection['confidence'] ?? 95,
            'ssl_active' => str_starts_with($url, 'https://'),
        ]);
    }

    /**
     * AJAX: Check if entered URL matches selected platform
     */
    public function checkPlatformMatch(): void
    {
        $url = trim((string)$this->request->input('url', ''));
        $manual = (bool)$this->request->input('manual', false);
        $platform = strtolower(trim((string)$this->request->input('platform', '')));

        if (empty($url)) {
            $this->json(['success' => false, 'message' => 'Please enter a website URL.'], 400);
            return;
        }

        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://' . $url;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->json(['success' => false, 'message' => 'Invalid website URL format.'], 400);
            return;
        }

        $checkPlatform = $manual ? $platform : 'auto';
        $verification = $this->connectionManager->verifyUrlMatchesPlatform($url, $checkPlatform);

        $detectedPlatform = $verification['detected_platform'] ?? null;
        $isCustom = ($detectedPlatform === 'custom' || $detectedPlatform === 'unsupported' || !empty($verification['is_custom']));

        $this->json([
            'success' => true,
            'matched' => (bool)$verification['matches'],
            'matches' => (bool)$verification['matches'],
            'is_custom' => $isCustom,
            'is_supported' => !$isCustom,
            'detected_platform' => $isCustom ? 'custom' : $detectedPlatform,
            'auto_platform' => (!$isCustom && in_array($detectedPlatform, ['woocommerce', 'shopify', 'wordpress'], true)) ? $detectedPlatform : null,
            'selected_platform' => $verification['selected_platform'] ?? $platform,
            'message' => $verification['message'],
        ]);
    }

    /**
     * AJAX: Get platform guide details
     */
    public function getPlatformGuide(array|string $params = []): void
    {
        $platformKey = is_array($params) ? ($params['platform'] ?? $params['key'] ?? '') : (string)$params;
        $config = $this->platformModel->getByKey(trim($platformKey));
        if (!$config) {
            $this->json(['success' => false, 'message' => 'Platform not found'], 404);
            return;
        }

        $this->json([
            'success' => true,
            'platform' => $config,
        ]);
    }

    /**
     * AJAX: Verify connection credentials
     */
    public function verifyConnection(): void
    {
        $platform = trim((string)$this->request->input('platform', ''));
        $websiteId = (int)($this->request->input('website_id') ?: Session::get('current_website_id'));
        $credentials = $this->request->all();

        if (empty($platform)) {
            $this->json(['success' => false, 'message' => 'Platform is required.'], 400);
            return;
        }

        // Enforce URL platform match before testing API credentials
        $url = trim((string)($credentials['url'] ?? Session::get('current_website_url') ?? ''));
        if (!empty($url)) {
            $verificationCheck = $this->connectionManager->verifyUrlMatchesPlatform($url, $platform);
            if (!$verificationCheck['matches']) {
                $this->json([
                    'success' => false,
                    'message' => $verificationCheck['message'],
                    'platform_mismatch' => true,
                    'detected_platform' => $verificationCheck['detected_platform'] ?? null,
                    'selected_platform' => $platform,
                ], 422);
                return;
            }
        }

        $verification = $this->connectionManager->verifyConnection($platform, $credentials, $websiteId ?: null);

        if ($verification['success'] && $websiteId) {
            $this->websiteModel->update($websiteId, [
                'platform' => $platform,
                'status' => 'connected',
                'last_checked_at' => date('Y-m-d H:i:s'),
            ]);
            Session::set('verified_platform_' . $websiteId, $platform);
            Session::set('connection_details_' . $websiteId, $verification['details'] ?? []);
        }

        $this->json($verification);
    }

    /**
     * AJAX: Execute full compatibility analysis
     */
    public function runAnalysis(): void
    {
        $websiteId = (int)($this->request->input('website_id') ?: Session::get('current_website_id'));
        $website = $this->websiteModel->find($websiteId);

        if (!$website) {
            $url = trim((string)$this->request->input('url', ''));
            if (!$url) {
                $this->json(['success' => false, 'message' => 'Website not found.'], 404);
                return;
            }
            $website = ['id' => 0, 'url' => $url, 'domain' => parse_url($url, PHP_URL_HOST) ?: $url];
        }

        $platform = (string)($this->request->input('platform') ?: $website['platform'] ?: 'wordpress');
        $connectionDetails = Session::get('connection_details_' . $websiteId, ['success' => true]);

        // Run thorough evaluation
        $result = $this->connectionManager->runFullAnalysis($website['url'], $platform, $connectionDetails);

        // Persist report if website exists
        if ($websiteId) {
            $reportId = $this->reportModel->create([
                'website_id' => $websiteId,
                'overall_score' => $result['overall_score'],
                'platform_status' => $result['platform'],
                'ssl_status' => $result['ssl_status'],
                'api_status' => $result['api_status'],
                'mobile_score' => $result['mobile_score'],
                'report_summary' => $result['summary'],
                'recommendations' => json_encode(array_column($result['issues'], 'solution')),
                'raw_metrics' => json_encode($result['metrics']),
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $this->websiteModel->update($websiteId, [
                'platform' => $result['platform'],
                'ssl_enabled' => $result['ssl_status'] === 'passed' ? 1 : 0,
                'status' => $result['is_compatible'] ? 'compatible' : 'incompatible',
                'last_checked_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->json([
            'success' => true,
            'website_id' => $websiteId,
            'url' => $website['url'],
            'domain' => $website['domain'],
            'overall_score' => $result['overall_score'],
            'is_compatible' => $result['is_compatible'],
            'platform' => $result['platform'],
            'metrics' => $result['metrics'],
            'issues' => $result['issues'],
            'summary' => $result['summary'],
            'redirect_themes' => url('/themes'),
            'redirect_improvements' => url('/website/improvement-form?website_id=' . $websiteId),
        ]);
    }

    /**
     * Fallback traditional form submission
     */
    public function startAnalysis(): void
    {
        if (!Session::has('user_id')) {
            Session::set('intended_url', url('/convert'));
            $this->redirect(url('/register?redirect=' . urlencode(url('/convert'))));
            return;
        }

        $url = trim((string)$this->request->input('url', ''));

        if (!filter_var($url, FILTER_VALIDATE_URL) && !filter_var('https://' . $url, FILTER_VALIDATE_URL)) {
            Session::flash('error', 'Please enter a valid website URL (e.g., https://mystore.com).');
            $this->redirect(url('/convert'));
            return;
        }

        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://' . $url;
        }

        $parsed = parse_url($url);
        $domain = $parsed['host'] ?? $url;
        $userId = Session::get('user_id');

        $existing = $this->websiteModel->findWhere('domain', $domain);
        if ($existing) {
            $websiteId = (int)$existing['id'];
        } else {
            $websiteId = (int)$this->websiteModel->create([
                'user_id' => $userId ?: null,
                'url' => $url,
                'domain' => $domain,
                'platform' => 'detecting',
                'ssl_enabled' => str_starts_with($url, 'https://') ? 1 : 0,
                'status' => 'analyzing',
                'last_checked_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        Session::set('current_website_id', $websiteId);
        Session::set('current_website_url', $url);

        $this->redirect(url('/convert'));
    }

    public function analyzing(): void
    {
        if (!Session::has('user_id')) {
            $this->redirect(url('/register?redirect=' . urlencode(url('/convert'))));
            return;
        }

        $websiteId = (int)($this->request->input('id') ?: Session::get('current_website_id'));
        $website = $this->websiteModel->find($websiteId);

        if (!$website) {
            $this->redirect(url('/convert'));
            return;
        }

        $this->render('website.analyzing', [
            'title' => 'Analyzing Website Compatibility...',
            'website' => $website,
        ], 'main');
    }

    public function improvementForm(): void
    {
        if (!Session::has('user_id')) {
            $this->redirect(url('/register?redirect=' . urlencode(url('/convert'))));
            return;
        }

        $websiteId = (int)($this->request->input('website_id') ?: Session::get('current_website_id'));
        $website = $this->websiteModel->find($websiteId);

        $this->render('website.improvement-form', [
            'title' => 'Submit Website Improvement Request',
            'website' => $website,
        ], 'main');
    }

    public function submitImprovement(): void
    {
        $data = $this->request->all();
        $websiteId = (int)($data['website_id'] ?? Session::get('current_website_id'));
        $userId = Session::get('user_id');

        $validator = new Validator($data);
        $validator->required('issue_type')
                  ->required('description')->min('description', 10);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', $data);
            $this->redirect(url('/website/improvement-form?website_id=' . $websiteId));
            return;
        }

        $this->improvementModel->create([
            'website_id' => $websiteId,
            'user_id' => $userId ?: null,
            'issue_type' => trim($data['issue_type']),
            'description' => trim($data['description']),
            'notes' => trim($data['notes'] ?? ''),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', 'Your improvement request has been submitted! Our engineering team will review your site and assist.');
        $this->redirect(url('/compatibility-result?id=' . $websiteId));
    }
}
