<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Core\Database;
use PDO;

class InitialSeeder
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function run(): void
    {
        // 1. Seed Default Admin User
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => 'admin@converter.local']);
        if (!$stmt->fetch()) {
            $insertUser = $this->db->prepare("INSERT INTO users (name, email, password, role, status) VALUES (:name, :email, :password, :role, :status)");
            $insertUser->execute([
                'name' => 'System Administrator',
                'email' => 'admin@converter.local',
                'password' => password_hash('Admin@123456', PASSWORD_BCRYPT),
                'role' => 'admin',
                'status' => 'active',
            ]);
        }

        // 2. Seed Pricing Plans
        $plans = [
            [
                'name' => 'Starter App',
                'slug' => 'starter-app',
                'description' => 'Ideal for single Android store apps with standard features.',
                'price' => 4999.00,
                'billing_cycle' => 'one_time',
                'features' => json_encode(['Android App (APK + AAB)', 'Push Notifications (Basic)', 'Standard App Icon & Splash', '3 Months Support']),
                'max_apps' => 1,
                'is_featured' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Pro Combo',
                'slug' => 'pro-combo',
                'description' => 'Complete mobile presence for Android and iOS devices.',
                'price' => 8999.00,
                'billing_cycle' => 'one_time',
                'features' => json_encode(['Android & iOS Apps', 'Native Push Notifications', 'Payment Gateway Sync', 'Custom Branding & Theming', '6 Months Support']),
                'max_apps' => 1,
                'is_featured' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Enterprise Suite',
                'slug' => 'enterprise-suite',
                'description' => 'For high-scale commerce sites requiring full integration.',
                'price' => 14999.00,
                'billing_cycle' => 'one_time',
                'features' => json_encode(['Android & iOS Apps', 'All Add-ons Included', 'Priority App Store Publishing', 'Dedicated App Manager', '1 Year Support & Updates']),
                'max_apps' => 3,
                'is_featured' => 0,
                'status' => 'active',
            ],
        ];

        foreach ($plans as $plan) {
            $checkPlan = $this->db->prepare("SELECT id FROM pricing_plans WHERE slug = :slug LIMIT 1");
            $checkPlan->execute(['slug' => $plan['slug']]);
            if (!$checkPlan->fetch()) {
                $insertPlan = $this->db->prepare("INSERT INTO pricing_plans (name, slug, description, price, billing_cycle, features, max_apps, is_featured, status) VALUES (:name, :slug, :description, :price, :billing_cycle, :features, :max_apps, :is_featured, :status)");
                $insertPlan->execute($plan);
            }
        }

        // 3. Seed Themes
        $themes = [
            [
                'name' => 'Modern Minimalist',
                'slug' => 'modern-minimalist',
                'category' => 'ecommerce',
                'description' => 'Clean, whitespace-oriented mobile layout for modern brands.',
                'preview_image' => 'theme-01.png',
                'color_scheme' => json_encode(['primary' => '#18181b', 'accent' => '#6366f1', 'background' => '#ffffff']),
                'is_premium' => 0,
                'price' => 0.00,
                'status' => 'active',
            ],
            [
                'name' => 'Vibrant Commerce',
                'slug' => 'vibrant-commerce',
                'category' => 'fashion',
                'description' => 'High-contrast energetic layout designed for high conversion.',
                'preview_image' => 'theme-02.png',
                'color_scheme' => json_encode(['primary' => '#ec4899', 'accent' => '#8b5cf6', 'background' => '#fafafa']),
                'is_premium' => 1,
                'price' => 1499.00,
                'status' => 'active',
            ],
            [
                'name' => 'Dark Luxury',
                'slug' => 'dark-luxury',
                'category' => 'business',
                'description' => 'Sleek dark mode theme tailored for boutique & premium services.',
                'preview_image' => 'theme-03.png',
                'color_scheme' => json_encode(['primary' => '#0f172a', 'accent' => '#38bdf8', 'background' => '#090d16']),
                'is_premium' => 1,
                'price' => 1999.00,
                'status' => 'active',
            ],
        ];

        foreach ($themes as $theme) {
            $checkTheme = $this->db->prepare("SELECT id FROM themes WHERE slug = :slug LIMIT 1");
            $checkTheme->execute(['slug' => $theme['slug']]);
            if (!$checkTheme->fetch()) {
                $insertTheme = $this->db->prepare("INSERT INTO themes (name, slug, category, description, preview_image, color_scheme, is_premium, price, status) VALUES (:name, :slug, :category, :description, :preview_image, :color_scheme, :is_premium, :price, :status)");
                $insertTheme->execute($theme);
            }
        }

        // 4. Seed Addons
        $addons = [
            [
                'name' => 'OneSignal Push Notifications',
                'slug' => 'push-notifications',
                'description' => 'Engage users with automated cart recovery and broadcast messages.',
                'category' => 'marketing',
                'icon' => 'bell',
                'price' => 999.00,
                'billing_type' => 'one_time',
                'status' => 'active',
            ],
            [
                'name' => 'WhatsApp Direct Chat',
                'slug' => 'whatsapp-chat',
                'description' => 'Floating instant WhatsApp customer support inside mobile app.',
                'category' => 'support',
                'icon' => 'message-circle',
                'price' => 499.00,
                'billing_type' => 'one_time',
                'status' => 'active',
            ],
            [
                'name' => 'Advanced In-App Analytics',
                'slug' => 'app-analytics',
                'description' => 'Real-time telemetry, user session recording, and drop-off analysis.',
                'category' => 'analytics',
                'icon' => 'bar-chart',
                'price' => 1299.00,
                'billing_type' => 'one_time',
                'status' => 'active',
            ],
            [
                'name' => 'Google AdMob Integration',
                'slug' => 'admob-monetization',
                'description' => 'Monetize free app downloads with banner and interstitial ads.',
                'category' => 'monetization',
                'icon' => 'dollar-sign',
                'price' => 1499.00,
                'billing_type' => 'one_time',
                'status' => 'active',
            ],
        ];

        foreach ($addons as $addon) {
            $checkAddon = $this->db->prepare("SELECT id FROM addons WHERE slug = :slug LIMIT 1");
            $checkAddon->execute(['slug' => $addon['slug']]);
            if (!$checkAddon->fetch()) {
                $insertAddon = $this->db->prepare("INSERT INTO addons (name, slug, description, category, icon, price, billing_type, status) VALUES (:name, :slug, :description, :category, :icon, :price, :billing_type, :status)");
                $insertAddon->execute($addon);
            }
        }
    }
}
