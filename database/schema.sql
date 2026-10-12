-- ===================================================
-- Database Schema for Website-to-App Converter Platform
-- MySQL / MariaDB 8+ Compatible
-- ===================================================

CREATE DATABASE IF NOT EXISTS `website_to_app_converter` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `website_to_app_converter`;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
    `phone` VARCHAR(50) NULL,
    `avatar` VARCHAR(255) NULL,
    `status` ENUM('active', 'inactive', 'suspended') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_users_role` (`role`),
    INDEX `idx_users_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Websites Table
CREATE TABLE IF NOT EXISTS `websites` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NULL,
    `url` VARCHAR(500) NOT NULL,
    `domain` VARCHAR(255) NOT NULL,
    `platform` VARCHAR(100) NOT NULL DEFAULT 'custom',
    `ssl_enabled` TINYINT(1) NOT NULL DEFAULT 0,
    `status` VARCHAR(50) NOT NULL DEFAULT 'pending',
    `last_checked_at` DATETIME NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_websites_user_id` (`user_id`),
    INDEX `idx_websites_domain` (`domain`),
    CONSTRAINT `fk_websites_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Compatibility Reports Table
CREATE TABLE IF NOT EXISTS `compatibility_reports` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `website_id` INT UNSIGNED NOT NULL,
    `overall_score` INT NOT NULL DEFAULT 0,
    `platform_status` VARCHAR(50) NOT NULL DEFAULT 'unknown',
    `ssl_status` VARCHAR(50) NOT NULL DEFAULT 'pending',
    `api_status` VARCHAR(50) NOT NULL DEFAULT 'unknown',
    `mobile_score` INT NOT NULL DEFAULT 0,
    `report_summary` TEXT NULL,
    `recommendations` JSON NULL,
    `raw_metrics` JSON NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_reports_website_id` (`website_id`),
    CONSTRAINT `fk_reports_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Improvement Requests Table
CREATE TABLE IF NOT EXISTS `improvement_requests` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `website_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NULL,
    `issue_type` VARCHAR(100) NOT NULL,
    `description` TEXT NOT NULL,
    `notes` TEXT NULL,
    `status` ENUM('pending', 'in_review', 'resolved', 'rejected') NOT NULL DEFAULT 'pending',
    `admin_response` TEXT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_improvement_status` (`status`),
    INDEX `idx_improvement_website_id` (`website_id`),
    CONSTRAINT `fk_improvement_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_improvement_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Themes Table
CREATE TABLE IF NOT EXISTS `themes` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `category` VARCHAR(100) NOT NULL DEFAULT 'ecommerce',
    `description` TEXT NULL,
    `preview_image` VARCHAR(500) NULL,
    `color_scheme` JSON NULL,
    `is_premium` TINYINT(1) NOT NULL DEFAULT 0,
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_themes_slug` (`slug`),
    INDEX `idx_themes_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Addons Table
CREATE TABLE IF NOT EXISTS `addons` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT NULL,
    `category` VARCHAR(100) NOT NULL DEFAULT 'general',
    `icon` VARCHAR(255) NULL,
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `billing_type` ENUM('one_time', 'monthly', 'yearly') NOT NULL DEFAULT 'one_time',
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_addons_slug` (`slug`),
    INDEX `idx_addons_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Pricing Plans Table
CREATE TABLE IF NOT EXISTS `pricing_plans` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT NULL,
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `billing_cycle` ENUM('one_time', 'monthly', 'yearly') NOT NULL DEFAULT 'one_time',
    `features` JSON NULL,
    `max_apps` INT NOT NULL DEFAULT 1,
    `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_plans_slug` (`slug`),
    INDEX `idx_plans_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Orders Table
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_number` VARCHAR(100) NOT NULL UNIQUE,
    `user_id` INT UNSIGNED NOT NULL,
    `plan_id` INT UNSIGNED NULL,
    `theme_id` INT UNSIGNED NULL,
    `selected_addons` JSON NULL,
    `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `tax` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `total_amount` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `currency` VARCHAR(10) NOT NULL DEFAULT 'INR',
    `status` ENUM('pending', 'completed', 'failed', 'cancelled') NOT NULL DEFAULT 'pending',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_orders_user_id` (`user_id`),
    INDEX `idx_orders_number` (`order_number`),
    INDEX `idx_orders_status` (`status`),
    CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `fk_orders_plan` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_orders_theme` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Payments Table
