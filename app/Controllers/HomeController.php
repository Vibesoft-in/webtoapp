<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Theme;
use App\Models\Addon;
use App\Models\Pricing;

class HomeController extends Controller
{
    public function index(): void
    {
        $themeModel = new Theme();
        $addonModel = new Addon();
        $pricingModel = new Pricing();

        $featuredThemes = $themeModel->getActiveThemes();
        $addons = $addonModel->getAvailableAddons();
        $plans = $pricingModel->getActivePlans();

        $this->render('home.index', [
            'title' => 'Turn Your Website into iOS & Android Mobile Apps',
            'themes' => $featuredThemes,
            'addons' => $addons,
            'plans' => $plans,
        ], 'main');
    }
}
