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

// 1. Load Environment variables (.env) if present
$envFile = ROOT_PATH . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
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

// 2. Autoloader
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
}

// 3. Always Load Helper Functions
$helpers = ['auth.php', 'url.php', 'security.php', 'validation.php', 'pricing.php'];
foreach ($helpers as $helper) {
    $helperPath = APP_PATH . '/Helpers/' . $helper;
    if (file_exists($helperPath)) {
        require_once $helperPath;
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
    // Log error to storage/logs
    $logDir = STORAGE_PATH . '/logs';
    if (is_dir($logDir) && is_writable($logDir)) {
        $logMessage = sprintf("[%s] %s in %s:%d\nStack trace:\n%s\n\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );
        @file_put_contents($logDir . '/error.log', $logMessage, FILE_APPEND);
    }

    http_response_code(500);
    $isDebug = $appConfig['debug'] ?? false;
    if ($isDebug || !file_exists(ROOT_PATH . '/.env')) {
        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Application Error</title><meta name="viewport" content="width=device-width,initial-scale=1"></head><body style="margin:0;padding:24px;background:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;">';
        echo '<div style="max-width:760px;margin:40px auto;background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:32px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">';
        echo '<h2 style="color:#e11d48;margin:0 0 16px 0;font-size:22px;">Application Configuration Notice</h2>';
        echo '<div style="background:#fef2f2;border:1px solid #fee2e2;border-radius:8px;padding:16px;color:#991b1b;margin-bottom:20px;font-size:15px;line-height:1.5;"><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</div>';
        if (!file_exists(ROOT_PATH . '/.env')) {
            echo '<div style="background:#eff6ff;border:1px solid #dbeafe;border-radius:8px;padding:16px;color:#1e40af;margin-bottom:20px;font-size:14px;line-height:1.6;">';
            echo '<p style="margin:0 0 8px 0;font-weight:600;">Configuration Required on Hostinger:</p>';
            echo '<p style="margin:0;">The <code>.env</code> file was not found. In Hostinger File Manager, please create a <code>.env</code> file in your website root folder with your database credentials (copy from <code>.env.example</code>).</p>';
            echo '</div>';
        }
        echo '<p style="color:#64748b;font-size:13px;margin:0;">File: ' . htmlspecialchars($e->getFile()) . ' on line ' . $e->getLine() . '</p>';
        echo '</div></body></html>';
    } else {
        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>500 - Internal Server Error</title></head><body style="font-family:sans-serif;text-align:center;padding:50px;">';
        echo '<h1>500 - Internal Server Error</h1>';
        echo '<p>Something went wrong. Please try again later.</p>';
        echo '</body></html>';
    }
}