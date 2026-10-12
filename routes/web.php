<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\WebsiteController;
use App\Controllers\CompatibilityController;
use App\Controllers\ThemeController;
use App\Controllers\AddonController;
use App\Controllers\PricingController;
use App\Controllers\PaymentController;
use App\Controllers\DashboardController;
use App\Controllers\AppController;
use App\Controllers\NotificationController;
use App\Controllers\SupportController;
use App\Controllers\HowItWorksController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CSRF;

/** @var \App\Core\Router $router */

// Public Landing & Conversion flow
$router->get('/', [HomeController::class, 'index']);
$router->get('/how-it-works', [HowItWorksController::class, 'index']);
$router->get('/compatibility', [WebsiteController::class, 'enterWebsite']);
$router->get('/convert', [WebsiteController::class, 'enterWebsite']);
$router->post('/convert/start', [WebsiteController::class, 'startAnalysis'], [CSRF::class]);
$router->post('/convert/detect-platform', [WebsiteController::class, 'detectPlatform']);
$router->post('/check-platform-match', [WebsiteController::class, 'checkPlatformMatch']);
$router->get('/convert/platform-guide/{platform}', [WebsiteController::class, 'getPlatformGuide']);
$router->post('/convert/verify-connection', [WebsiteController::class, 'verifyConnection'], [CSRF::class]);
$router->post('/convert/analyze', [WebsiteController::class, 'runAnalysis'], [CSRF::class]);
$router->get('/website/analyzing', [WebsiteController::class, 'analyzing']);
$router->get('/compatibility-result', [CompatibilityController::class, 'result']);
$router->post('/compatibility/check', [CompatibilityController::class, 'check']);
$router->get('/website/improvement-form', [WebsiteController::class, 'improvementForm']);
$router->post('/website/improvement-submit', [WebsiteController::class, 'submitImprovement'], [CSRF::class]);

// Themes & Addons
$router->get('/themes', [ThemeController::class, 'index']);
$router->get('/themes/{slug}/demo', [ThemeController::class, 'demo']);
$router->get('/themes/demo/{slug}', [ThemeController::class, 'demo']);
$router->get('/themes/preview/{slug}', [ThemeController::class, 'preview']);
$router->get('/themes/{slug}', [ThemeController::class, 'details']);
$router->post('/themes/select', [ThemeController::class, 'select']);

$router->get('/addons', [AddonController::class, 'index']);
$router->get('/addons/{slug}', [AddonController::class, 'details']);
$router->post('/addons/select', [AddonController::class, 'updateSelection'], [CSRF::class]);

$router->get('/pricing', [PricingController::class, 'index']);

// Authentication Routes
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login'], [CSRF::class]);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register'], [CSRF::class]);
$router->get('/forgot-password', [AuthController::class, 'forgotPasswordForm']);
$router->post('/forgot-password', [AuthController::class, 'sendResetLink'], [CSRF::class]);
$router->get('/reset-password', [AuthController::class, 'resetPasswordForm']);
$router->post('/reset-password', [AuthController::class, 'resetPassword'], [CSRF::class]);
$router->get('/logout', [AuthController::class, 'logout']);

// Checkout & Payments
$router->get('/checkout', [PaymentController::class, 'checkout']);
$router->post('/checkout/pay', [PaymentController::class, 'initiate'], [CSRF::class]);
$router->post('/payment/verify', [PaymentController::class, 'verify']);
$router->get('/checkout/success', [PaymentController::class, 'success']);

// Customer Protected Dashboard
$router->group(['prefix' => 'dashboard', 'middleware' => [AuthMiddleware::class]], function ($router) {
    $router->get('/', [DashboardController::class, 'index']);
    $router->get('/my-app', [DashboardController::class, 'myApp']);
    $router->get('/app-settings', [DashboardController::class, 'appSettings']);
    $router->post('/app-settings', [AppController::class, 'updateSettings'], [CSRF::class]);
    $router->get('/features', [DashboardController::class, 'features']);
    $router->post('/features/toggle', [AppController::class, 'toggleFeature'], [CSRF::class]);
    $router->get('/notifications', [DashboardController::class, 'notifications']);
    $router->post('/notifications/send', [NotificationController::class, 'send'], [CSRF::class]);
    $router->post('/notifications/read', [NotificationController::class, 'markAsRead']);
    $router->get('/analytics', [DashboardController::class, 'analytics']);
    $router->get('/builds', [DashboardController::class, 'builds']);
    $router->post('/builds/trigger', [AppController::class, 'triggerBuild'], [CSRF::class]);
    $router->get('/updates', [DashboardController::class, 'updates']);
    $router->get('/billing', [DashboardController::class, 'billing']);
    $router->get('/support', [DashboardController::class, 'support']);
    $router->post('/support/ticket', [SupportController::class, 'createTicket'], [CSRF::class]);
});
