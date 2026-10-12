<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Addon;

class AddonController extends Controller
{
    private Addon $addonModel;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->addonModel = new Addon();
    }

    public function index(): void
    {
        $addons = $this->addonModel->getAvailableAddons();
        $selectedAddons = Session::get('selected_addons') ?: [];

        $this->render('addons.index', [
            'title' => 'Choose Mobile Add-ons & Native Features',
            'addons' => $addons,
            'selectedAddons' => $selectedAddons,
        ], 'main');
    }

    public function details(array $params = []): void
    {
        $slug = $params['slug'] ?? $this->request->input('slug');
        $addon = $this->addonModel->findWhere('slug', $slug);

        if (!$addon) {
            $this->redirect(url('/addons'));
            return;
        }

        $this->render('addons.details', [
            'title' => $addon['name'] . ' - Feature Details',
            'addon' => $addon,
        ], 'main');
    }

    public function updateSelection(): void
    {
        $addonIds = $this->request->input('addon_ids', []);
        if (!is_array($addonIds)) {
            $addonIds = [];
        }

        $addonIds = array_map('intval', $addonIds);
        Session::set('selected_addons', $addonIds);

        $this->redirect(url('/checkout'));
    }
}
