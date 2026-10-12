<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class AdminMiddleware
{
    public function handle(Request $request, Response $response): bool
    {
        $role = Session::get('user_role');
        if (!Session::has('user_id') || $role !== 'admin') {
            if ($request->isJson() || str_starts_with($request->getPath(), '/api')) {
                $response->json(['error' => 'Forbidden: Admin access required', 'status' => 403], 403)->send();
                return false;
            }
            Session::flash('error', 'Access restricted to administrators.');
            $response->redirect(url('/dashboard'));
            return false;
        }
        return true;
    }
}