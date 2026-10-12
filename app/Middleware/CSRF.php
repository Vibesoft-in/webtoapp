<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class CSRF
{
    public static function generateToken(): string
    {
        if (!Session::has('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }
        return Session::get('csrf_token');
    }

    public function handle(Request $request, Response $response): bool
    {
        if ($request->isPost() || in_array($request->getMethod(), ['PUT', 'DELETE', 'PATCH'])) {
            $token = $request->input('csrf_token') ?: $request->header('X-CSRF-TOKEN');
            $sessionToken = Session::get('csrf_token');

            if (!$token || !hash_equals($sessionToken ?? '', $token)) {
                if ($request->isJson()) {
                    $response->json(['error' => 'CSRF token mismatch', 'status' => 419], 419)->send();
                    return false;
                }
                http_response_code(419);
                echo '<h1>419 - Page Expired (CSRF Token Mismatch)</h1>';
                return false;
            }
        }
        return true;
    }
}