CREATE TABLE IF NOT EXISTS `payments` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `gateway` VARCHAR(50) NOT NULL DEFAULT 'razorpay',
    `gateway_order_id` VARCHAR(255) NULL,
    `gateway_payment_id` VARCHAR(255) NULL,
    `gateway_signature` VARCHAR(255) NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    `currency` VARCHAR(10) NOT NULL DEFAULT 'INR',
    `status` ENUM('initiated', 'captured', 'failed', 'refunded') NOT NULL DEFAULT 'initiated',
    `payload` JSON NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_payments_order_id` (`order_id`),
    INDEX `idx_payments_gateway_order` (`gateway_order_id`),
    CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_payments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. Apps Table
CREATE TABLE IF NOT EXISTS `apps` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `website_id` INT UNSIGNED NOT NULL,
    `theme_id` INT UNSIGNED NULL,
    `order_id` INT UNSIGNED NULL,
    `app_name` VARCHAR(255) NOT NULL,
    `package_name` VARCHAR(255) NOT NULL,
    `version` VARCHAR(50) NOT NULL DEFAULT '1.0.0',
    `app_icon` VARCHAR(500) NULL,
    `splash_screen` VARCHAR(500) NULL,
    `primary_color` VARCHAR(50) NOT NULL DEFAULT '#4f46e5',
    `secondary_color` VARCHAR(50) NOT NULL DEFAULT '#06b6d4',
    `platforms` JSON NULL,
    `status` ENUM('draft', 'configured', 'building', 'ready', 'published') NOT NULL DEFAULT 'draft',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_apps_user_id` (`user_id`),
    INDEX `idx_apps_website_id` (`website_id`),
    INDEX `idx_apps_status` (`status`),
    CONSTRAINT `fk_apps_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `fk_apps_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `fk_apps_theme` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_apps_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. App Features Table
CREATE TABLE IF NOT EXISTS `app_features` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `app_id` INT UNSIGNED NOT NULL,
    `addon_id` INT UNSIGNED NULL,
    `feature_key` VARCHAR(100) NOT NULL,
    `config` JSON NULL,
    `is_enabled` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_features_app_id` (`app_id`),
    CONSTRAINT `fk_features_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_features_addon` FOREIGN KEY (`addon_id`) REFERENCES `addons` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. Builds Table
CREATE TABLE IF NOT EXISTS `builds` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `app_id` INT UNSIGNED NOT NULL,
    `build_number` INT NOT NULL DEFAULT 1,
    `platform` ENUM('android', 'ios', 'both') NOT NULL,
    `version` VARCHAR(50) NOT NULL DEFAULT '1.0.0',
    `status` ENUM('queued', 'processing', 'completed', 'failed') NOT NULL DEFAULT 'queued',
    `apk_url` VARCHAR(500) NULL,
    `aab_url` VARCHAR(500) NULL,
    `ipa_url` VARCHAR(500) NULL,
    `build_log` LONGTEXT NULL,
    `started_at` DATETIME NULL,
    `completed_at` DATETIME NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_builds_app_id` (`app_id`),
    INDEX `idx_builds_status` (`status`),
    CONSTRAINT `fk_builds_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. Notifications Table
CREATE TABLE IF NOT EXISTS `notifications` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `app_id` INT UNSIGNED NULL,
    `title` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `type` VARCHAR(50) NOT NULL DEFAULT 'system',
    `status` ENUM('unread', 'read') NOT NULL DEFAULT 'unread',
    `scheduled_at` DATETIME NULL,
    `sent_at` DATETIME NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_notifications_user_id` (`user_id`),
    INDEX `idx_notifications_status` (`status`),
    CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_notifications_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 14. Support Tickets Table
CREATE TABLE IF NOT EXISTS `support_tickets` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `ticket_number` VARCHAR(100) NOT NULL UNIQUE,
    `user_id` INT UNSIGNED NOT NULL,
    `app_id` INT UNSIGNED NULL,
    `subject` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `priority` ENUM('low', 'medium', 'high', 'urgent') NOT NULL DEFAULT 'medium',
    `status` ENUM('open', 'in_progress', 'resolved', 'closed') NOT NULL DEFAULT 'open',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_tickets_user_id` (`user_id`),
    INDEX `idx_tickets_number` (`ticket_number`),
    INDEX `idx_tickets_status` (`status`),
    CONSTRAINT `fk_tickets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_tickets_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
