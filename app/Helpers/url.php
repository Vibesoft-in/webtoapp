<?php

declare(strict_types=1);

if (!function_exists('base_url')) {
    /**
     * Get the application Base URL.
     * 
     * Controlled from one single place:
     * 1. If APP_URL is set in .env (or environment), it uses that.
     * 2. If APP_URL is not set or set to 'auto', it automatically detects the current
     *    protocol (http/https), host domain, and directory path from the browser request.
     */
    function base_url(): string {
        // 1. Check APP_URL from .env
        $appUrl = getenv('APP_URL');
        if (!empty($appUrl) && $appUrl !== 'auto') {
            return rtrim($appUrl, '/');
        }

        // 2. Auto-detect from current web request
        if (!empty($_SERVER['HTTP_HOST'])) {
            $isHttps = (!empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off')
                || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
                || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string)$_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
                || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower((string)$_SERVER['HTTP_X_FORWARDED_SSL']) === 'on');

            $scheme = $isHttps ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];

            $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
            $requestPath = parse_url($requestUri, PHP_URL_PATH) ?: '/';

            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));

            if (str_contains($requestPath, '/public/') || str_ends_with($requestPath, '/public')) {
                // Accessed explicitly with /public in the URL
                $basePath = ($scriptDir !== '/' && $scriptDir !== '.') ? $scriptDir : '';
            } else {
                // Accessed via root domain (e.g. webtoapp.livaan.in) or rewritten by .htaccess
                $stripped = preg_replace('#/public$#', '', $scriptDir);
                $basePath = ($stripped !== '/' && $stripped !== '.') ? $stripped : '';
            }

            return rtrim("{$scheme}://{$host}" . ($basePath ? '/' . trim($basePath, '/') : ''), '/');
        }

        return 'http://localhost/webintoapp/public';
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