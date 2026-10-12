<?php

declare(strict_types=1);

use App\Core\Session;

if (!function_exists('is_authenticated')) {
    function is_authenticated(): bool {
        return Session::has('user_id');
    }
}

if (!function_exists('auth_id')) {
    function auth_id(): ?int {
        return Session::get('user_id');
    }
}

if (!function_exists('auth_user')) {
    function auth_user(): ?array {
        return Session::get('user');
    }
}

if (!function_exists('is_admin')) {
    function is_admin(): bool {
        return Session::get('user_role') === 'admin';
    }
}