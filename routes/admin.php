<?php

declare(strict_types=1);

use App\Controllers\AdminController;
use App\Middleware\AdminMiddleware;
use App\Middleware\CSRF;

/** @var \App\Core\Router $router */

$router->group(['prefix' => 'admin', 'middleware' => [AdminMiddleware::class]], function ($router) {
    $router->get('/', [AdminController::class, 'index']);
    $router->get('/customers', [AdminController::class, 'customers']);
    $router->get('/websites', [AdminController::class, 'websites']);
    $router->get('/compatibility', [AdminController::class, 'compatibility']);
    $router->get('/improvement-requests', [AdminController::class, 'improvementRequests']);
    $router->post('/improvement-requests/update', [AdminController::class, 'updateImprovementStatus'], [CSRF::class]);
    $router->get('/themes', [AdminController::class, 'themes']);
    $router->get('/themes/create', [AdminController::class, 'createTheme']);
    $router->post('/themes/store', [AdminController::class, 'storeTheme'], [CSRF::class]);
    $router->get('/themes/{id}/edit', [AdminController::class, 'editTheme']);
    $router->post('/themes/{id}/update', [AdminController::class, 'updateTheme'], [CSRF::class]);
    $router->post('/themes/{id}/delete', [AdminController::class, 'deleteTheme'], [CSRF::class]);
    $router->post('/themes/{id}/toggle', [AdminController::class, 'toggleThemeStatus'], [CSRF::class]);
    $router->get('/addons', [AdminController::class, 'addons']);
    $router->get('/pricing', [AdminController::class, 'pricing']);
    $router->get('/orders', [AdminController::class, 'orders']);
    $router->get('/payments', [AdminController::class, 'payments']);
    $router->get('/apps', [AdminController::class, 'apps']);
    $router->get('/builds', [AdminController::class, 'builds']);
    $router->get('/support', [AdminController::class, 'support']);
    $router->get('/platforms', [AdminController::class, 'platforms']);
    $router->get('/platforms/{key}/edit', [AdminController::class, 'editPlatform']);
    $router->post('/platforms/{key}/update', [AdminController::class, 'updatePlatform'], [CSRF::class]);
});
