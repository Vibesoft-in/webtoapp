<?php

declare(strict_types=1);

use App\Core\Session;

if (!function_exists('old')) {
    function old(string $key, mixed $default = ''): mixed {
        $oldInputs = Session::getFlash('old_inputs', []);
        return $oldInputs[$key] ?? $default;
    }
}