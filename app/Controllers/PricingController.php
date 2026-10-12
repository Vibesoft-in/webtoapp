<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pricing;
use App\Models\Theme;
use App\Models\Addon;
use App\Services\PricingEngine\PricingCalculator;

class PricingController extends Controller
{
    private Pricing $pricingModel;
    private Theme $themeModel;
    private Addon $addonModel;
    private PricingCalculator $calculator;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->pricingModel = new Pricing();
        $this->themeModel = new Theme();
        $this->addonModel = new Addon();
        $this->calculator = new PricingCalculator();
    }

    public function index(): void
    {
        $plans = $this->pricingModel->getActivePlans();
        foreach ($plans as &$plan) {
            $rawFeatures = $plan['features'] ?? '[]';
            if (is_string($rawFeatures)) {
                $decoded = json_decode($rawFeatures, true);
                $plan['parsed_features'] = is_array($decoded) ? $decoded : [];
            } else {
                $plan['parsed_features'] = (array)$rawFeatures;
            }
            $priceFloat = (float)$plan['price'];
            $plan['formatted_price'] = '₹' . number_format($priceFloat, 0);
            $plan['formatted_usd'] = '$' . (int)round($priceFloat / 100);
        }
        unset($plan);

        $addons = $this->addonModel->where('status', 'active');
        foreach ($addons as &$addon) {
            $addonPrice = (float)$addon['price'];
            $addon['formatted_price'] = '₹' . number_format($addonPrice, 0);
        }
        unset($addon);

        $themes = $this->themeModel->where('status', 'active');

        $this->render('pricing.index', [
            'title' => 'Transparent Pricing & Investment Plans — AppifyHub',
            'plans' => $plans,
            'addons' => $addons,
            'themes' => $themes,
        ], 'main');
    }

    public function calculate(): void
    {
        $planId = (int)$this->request->input('plan_id', 1);
        $themeId = (int)$this->request->input('theme_id', 0);
        $addonIds = $this->request->input('addon_ids', []);

        if (!is_array($addonIds)) {
            $addonIds = [];
        }

        $plan = $this->pricingModel->find($planId);
        $basePrice = $plan ? (float)$plan['price'] : 4999.00;

        $themePrice = 0.00;
        if ($themeId > 0) {
            $theme = $this->themeModel->find($themeId);
            if ($theme) {
                $themePrice = (float)$theme['price'];
            }
        }

        $selectedAddons = [];
        foreach ($addonIds as $aId) {
            $addon = $this->addonModel->find((int)$aId);
            if ($addon) {
                $selectedAddons[] = [
                    'id' => (int)$addon['id'],
                    'name' => $addon['name'],
                    'price' => (float)$addon['price'],
                ];
            }
        }

        $totalBase = $basePrice + $themePrice;
        $calculation = $this->calculator->calculate($totalBase, $selectedAddons, 18.0);

        $this->json([
            'success' => true,
            'plan' => $plan,
            'theme_price' => $themePrice,
            'addons' => $selectedAddons,
            'calculation' => $calculation,
        ]);
    }
}
