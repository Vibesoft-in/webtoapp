<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Website;
use App\Models\CompatibilityReport;
use App\Services\WebsiteAnalyzer\WebsiteAnalyzer;

class CompatibilityController extends Controller
{
    private Website $websiteModel;
    private CompatibilityReport $reportModel;
    private WebsiteAnalyzer $analyzer;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->websiteModel = new Website();
        $this->reportModel = new CompatibilityReport();
        $this->analyzer = new WebsiteAnalyzer();
    }

    public function check(): void
    {
        $websiteId = (int)($this->request->input('website_id') ?: Session::get('current_website_id'));
        $website = $this->websiteModel->find($websiteId);

        if (!$website) {
            $this->json(['error' => 'Website not found'], 404);
            return;
        }

        // Run analysis via the service layer
        $result = $this->analyzer->analyze($website['url']);

        // Persist report
        $reportId = $this->reportModel->create([
            'website_id' => $websiteId,
            'overall_score' => $result['overall_score'],
            'platform_status' => $result['platform'],
            'ssl_status' => $result['ssl_status'],
            'api_status' => $result['api_status'],
            'mobile_score' => $result['mobile_score'],
            'report_summary' => "Evaluation for {$website['domain']}: {$result['overall_score']}% overall readiness.",
            'recommendations' => json_encode($result['recommendations']),
            'raw_metrics' => json_encode($result['raw']),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Update website status
        $isCompatible = $result['overall_score'] >= 65 && $result['ssl_status'] === 'passed';
        $this->websiteModel->update($websiteId, [
            'platform' => $result['platform'],
            'ssl_enabled' => $result['ssl_status'] === 'passed' ? 1 : 0,
            'status' => $isCompatible ? 'compatible' : 'incompatible',
            'last_checked_at' => date('Y-m-d H:i:s'),
        ]);

        if ($this->request->isJson()) {
            $this->json([
                'success' => true,
                'website_id' => $websiteId,
                'report_id' => $reportId,
                'overall_score' => $result['overall_score'],
                'is_compatible' => $isCompatible,
                'redirect' => url('/compatibility-result?id=' . $websiteId),
            ]);
            return;
        }

        $this->redirect(url('/compatibility-result?id=' . $websiteId));
    }

    public function result(): void
    {
        if (!Session::has('user_id')) {
            $currentUri = $_SERVER['REQUEST_URI'] ?? url('/convert');
            Session::set('intended_url', $currentUri);
            $this->redirect(url('/register?redirect=' . urlencode($currentUri)));
            return;
        }

        $websiteId = (int)($this->request->input('id') ?: Session::get('current_website_id'));
        $website = $this->websiteModel->find($websiteId);

        if (!$website) {
            $this->redirect(url('/convert'));
            return;
        }

        $report = $this->reportModel->getLatestByWebsiteId($websiteId);

        $isCompatible = false;
        if ($report) {
            $isCompatible = ($report['overall_score'] >= 65) && ($report['ssl_status'] === 'passed');
        }

        $this->render('website.compatibility-result', [
            'title' => 'Compatibility Report - ' . htmlspecialchars($website['domain']),
            'website' => $website,
            'report' => $report,
            'isCompatible' => $isCompatible,
        ], 'main');
    }
}
