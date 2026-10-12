<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Theme;
use App\Models\Addon;
use App\Models\Pricing;
use Throwable;

class HomeController extends Controller
{
    public function index(): void
    {
        $featuredThemes = [];
        $addons = [];
        $plans = [];

        try {
            $themeModel = new Theme();
            $featuredThemes = $themeModel->getActiveThemes();

            $addonModel = new Addon();
            $addons = $addonModel->getAvailableAddons();

            $pricingModel = new Pricing();
            $plans = $pricingModel->getActivePlans();
        } catch (Throwable $e) {
            // Gracefully continue so home page loads beautifully even if database is connecting/unconfigured
        }

        $this->render('home.index', [
            'title' => 'Turn Your Website into iOS & Android Mobile Apps',
            'themes' => $featuredThemes,
            'addons' => $addons,
            'plans' => $plans,
        ], 'main');
    }
}
