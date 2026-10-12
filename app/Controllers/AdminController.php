<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use App\Models\Website;
use App\Models\CompatibilityReport;
use App\Models\ImprovementRequest;
use App\Models\Theme;
use App\Models\Addon;
use App\Models\Pricing;
use App\Models\Order;
use App\Models\Payment;
use App\Models\App;
use App\Models\Build;
use App\Models\SupportTicket;
use App\Models\PlatformConfig;

class AdminController extends Controller
{
    private User $userModel;
    private Website $websiteModel;
    private CompatibilityReport $reportModel;
    private ImprovementRequest $improvementModel;
    private Theme $themeModel;
    private Addon $addonModel;
    private Pricing $pricingModel;
    private Order $orderModel;
    private Payment $paymentModel;
    private App $appModel;
    private Build $buildModel;
    private SupportTicket $ticketModel;
    private PlatformConfig $platformModel;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->userModel = new User();
        $this->websiteModel = new Website();
        $this->reportModel = new CompatibilityReport();
        $this->improvementModel = new ImprovementRequest();
        $this->themeModel = new Theme();
        $this->addonModel = new Addon();
        $this->pricingModel = new Pricing();
        $this->orderModel = new Order();
        $this->paymentModel = new Payment();
        $this->appModel = new App();
        $this->buildModel = new Build();
        $this->ticketModel = new SupportTicket();
        $this->platformModel = new PlatformConfig();
    }

    public function index(): void
    {
        $users = $this->userModel->all();
        $apps = $this->appModel->all();
        $orders = $this->orderModel->all();
        $builds = $this->buildModel->all();
        $improvements = $this->improvementModel->getPendingRequests();

        $totalRevenue = array_reduce($orders, function ($acc, $item) {
            return $item['status'] === 'completed' ? $acc + (float)$item['total_amount'] : $acc;
        }, 0.0);

        $this->render('admin.index', [
            'title' => 'Admin Control Panel',
            'userCount' => count($users),
            'appCount' => count($apps),
            'orderCount' => count($orders),
            'buildCount' => count($builds),
            'totalRevenue' => $totalRevenue,
            'pendingImprovements' => count($improvements),
            'recentOrders' => array_slice($orders, 0, 5),
            'recentApps' => array_slice($apps, 0, 5),
        ], 'admin');
    }

    public function customers(): void
    {
        $customers = $this->userModel->where('role', 'customer');

        $this->render('admin.customers', [
            'title' => 'Customer Management',
            'customers' => $customers,
        ], 'admin');
    }

    public function websites(): void
    {
        $websites = $this->websiteModel->all();

        $this->render('admin.websites', [
            'title' => 'Analyzed Websites',
            'websites' => $websites,
        ], 'admin');
    }

    public function compatibility(): void
    {
        $reports = $this->reportModel->all();

        $this->render('admin.compatibility', [
            'title' => 'Compatibility Audits',
            'reports' => $reports,
        ], 'admin');
    }

    public function improvementRequests(): void
    {
        $requests = $this->improvementModel->all();

        $this->render('admin.improvement-requests', [
            'title' => 'Website Improvement Requests',
            'requests' => $requests,
        ], 'admin');
    }

    public function updateImprovementStatus(): void
    {
        $id = (int)$this->request->input('id');
        $status = (string)$this->request->input('status', 'resolved');
        $response = trim((string)$this->request->input('admin_response', ''));

        $this->improvementModel->update($id, [
            'status' => in_array($status, ['pending', 'in_review', 'resolved', 'rejected']) ? $status : 'in_review',
            'admin_response' => $response,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', 'Improvement request updated.');
        $this->redirect(url('/admin/improvement-requests'));
    }

    public function themes(): void
    {
        $themes = $this->themeModel->all();
        usort($themes, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        $this->render('admin.themes', [
            'title' => 'Theme Catalog Management',
            'themes' => $themes,
        ], 'admin');
    }

    public function createTheme(): void
    {
        $this->render('admin.theme-form', [
            'title' => 'Add New Theme',
            'theme' => [
                'id' => null,
                'name' => '',
                'slug' => '',
                'category' => 'ecommerce',
                'description' => '',
                'features' => "[\"Product Catalog\", \"Cart & Checkout\", \"Search & Filters\", \"Push Notifications\"]",
                'preview_image' => 'theme_modern_minimalist.jpg',
                'demo_url' => '',
                'badge' => '',
                'is_featured' => 0,
                'is_premium' => 0,
                'price' => '0.00',
                'sort_order' => 10,
                'status' => 'active'
            ],
            'isEdit' => false
        ], 'admin');
    }

    public function storeTheme(): void
    {
        $data = $this->request->all();
        $name = trim((string)($data['name'] ?? ''));
        $slug = trim((string)($data['slug'] ?? ''));
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        $featuresInput = trim((string)($data['features'] ?? ''));
        if (str_starts_with($featuresInput, '[') && str_ends_with($featuresInput, ']')) {
            $features = $featuresInput;
        } else {
            $featureLines = array_filter(array_map('trim', explode("\n", $featuresInput)));
            $features = json_encode(array_values($featureLines));
        }

        $price = (float)($data['price'] ?? 0.0);
        $isPremium = isset($data['is_premium']) ? 1 : ($price > 0 ? 1 : 0);
        $isFeatured = isset($data['is_featured']) ? 1 : 0;
        $status = in_array($data['status'] ?? 'active', ['active', 'inactive']) ? $data['status'] : 'active';
        $sortOrder = (int)($data['sort_order'] ?? 0);
        $badge = trim((string)($data['badge'] ?? ''));
        $category = trim((string)($data['category'] ?? 'ecommerce'));
        $description = trim((string)($data['description'] ?? ''));
        $demoUrl = trim((string)($data['demo_url'] ?? ''));
        if (empty($demoUrl)) {
            $demoUrl = "/themes/{$slug}/demo";
        }

        // Image upload or path handling
        $previewImage = trim((string)($data['preview_image'] ?? ''));
        $file = $this->request->file('preview_image_file');
        if ($file && ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK && !empty($file['name'])) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'svg'])) {
                $filename = 'theme_' . preg_replace('/[^a-z0-9_-]/', '', $slug) . '_' . time() . '.' . $ext;
                $dest = PUBLIC_PATH . '/assets/images/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $previewImage = $filename;
                }
            }
        }

        $this->themeModel->create([
            'name' => $name,
            'slug' => $slug,
            'category' => $category,
            'description' => $description,
            'features' => $features,
            'preview_image' => $previewImage,
            'demo_url' => $demoUrl,
            'badge' => $badge,
            'is_featured' => $isFeatured,
            'is_premium' => $isPremium,
            'price' => $price,
            'sort_order' => $sortOrder,
            'status' => $status
        ]);

        Session::flash('success', "Theme '{$name}' created successfully.");
        $this->redirect(url('/admin/themes'));
    }

    public function editTheme(array|string $params = []): void
    {
        $id = (int)(is_array($params) ? ($params['id'] ?? 0) : $params);
        $theme = $this->themeModel->find($id);
        if (!$theme) {
            Session::flash('error', 'Theme not found.');
            $this->redirect(url('/admin/themes'));
            return;
        }

        $this->render('admin.theme-form', [
            'title' => 'Edit Theme: ' . $theme['name'],
            'theme' => $theme,
            'isEdit' => true
        ], 'admin');
    }

    public function updateTheme(array|string $params = []): void
    {
        $id = (int)(is_array($params) ? ($params['id'] ?? 0) : $params);
        $theme = $this->themeModel->find($id);
        if (!$theme) {
            Session::flash('error', 'Theme not found.');
            $this->redirect(url('/admin/themes'));
            return;
        }

        $data = $this->request->all();
        $name = trim((string)($data['name'] ?? $theme['name']));
        $slug = trim((string)($data['slug'] ?? $theme['slug']));
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        $featuresInput = trim((string)($data['features'] ?? ''));
        if (str_starts_with($featuresInput, '[') && str_ends_with($featuresInput, ']')) {
            $features = $featuresInput;
        } else {
            $featureLines = array_filter(array_map('trim', explode("\n", $featuresInput)));
            $features = json_encode(array_values($featureLines));
        }

        $price = (float)($data['price'] ?? 0.0);
        $isPremium = isset($data['is_premium']) ? 1 : ($price > 0 ? 1 : 0);
        $isFeatured = isset($data['is_featured']) ? 1 : 0;
        $status = in_array($data['status'] ?? 'active', ['active', 'inactive']) ? $data['status'] : 'active';
        $sortOrder = (int)($data['sort_order'] ?? 0);
        $badge = trim((string)($data['badge'] ?? ''));
        $category = trim((string)($data['category'] ?? 'ecommerce'));
        $description = trim((string)($data['description'] ?? ''));
        $demoUrl = trim((string)($data['demo_url'] ?? ''));
        if (empty($demoUrl)) {
            $demoUrl = "/themes/{$slug}/demo";
        }

        $previewImage = trim((string)($data['preview_image'] ?? $theme['preview_image']));
        $file = $this->request->file('preview_image_file');
        if ($file && ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK && !empty($file['name'])) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'svg'])) {
                $filename = 'theme_' . preg_replace('/[^a-z0-9_-]/', '', $slug) . '_' . time() . '.' . $ext;
                $dest = PUBLIC_PATH . '/assets/images/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $previewImage = $filename;
                }
            }
        }

        $this->themeModel->update($id, [
            'name' => $name,
            'slug' => $slug,
            'category' => $category,
            'description' => $description,
            'features' => $features,
            'preview_image' => $previewImage,
            'demo_url' => $demoUrl,
            'badge' => $badge,
            'is_featured' => $isFeatured,
            'is_premium' => $isPremium,
            'price' => $price,
            'sort_order' => $sortOrder,
            'status' => $status
        ]);

        Session::flash('success', "Theme '{$name}' updated successfully.");
        $this->redirect(url('/admin/themes'));
    }

    public function deleteTheme(array|string $params = []): void
    {
        $id = (int)(is_array($params) ? ($params['id'] ?? 0) : $params);
        $theme = $this->themeModel->find($id);
        if ($theme) {
            $this->themeModel->delete($id);
            Session::flash('success', "Theme '{$theme['name']}' deleted.");
        }
        $this->redirect(url('/admin/themes'));
    }

    public function toggleThemeStatus(array|string $params = []): void
    {
        $id = (int)(is_array($params) ? ($params['id'] ?? 0) : $params);
        $theme = $this->themeModel->find($id);
        if ($theme) {
            $newStatus = ($theme['status'] === 'active') ? 'inactive' : 'active';
            $this->themeModel->update($id, ['status' => $newStatus]);
            Session::flash('success', "Theme '{$theme['name']}' is now {$newStatus}.");
        }
        $this->redirect(url('/admin/themes'));
    }

    public function addons(): void
    {
        $addons = $this->addonModel->all();

        $this->render('admin.addons', [
            'title' => 'Add-on Features Management',
            'addons' => $addons,
        ], 'admin');
    }

    public function pricing(): void
    {
        $plans = $this->pricingModel->all();

        $this->render('admin.pricing', [
            'title' => 'Pricing Plans Management',
            'plans' => $plans,
        ], 'admin');
    }

    public function orders(): void
    {
        $orders = $this->orderModel->all();

        $this->render('admin.orders', [
            'title' => 'Customer Orders',
            'orders' => $orders,
        ], 'admin');
    }

    public function payments(): void
    {
        $payments = $this->paymentModel->all();

        $this->render('admin.payments', [
            'title' => 'Payment Transactions',
            'payments' => $payments,
        ], 'admin');
    }

    public function apps(): void
    {
        $apps = $this->appModel->all();

        $this->render('admin.apps', [
            'title' => 'Managed Mobile Applications',
            'apps' => $apps,
        ], 'admin');
    }

    public function builds(): void
    {
        $builds = $this->buildModel->all();

        $this->render('admin.builds', [
            'title' => 'Build Queue & Binary Artifacts',
            'builds' => $builds,
        ], 'admin');
    }

    public function support(): void
    {
        $tickets = $this->ticketModel->all();

        $this->render('admin.support', [
            'title' => 'Support Desk Queue',
            'tickets' => $tickets,
        ], 'admin');
    }

    public function platforms(): void
    {
        $platforms = $this->platformModel->getAllActive();

        $this->render('admin.platforms', [
            'title' => 'Supported Platform & API Configurations',
            'platforms' => $platforms,
        ], 'admin');
    }

    public function editPlatform(array|string $params = []): void
    {
        $key = is_array($params) ? ($params['key'] ?? '') : (string)$params;
        $platform = $this->platformModel->getByKey($key);
        if (!$platform) {
            $this->redirect(url('/admin/platforms'));
            return;
        }

        $this->render('admin.edit-platform', [
            'title' => 'Edit Platform: ' . $platform['name'],
            'platform' => $platform,
        ], 'admin');
    }

    public function updatePlatform(array|string $params = []): void
    {
        $key = is_array($params) ? ($params['key'] ?? '') : (string)$params;
        $data = $this->request->all();
        $this->platformModel->updateByKey($key, [
            'name' => trim((string)($data['name'] ?? '')),
            'subtitle' => trim((string)($data['subtitle'] ?? '')),
            'description' => trim((string)($data['description'] ?? '')),
            'setup_time' => trim((string)($data['setup_time'] ?? '')),
            'api_type' => trim((string)($data['api_type'] ?? '')),
        ]);

        Session::flash('success', "Platform configuration for '{$key}' updated.");
        $this->redirect(url('/admin/platforms'));
    }
}
