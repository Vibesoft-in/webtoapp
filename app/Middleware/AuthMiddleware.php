<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class AuthMiddleware
{
    public function handle(Request $request, Response $response): bool
    {
        if (!Session::has('user_id')) {
            if ($request->isJson() || str_starts_with($request->getPath(), '/api')) {
                $response->json(['error' => 'Unauthorized access', 'status' => 401], 401)->send();
                return false;
            }
            Session::flash('error', 'Please login to continue.');
            $response->redirect(url('/login'));
            return false;
        }
        return true;
    }
}