<?php
/**
 * Application Entry Point / Front Controller
 * PHP 8+ MVC Architecture
 */

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('PUBLIC_PATH', __DIR__);

// PSR-4 Autoloader fallback (if composer autoload is not installed)
if (file_exists(ROOT_PATH . '/vendor/autoload.php')) {
    require_once ROOT_PATH . '/vendor/autoload.php';
} else {
    spl_autoload_register(function (string $class) {
        $prefix = 'App\\';
        $baseDir = APP_PATH . '/';
        $len = strlen($prefix);

        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }

        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    });

    // Load helper functions
    $helpers = ['auth.php', 'url.php', 'security.php', 'validation.php', 'pricing.php'];
    foreach ($helpers as $helper) {
        $helperPath = APP_PATH . '/Helpers/' . $helper;
        if (file_exists($helperPath)) {
            require_once $helperPath;
        }
    }
}

// Load Environment variables (.env)
if (file_exists(ROOT_PATH . '/.env')) {
    $lines = file(ROOT_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (str_contains($line, '=')) {
            [$key, $val] = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            putenv("$key=$val");
            $_ENV[$key] = $val;
            $_SERVER[$key] = $val;
        }
    }
}

// Error handling based on environment
$appConfig = require CONFIG_PATH . '/app.php';
if ($appConfig['debug'] ?? false) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

// Start secure session
App\Core\Session::start();

// Initialize Request, Response, and Router
$request = new App\Core\Request();
$response = new App\Core\Response();
$router = new App\Core\Router($request, $response);

// Load Route Definitions
require ROOT_PATH . '/routes/web.php';
require ROOT_PATH . '/routes/api.php';
require ROOT_PATH . '/routes/admin.php';

// Dispatch Request
try {
    $router->dispatch();
} catch (\Throwable $e) {
    if ($appConfig['debug'] ?? false) {
        http_response_code(500);
        echo '<h1>Application Error</h1>';
        echo '<p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ' on line ' . $e->getLine() . '</p>';
        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    } else {
        http_response_code(500);
        echo '<h1>500 - Internal Server Error</h1>';
        echo '<p>Something went wrong. Please try again later.</p>';
    }
}