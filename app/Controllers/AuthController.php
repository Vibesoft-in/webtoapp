<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller
{
    private User $userModel;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->userModel = new User();
    }

    public function loginForm(): void
    {
        $redirect = $this->request->input('redirect') ?: (string)Session::get('intended_url', '');

        if (Session::has('user_id')) {
            if (!empty($redirect)) {
                $this->redirect($this->resolveRedirect($redirect));
                return;
            }
            $this->redirect(Session::get('user_role') === 'admin' ? url('/admin') : url('/dashboard'));
            return;
        }

        $this->render('auth.login', [
            'title' => 'Sign In - AppifyHub',
            'redirect' => $redirect,
        ], 'auth');
    }

    public function login(): void
    {
        $data = $this->request->all();
        $redirect = trim((string)($this->request->input('redirect') ?: ''));

        $validator = new Validator($data);
        $validator->required('email')->email('email')
                  ->required('password');

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', $data);
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/login' . $query));
            return;
        }

        $user = $this->userModel->findByEmail($data['email']);

        if (!$user || !$this->userModel->verifyPassword($data['password'], $user['password'])) {
            Session::flash('error', 'Invalid email address or password.');
            Session::flash('old', ['email' => $data['email']]);
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/login' . $query));
            return;
        }

        if ($user['status'] !== 'active') {
            Session::flash('error', 'Your account is suspended. Please contact support.');
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/login' . $query));
            return;
        }

        // Set session
        Session::regenerate();
        Session::set('user_id', (int)$user['id']);
        Session::set('user_name', $user['name']);
        Session::set('user_email', $user['email']);
        Session::set('user_role', $user['role']);

        // Load active website if user already has one
        $websiteModel = new \App\Models\Website();
        $userWebsites = $websiteModel->where('user_id', (int)$user['id']);
        if (!empty($userWebsites)) {
            $latest = end($userWebsites);
            Session::set('current_website_id', (int)$latest['id']);
            Session::set('current_website_url', (string)$latest['url']);
            Session::set('current_website_platform', (string)$latest['platform']);
        }

        if ($user['role'] === 'admin') {
            $this->redirect(url('/admin'));
            return;
        }

        Session::flash('success', 'Welcome back, ' . htmlspecialchars($user['name']) . '!');
        $this->redirect($this->resolveRedirect($redirect));
    }

    public function registerForm(): void
    {
        $redirect = $this->request->input('redirect') ?: (string)Session::get('intended_url', '');

        if (Session::has('user_id')) {
            if (!empty($redirect)) {
                $this->redirect($this->resolveRedirect($redirect));
                return;
            }
            $this->redirect(url('/dashboard'));
            return;
        }

        $this->render('auth.register', [
            'title' => 'Create Your Account - AppifyHub',
            'redirect' => $redirect,
        ], 'auth');
    }

    public function register(): void
    {
        $data = $this->request->all();
        $redirect = trim((string)($this->request->input('redirect') ?: ''));

        // Normalize website URL if protocol was omitted
        $websiteUrl = trim((string)($data['website_url'] ?? $data['url'] ?? ''));
        if (!empty($websiteUrl) && !preg_match('#^https?://#i', $websiteUrl)) {
            $websiteUrl = 'https://' . $websiteUrl;
            $data['website_url'] = $websiteUrl;
        }

        $platform = strtolower(trim((string)($data['platform'] ?? 'woocommerce')));
        if (!in_array($platform, ['woocommerce', 'shopify', 'wordpress'], true)) {
            $platform = 'woocommerce';
        }
        $data['platform'] = $platform;

        $validator = new Validator($data);
        $validator->required('name')->min('name', 2)
                  ->required('email')->email('email')
                  ->required('password')->min('password', 6)
                  ->required('website_url', 'Website URL is required.')
                  ->url('website_url', 'Please enter a valid website URL (e.g. https://yourstore.com).');

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', $data);
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/register' . $query));
            return;
        }

        if ($this->userModel->findByEmail($data['email'])) {
            Session::flash('error', 'An account with this email address already exists. Please sign in below.');
            Session::flash('old', $data);
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/login' . $query));
            return;
        }

        // Verify that the URL entered belongs to a supported platform and match
        $connectionManager = new \App\Services\Platform\PlatformConnectionManager();
        $verification = $connectionManager->verifyUrlMatchesPlatform($websiteUrl, !empty($platform) ? $platform : 'auto');

        // Check if custom / unsupported platform
        if (!empty($verification['is_custom']) || in_array($verification['detected_platform'] ?? '', ['custom', 'unsupported'], true)) {
            Session::flash('error', 'Custom Platform Detected: This website appears to be built on a custom platform. We only convert websites built on WooCommerce, Shopify, or WordPress.');
            Session::flash('old', $data);
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/register' . $query));
            return;
        }

        if (!$verification['matches']) {
            Session::flash('error', $verification['message']);
            Session::flash('old', $data);
            $query = !empty($redirect) ? '?redirect=' . urlencode($redirect) : '';
            $this->redirect(url('/register' . $query));
            return;
        }

        // Adopt verified platform
        if (!empty($verification['detected_platform']) && in_array($verification['detected_platform'], ['woocommerce', 'shopify', 'wordpress'], true)) {
            $platform = $verification['detected_platform'];
            $data['platform'] = $platform;
        }

        // 1. Create User
        $userId = $this->userModel->createCustomer([
            'name' => trim($data['name']),
            'email' => strtolower(trim($data['email'])),
            'password' => $data['password'],
            'phone' => trim($data['phone'] ?? ''),
        ]);

        // 2. Parse domain and create or update Website record
        $parsedUrl = parse_url($websiteUrl);
        $domain = $parsedUrl['host'] ?? $websiteUrl;

        $websiteModel = new \App\Models\Website();
        $existingWebsite = $websiteModel->findWhere('domain', $domain);
        if ($existingWebsite) {
            $websiteId = (int)$existingWebsite['id'];
            $websiteModel->update($websiteId, [
                'user_id' => (int)$userId,
                'url' => $websiteUrl,
                'platform' => $platform,
                'ssl_enabled' => str_starts_with($websiteUrl, 'https://') ? 1 : 0,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $websiteId = (int)$websiteModel->create([
                'user_id' => (int)$userId,
                'url' => $websiteUrl,
                'domain' => $domain,
                'platform' => $platform,
                'ssl_enabled' => str_starts_with($websiteUrl, 'https://') ? 1 : 0,
                'status' => 'pending',
                'last_checked_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // 3. Set Session
        Session::regenerate();
        Session::set('user_id', (int)$userId);
        Session::set('user_name', trim($data['name']));
        Session::set('user_email', strtolower(trim($data['email'])));
        Session::set('user_role', 'customer');

        // Store website details in session for auto-filling compatibility analyzer
        Session::set('current_website_id', $websiteId);
        Session::set('current_website_url', $websiteUrl);
        Session::set('current_website_platform', $platform);
        Session::set('current_website_name', trim((string)($data['website_name'] ?? '')));

        Session::flash('success', 'Account created! Your website details have been loaded into the Compatibility Analyzer.');

        // Default to /convert if no redirect specified
        if (empty($redirect)) {
            $redirect = url('/convert');
        }

        $this->redirect($this->resolveRedirect($redirect));
    }

    /**
     * Safely resolve destination URL preventing open redirect vulnerabilities
     */
    private function resolveRedirect(?string $target = null): string
    {
        $target = $target ?: (string)Session::get('intended_url', '');
        Session::remove('intended_url');

        if (empty($target)) {
            return url('/dashboard');
        }

        $appUrl = getenv('APP_URL') ?: 'http://localhost/website-to-app-converter/public';
        $appHost = parse_url($appUrl, PHP_URL_HOST);
        $appPath = parse_url($appUrl, PHP_URL_PATH) ?: '';

        // If it's a full URL
        if (filter_var($target, FILTER_VALIDATE_URL)) {
            $targetHost = parse_url($target, PHP_URL_HOST);
            if ($targetHost === $appHost) {
                return $target;
            }
            return url('/dashboard');
        }

        // If it's an absolute path from server root (e.g., /website-to-app-converter/public/convert)
        if ($appPath !== '' && str_starts_with($target, $appPath)) {
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? $appHost ?? 'localhost';
            return "{$scheme}://{$host}" . $target;
        }

        // If it's a relative app route (e.g., /convert or /convert?platform=shopify)
        if (str_starts_with($target, '/') && !str_starts_with($target, '//')) {
            return url($target);
        }

        return url('/dashboard');
    }

    public function forgotPasswordForm(): void
    {
        $this->render('auth.forgot-password', [
            'title' => 'Forgot Password - Mobile App Converter',
        ], 'auth');
    }

    public function sendResetLink(): void
    {
        $email = trim((string)$this->request->input('email', ''));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please provide a valid email address.');
            $this->redirect(url('/forgot-password'));
            return;
        }

        // Simulate reset dispatch token for now
        Session::flash('success', 'If this email is registered, password reset instructions have been sent.');
        $this->redirect(url('/forgot-password'));
    }

    public function resetPasswordForm(): void
    {
        $token = $this->request->input('token', '');
        $this->render('auth.reset-password', [
            'title' => 'Reset Password - Mobile App Converter',
            'token' => $token,
        ], 'auth');
    }

    public function resetPassword(): void
    {
        $password = $this->request->input('password', '');
        $confirmPassword = $this->request->input('password_confirmation', '');

        if (strlen($password) < 6 || $password !== $confirmPassword) {
            Session::flash('error', 'Passwords must match and have at least 6 characters.');
            $this->redirect(url('/reset-password'));
            return;
        }

        Session::flash('success', 'Your password has been reset. You may now login.');
        $this->redirect(url('/login'));
    }

    public function logout(): void
    {
        Session::destroy();
        $this->redirect(url('/login'));
    }
}
