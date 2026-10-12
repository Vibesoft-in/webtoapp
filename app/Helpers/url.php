<?php

declare(strict_types=1);

if (!function_exists('base_url')) {
    /**
     * Centralized dynamic Base URL generator with automatic host and path detection.
     */
    function base_url(): string {
        $configured = getenv('APP_URL');
        if (!empty($configured) && $configured !== 'http://localhost/webintoapp/public') {
            return rtrim($configured, '/');
        }

        if (!empty($_SERVER['HTTP_HOST'])) {
            $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
                || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

            $scheme = $isHttps ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];

            $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
            $requestPath = parse_url($requestUri, PHP_URL_PATH) ?: '/';

            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));

            if (str_contains($requestPath, '/public/') || str_ends_with($requestPath, '/public')) {
                // Accessed explicitly with /public in the URL
                $basePath = ($scriptDir !== '/' && $scriptDir !== '.') ? $scriptDir : '';
            } else {
                // Accessed via root domain or rewritten by .htaccess
                $stripped = preg_replace('#/public$#', '', $scriptDir);
                $basePath = ($stripped !== '/' && $stripped !== '.') ? $stripped : '';
            }

            return rtrim("{$scheme}://{$host}" . ($basePath ? '/' . trim($basePath, '/') : ''), '/');
        }

        return 'http://localhost/website-to-app-converter/public';
    }
}

if (!function_exists('url')) {
    /**
     * Generate an absolute URL for a given path using the centralized Base URL.
     */
    function url(string $path = ''): string {
        $baseUrl = base_url();
        $path = ltrim($path, '/');
        return $path !== '' ? "{$baseUrl}/{$path}" : $baseUrl;
    }
}

if (!function_exists('asset')) {
    /**
     * Generate an absolute URL for an asset in public/assets.
     */
    function asset(string $path): string {
        $baseUrl = base_url();
        $path = ltrim($path, '/');
        return "{$baseUrl}/assets/{$path}";
    }
}