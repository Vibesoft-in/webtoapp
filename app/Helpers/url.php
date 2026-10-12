<?php

declare(strict_types=1);

if (!function_exists('url')) {
    function url(string $path = ''): string {
        $baseUrl = getenv('APP_URL') ?: 'http://localhost/webintoapp/public';
        $baseUrl = rtrim($baseUrl, '/');
        $path = ltrim($path, '/');
        return $path !== '' ? "{$baseUrl}/{$path}" : $baseUrl;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        return url('assets/' . ltrim($path, '/'));
    }
}