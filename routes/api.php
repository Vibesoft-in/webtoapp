<?php

declare(strict_types=1);

use App\Controllers\CompatibilityController;
use App\Controllers\PricingController;
use App\Services\Payment\RazorpayService;
use App\Services\Integrations\WooCommerce\Webhooks as WooWebhooks;
use App\Services\Integrations\Shopify\Webhooks as ShopifyWebhooks;
use App\Models\App;
use App\Models\Build;

/** @var \App\Core\Router $router */

$router->group(['prefix' => 'api'], function ($router) {
    // Live Website Analysis endpoint
    $router->post('/analyze', [CompatibilityController::class, 'check']);

    // Dynamic Pricing Engine calculation
    $router->post('/pricing/calculate', [PricingController::class, 'calculate']);

    // Webhooks
    $router->post('/webhooks/razorpay', function ($request, $response) {
        $payload = $request->json();
        // Log or handle Razorpay server webhook event
        $response->json(['status' => 'received', 'timestamp' => time()])->send();
    });

    $router->post('/webhooks/woocommerce', function ($request, $response) {
        $topic = (string)$request->header('X-WC-Webhook-Topic', 'general');
        $webhook = new WooWebhooks();
        $handled = $webhook->handle($topic, $request->all());
        $response->json(['status' => $handled ? 'success' : 'ignored'])->send();
    });

    $router->post('/webhooks/shopify', function ($request, $response) {
        $hmac = (string)$request->header('X-Shopify-Hmac-Sha256', '');
        $webhook = new ShopifyWebhooks();
        $verified = $webhook->verifyHmac(file_get_contents('php://input'), $hmac, getenv('SHOPIFY_WEBHOOK_SECRET') ?: 'secret');
        $response->json(['status' => $verified ? 'verified' : 'unverified'])->send();
    });

    // App & Build telemetry endpoints
    $router->get('/app/{id}/status', function ($request, $response, $params) {
        $appId = (int)($params['id'] ?? 0);
        $app = (new App())->find($appId);
        if (!$app) {
            $response->json(['error' => 'App not found'], 404)->send();
            return;
        }
        $response->json(['app_id' => $appId, 'status' => $app['status'], 'version' => $app['version']])->send();
    });

    $router->get('/build/{id}/status', function ($request, $response, $params) {
        $buildId = (int)($params['id'] ?? 0);
        $build = (new Build())->find($buildId);
        if (!$build) {
            $response->json(['error' => 'Build not found'], 404)->send();
            return;
        }
        $response->json(['build_id' => $buildId, 'status' => $build['status'], 'platform' => $build['platform']])->send();
    });
});
