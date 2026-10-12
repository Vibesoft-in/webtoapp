<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\App;
use App\Models\AppFeature;
use App\Models\Pricing;
use App\Models\Theme;
use App\Models\Addon;
use App\Models\Website;
use App\Services\Payment\RazorpayService;
use App\Services\Payment\PaymentVerification;
use App\Services\PricingEngine\PricingCalculator;

class PaymentController extends Controller
{
    private Order $orderModel;
    private Payment $paymentModel;
    private App $appModel;
    private AppFeature $featureModel;
    private Pricing $pricingModel;
    private Theme $themeModel;
    private Addon $addonModel;
    private Website $websiteModel;
    private RazorpayService $razorpayService;
    private PaymentVerification $paymentVerification;
    private PricingCalculator $calculator;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->orderModel = new Order();
        $this->paymentModel = new Payment();
        $this->appModel = new App();
        $this->featureModel = new AppFeature();
        $this->pricingModel = new Pricing();
        $this->themeModel = new Theme();
        $this->addonModel = new Addon();
        $this->websiteModel = new Website();
        $this->razorpayService = new RazorpayService();
        $this->paymentVerification = new PaymentVerification();
        $this->calculator = new PricingCalculator();
    }

    public function checkout(): void
    {
        if (!Session::has('user_id')) {
            Session::flash('error', 'Please create an account or sign in to complete checkout.');
            $this->redirect(url('/login'));
            return;
        }

        $planId = (int)(Session::get('selected_plan_id') ?: 1);
        $themeId = (int)(Session::get('selected_theme_id') ?: 1);
        $addonIds = Session::get('selected_addons') ?: [];

        $plan = $this->pricingModel->find($planId) ?: ['id' => 1, 'name' => 'Starter App', 'price' => 4999.00];
        $theme = $this->themeModel->find($themeId) ?: ['id' => 1, 'name' => 'Standard Theme', 'price' => 0.00];

        $addons = [];
        foreach ($addonIds as $aId) {
            $addon = $this->addonModel->find((int)$aId);
            if ($addon) {
                $addons[] = $addon;
            }
        }

        $baseTotal = (float)$plan['price'] + (float)$theme['price'];
        $calc = $this->calculator->calculate($baseTotal, $addons, 18.0);

        $websiteId = (int)Session::get('current_website_id');
        $website = $websiteId ? $this->websiteModel->find($websiteId) : null;

        $this->render('checkout.summary', [
            'title' => 'Order Summary & Checkout',
            'plan' => $plan,
            'theme' => $theme,
            'addons' => $addons,
            'calculation' => $calc,
            'website' => $website,
        ], 'main');
    }

    public function initiate(): void
    {
        $userId = (int)Session::get('user_id');
        if (!$userId) {
            $this->redirect(url('/login'));
            return;
        }

        $planId = (int)(Session::get('selected_plan_id') ?: 1);
        $themeId = (int)(Session::get('selected_theme_id') ?: 1);
        $addonIds = Session::get('selected_addons') ?: [];

        $plan = $this->pricingModel->find($planId) ?: ['price' => 4999.00];
        $theme = $this->themeModel->find($themeId) ?: ['price' => 0.00];

        $addons = [];
        foreach ($addonIds as $aId) {
            $addon = $this->addonModel->find((int)$aId);
            if ($addon) {
                $addons[] = $addon;
            }
        }

        $baseTotal = (float)$plan['price'] + (float)$theme['price'];
        $calc = $this->calculator->calculate($baseTotal, $addons, 18.0);

        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $orderId = (int)$this->orderModel->create([
            'order_number' => $orderNumber,
            'user_id' => $userId,
            'plan_id' => $planId,
            'theme_id' => $themeId,
            'selected_addons' => json_encode($addonIds),
            'subtotal' => $calc['subtotal'],
            'tax' => $calc['tax_amount'],
            'total_amount' => $calc['total_amount'],
            'currency' => 'INR',
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Create Razorpay Order
        $razorpayOrder = $this->razorpayService->createOrder($calc['total_amount'], $orderNumber, 'INR');
        $gatewayOrderId = $razorpayOrder['id'] ?? ('order_mock_' . uniqid());

        $this->paymentModel->create([
            'order_id' => $orderId,
            'user_id' => $userId,
            'gateway' => 'razorpay',
            'gateway_order_id' => $gatewayOrderId,
            'amount' => $calc['total_amount'],
            'currency' => 'INR',
            'status' => 'initiated',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Session::set('current_order_id', $orderId);

        $this->render('checkout.payment', [
            'title' => 'Complete Payment with Razorpay',
            'orderNumber' => $orderNumber,
            'orderId' => $orderId,
            'amount' => $calc['total_amount'],
            'gatewayOrderId' => $gatewayOrderId,
            'razorpayKey' => getenv('RAZORPAY_KEY_ID') ?: '',
        ], 'main');
    }

    public function verify(): void
    {
        $userId = (int)Session::get('user_id');
        $orderId = (int)$this->request->input('order_id', Session::get('current_order_id'));
        $paymentId = (string)$this->request->input('razorpay_payment_id', '');
        $gatewayOrderId = (string)$this->request->input('razorpay_order_id', '');
        $signature = (string)$this->request->input('razorpay_signature', '');

        $order = $this->orderModel->find($orderId);
        if (!$order) {
            Session::flash('error', 'Order not found.');
            $this->redirect(url('/checkout'));
            return;
        }

        // Verify Razorpay signature
        $isValid = $this->paymentVerification->verify($gatewayOrderId, $paymentId, $signature);

        if (!$isValid) {
            Session::flash('error', 'Payment verification failed. Please try again.');
            $this->redirect(url('/checkout'));
            return;
        }

        // 1. Mark Order and Payment complete
        $this->orderModel->update($orderId, [
            'status' => 'completed',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $paymentRecord = $this->paymentModel->findWhere('gateway_order_id', $gatewayOrderId);
        if ($paymentRecord) {
            $this->paymentModel->update((int)$paymentRecord['id'], [
                'gateway_payment_id' => $paymentId,
                'gateway_signature' => $signature,
                'status' => 'captured',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // 2. Provision App Project (Rule 21)
        $websiteId = (int)Session::get('current_website_id');
        $website = $websiteId ? $this->websiteModel->find($websiteId) : null;
        $appName = $website ? ucfirst(explode('.', $website['domain'])[0]) . ' App' : 'My Mobile App';
        $packageName = 'com.app.' . preg_replace('/[^a-zA-Z0-9]/', '', strtolower($appName));

        $appId = (int)$this->appModel->create([
            'user_id' => $userId,
            'website_id' => $websiteId ?: 1,
            'theme_id' => $order['theme_id'] ?: 1,
            'order_id' => $orderId,
            'app_name' => $appName,
            'package_name' => $packageName,
            'version' => '1.0.0',
            'primary_color' => '#4f46e5',
            'secondary_color' => '#06b6d4',
            'platforms' => json_encode(['android', 'ios']),
            'status' => 'configured',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Enable purchased Add-on features
        $addonIds = json_decode((string)$order['selected_addons'], true) ?: [];
        foreach ($addonIds as $aId) {
            $addon = $this->addonModel->find((int)$aId);
            if ($addon) {
                $this->featureModel->create([
                    'app_id' => $appId,
                    'addon_id' => (int)$addon['id'],
                    'feature_key' => $addon['slug'],
                    'is_enabled' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        Session::set('current_app_id', $appId);
        $this->redirect(url('/checkout/success?order_id=' . $orderId));
    }

    public function success(): void
    {
        $orderId = (int)$this->request->input('order_id', Session::get('current_order_id'));
        $order = $this->orderModel->find($orderId);

        $this->render('checkout.success', [
            'title' => 'Payment Successful - App Project Created',
            'order' => $order,
        ], 'main');
    }
}
