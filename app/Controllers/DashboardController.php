<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\App;
use App\Models\AppFeature;
use App\Models\Build;
use App\Models\Order;
use App\Models\Notification;
use App\Models\SupportTicket;

class DashboardController extends Controller
{
    private App $appModel;
    private AppFeature $featureModel;
    private Build $buildModel;
    private Order $orderModel;
    private Notification $notificationModel;
    private SupportTicket $ticketModel;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->appModel = new App();
        $this->featureModel = new AppFeature();
        $this->buildModel = new Build();
        $this->orderModel = new Order();
        $this->notificationModel = new Notification();
        $this->ticketModel = new SupportTicket();
    }

    private function getUserId(): int
    {
        return (int)Session::get('user_id');
    }

    public function index(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $orders = $this->orderModel->getByUser($userId);
        $notifications = $this->notificationModel->getByUser($userId);

        $this->render('dashboard.index', [
            'title' => 'Customer Dashboard',
            'apps' => $apps,
            'orders' => $orders,
            'notifications' => $notifications,
        ], 'dashboard');
    }

    public function myApp(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $currentApp = !empty($apps) ? $apps[0] : null;

        $this->render('dashboard.my-app', [
            'title' => 'My Mobile App',
            'app' => $currentApp,
        ], 'dashboard');
    }

    public function appSettings(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $currentApp = !empty($apps) ? $apps[0] : null;

        $this->render('dashboard.app-settings', [
            'title' => 'App Configuration & Branding',
            'app' => $currentApp,
        ], 'dashboard');
    }

    public function features(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $currentApp = !empty($apps) ? $apps[0] : null;
        $features = $currentApp ? $this->featureModel->getByAppId((int)$currentApp['id']) : [];

        $this->render('dashboard.features', [
            'title' => 'Active Features & Add-ons',
            'app' => $currentApp,
            'features' => $features,
        ], 'dashboard');
    }

    public function notifications(): void
    {
        $userId = $this->getUserId();
        $notifications = $this->notificationModel->getByUser($userId);

        $this->render('dashboard.notifications', [
            'title' => 'Push Notifications Manager',
            'notifications' => $notifications,
        ], 'dashboard');
    }

    public function analytics(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $currentApp = !empty($apps) ? $apps[0] : null;

        $this->render('dashboard.analytics', [
            'title' => 'App Performance & Analytics',
            'app' => $currentApp,
        ], 'dashboard');
    }

    public function builds(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $currentApp = !empty($apps) ? $apps[0] : null;
        $builds = $currentApp ? $this->buildModel->getByAppId((int)$currentApp['id']) : [];

        $this->render('dashboard.builds', [
            'title' => 'Build History & Binary Downloads',
            'app' => $currentApp,
            'builds' => $builds,
        ], 'dashboard');
    }

    public function updates(): void
    {
        $userId = $this->getUserId();
        $apps = $this->appModel->getByUser($userId);
        $currentApp = !empty($apps) ? $apps[0] : null;

        $this->render('dashboard.updates', [
            'title' => 'Over-The-Air Updates & Releases',
            'app' => $currentApp,
        ], 'dashboard');
    }

    public function billing(): void
    {
        $userId = $this->getUserId();
        $orders = $this->orderModel->getByUser($userId);

        $this->render('dashboard.billing', [
            'title' => 'Billing & Invoices',
            'orders' => $orders,
        ], 'dashboard');
    }

    public function support(): void
    {
        $userId = $this->getUserId();
        $tickets = $this->ticketModel->getByUser($userId);

        $this->render('dashboard.support', [
            'title' => 'Support & Help Desk',
            'tickets' => $tickets,
        ], 'dashboard');
    }
}
