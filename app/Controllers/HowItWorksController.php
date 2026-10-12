<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PlatformConfig;
use App\Models\Theme;
use App\Models\Pricing;

class HowItWorksController extends Controller
{
    private PlatformConfig $platformModel;
    private Theme $themeModel;
    private Pricing $pricingModel;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->platformModel = new PlatformConfig();
        $this->themeModel = new Theme();
        $this->pricingModel = new Pricing();
    }

    public function index(): void
    {
        $platforms = $this->platformModel->getAllActive();
        $themes = $this->themeModel->getActiveThemes();
        $plans = $this->pricingModel->getActivePlans();

        $this->render('how-it-works.index', [
            'title' => 'How It Works | AppifyHub',
            'metaDescription' => 'Learn how AppifyHub converts your WordPress, WooCommerce or Shopify website into a mobile app through compatibility analysis, API integration, app configuration and testing.',
            'platforms' => $platforms,
            'themes' => $themes,
            'plans' => $plans,
        ], 'main');
    }
}
