-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2026 at 10:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_to_app_converter`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'general',
  `icon` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `billing_type` enum('one_time','monthly','yearly') NOT NULL DEFAULT 'one_time',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`id`, `name`, `slug`, `description`, `category`, `icon`, `price`, `billing_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'OneSignal Push Notifications', 'push-notifications', 'Engage users with automated cart recovery and broadcast messages.', 'marketing', 'bell', 999.00, 'one_time', 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18'),
(2, 'WhatsApp Direct Chat', 'whatsapp-chat', 'Floating instant WhatsApp customer support inside mobile app.', 'support', 'message-circle', 499.00, 'one_time', 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18'),
(3, 'Advanced In-App Analytics', 'app-analytics', 'Real-time telemetry, user session recording, and drop-off analysis.', 'analytics', 'bar-chart', 1299.00, 'one_time', 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18'),
(4, 'Google AdMob Integration', 'admob-monetization', 'Monetize free app downloads with banner and interstitial ads.', 'monetization', 'dollar-sign', 1499.00, 'one_time', 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `website_id` int(10) UNSIGNED NOT NULL,
  `theme_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `app_name` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `version` varchar(50) NOT NULL DEFAULT '1.0.0',
  `app_icon` varchar(500) DEFAULT NULL,
  `splash_screen` varchar(500) DEFAULT NULL,
  `primary_color` varchar(50) NOT NULL DEFAULT '#4f46e5',
  `secondary_color` varchar(50) NOT NULL DEFAULT '#06b6d4',
  `platforms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`platforms`)),
  `status` enum('draft','configured','building','ready','published') NOT NULL DEFAULT 'draft',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_features`
--

CREATE TABLE `app_features` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `addon_id` int(10) UNSIGNED DEFAULT NULL,
  `feature_key` varchar(100) NOT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `builds`
--

CREATE TABLE `builds` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `build_number` int(11) NOT NULL DEFAULT 1,
  `platform` enum('android','ios','both') NOT NULL,
  `version` varchar(50) NOT NULL DEFAULT '1.0.0',
  `status` enum('queued','processing','completed','failed') NOT NULL DEFAULT 'queued',
  `apk_url` varchar(500) DEFAULT NULL,
  `aab_url` varchar(500) DEFAULT NULL,
  `ipa_url` varchar(500) DEFAULT NULL,
  `build_log` longtext DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compatibility_reports`
--

CREATE TABLE `compatibility_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `website_id` int(10) UNSIGNED NOT NULL,
  `overall_score` int(11) NOT NULL DEFAULT 0,
  `platform_status` varchar(50) NOT NULL DEFAULT 'unknown',
  `ssl_status` varchar(50) NOT NULL DEFAULT 'pending',
  `api_status` varchar(50) NOT NULL DEFAULT 'unknown',
  `mobile_score` int(11) NOT NULL DEFAULT 0,
  `report_summary` text DEFAULT NULL,
  `recommendations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`recommendations`)),
  `raw_metrics` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`raw_metrics`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compatibility_reports`
--

INSERT INTO `compatibility_reports` (`id`, `website_id`, `overall_score`, `platform_status`, `ssl_status`, `api_status`, `mobile_score`, `report_summary`, `recommendations`, `raw_metrics`, `created_at`) VALUES
(1, 1, 100, 'wordpress', 'passed', 'ready', 100, 'Your website is fully verified and ready for native iOS & Android compilation.', '[]', '{\"Platform\":\"Wordpress (Supported)\",\"HTTPS \\/ SSL\":\"Active & Valid\",\"API Connection\":\"Verified & Authenticated\",\"Data Access\":\"Real-Time Sync Ready\",\"Mobile Viewport\":\"100% Responsive\",\"App Readiness\":\"100% Native Compilation Ready\"}', '2026-10-08 08:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `improvement_requests`
--

CREATE TABLE `improvement_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `website_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `issue_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','in_review','resolved','rejected') NOT NULL DEFAULT 'pending',
  `admin_response` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'system',
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `scheduled_at` datetime DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `theme_id` int(10) UNSIGNED DEFAULT NULL,
  `selected_addons` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`selected_addons`)),
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `status` enum('pending','completed','failed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gateway` varchar(50) NOT NULL DEFAULT 'razorpay',
  `gateway_order_id` varchar(255) DEFAULT NULL,
  `gateway_payment_id` varchar(255) DEFAULT NULL,
  `gateway_signature` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `status` enum('initiated','captured','failed','refunded') NOT NULL DEFAULT 'initiated',
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platform_configs`
--

CREATE TABLE `platform_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subtitle` varchar(150) NOT NULL,
  `badge` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `setup_time` varchar(50) NOT NULL DEFAULT '2–5 minutes',
  `api_type` varchar(100) NOT NULL DEFAULT 'REST API',
  `required_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`required_fields`)),
  `api_scopes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`api_scopes`)),
  `setup_steps` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`setup_steps`)),
  `validation_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`validation_rules`)),
  `compatibility_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`compatibility_rules`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platform_configs`
--

INSERT INTO `platform_configs` (`id`, `key`, `name`, `subtitle`, `badge`, `description`, `setup_time`, `api_type`, `required_fields`, `api_scopes`, `setup_steps`, `validation_rules`, `compatibility_rules`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'wordpress', 'WordPress', 'REST API / Application Password', 'Native Sync', 'To connect your WordPress website with AppifyHub, you need to enable API access and create an Application Password.', '2–5 minutes', 'WordPress REST API', '[{\"name\":\"url\",\"label\":\"Website URL\",\"type\":\"url\",\"placeholder\":\"https:\\/\\/yourwebsite.com\",\"required\":true,\"help\":\"Must use HTTPS with a valid SSL certificate.\"},{\"name\":\"username\",\"label\":\"Administrator Username\",\"type\":\"text\",\"placeholder\":\"admin\",\"required\":true,\"help\":\"The WordPress user must possess administrator-level permissions.\"},{\"name\":\"application_password\",\"label\":\"Application Password\",\"type\":\"password\",\"placeholder\":\"xxxx xxxx xxxx xxxx\",\"required\":true,\"sensitive\":true,\"help\":\"Generated unique application password (different from your regular account password).\"}]', '[\"Posts\",\"Pages\",\"Media\",\"Users\",\"Taxonomies\"]', '[{\"step\":1,\"title\":\"Log in to WordPress\",\"instruction\":\"Open your WordPress administrative dashboard. Ensure you log in with an administrator account.\",\"example\":\"https:\\/\\/yourwebsite.com\\/wp-admin\",\"where_to_find\":\"Where to find this \\u2192 Open your browser and navigate to your website\'s \\/wp-admin login page.\",\"screenshot\":\"api-guides\\/wordpress\\/step-01-login.svg\"},{\"step\":2,\"title\":\"Open Your User Profile\",\"instruction\":\"From the WordPress dashboard left sidebar, navigate to Users \\u2192 Profile (or Users \\u2192 Your Profile depending on your WordPress version).\",\"example\":\"WordPress Dashboard \\u2192 Users \\u2192 Profile\",\"where_to_find\":\"Where to find this \\u2192 Left-hand navigation menu under the \\\"Users\\\" heading.\",\"screenshot\":\"api-guides\\/wordpress\\/step-02-profile.svg\"},{\"step\":3,\"title\":\"Find Application Passwords\",\"instruction\":\"Scroll down to the \\\"Application Passwords\\\" section. Note that Application Passwords allow secure external authentication without exposing your normal account password.\",\"example\":\"Section: Application Passwords\",\"where_to_find\":\"Where to find this \\u2192 Scroll down past the Name, Contact Info, and About Yourself sections to Application Passwords.\",\"screenshot\":\"api-guides\\/wordpress\\/step-03-application-password.svg\"},{\"step\":4,\"title\":\"Create an Application Password\",\"instruction\":\"Enter \\\"AppifyHub\\\" into the \\\"New Application Password Name\\\" field and click the \\\"Add New Application Password\\\" button.\",\"example\":\"Application Name: AppifyHub\",\"where_to_find\":\"Where to find this \\u2192 Type \\\"AppifyHub\\\" into the text input and click the blue button.\",\"screenshot\":\"api-guides\\/wordpress\\/step-04-create-password.svg\"},{\"step\":5,\"title\":\"Copy the Generated Credentials\",\"instruction\":\"Copy the 16-character generated application password immediately. WordPress will only display this password once.\",\"example\":\"Format: abcd efgh ijkl mnop\",\"where_to_find\":\"Where to find this \\u2192 Highlight and copy the highlighted password in the green notice banner.\",\"screenshot\":\"api-guides\\/wordpress\\/step-04-create-password.svg\"}]', '{\"requires_ssl\":true,\"min_wp_version\":\"5.6\"}', '{\"check_rest_api\":true,\"check_cors\":true}', 1, 1, '2026-10-08 11:48:49', '2026-10-08 11:48:49'),
(2, 'woocommerce', 'WooCommerce', 'REST API', 'Store Engine', 'Connect your WooCommerce store using its REST API so AppifyHub can securely access the required store data.', '3–5 minutes', 'WooCommerce REST API v3', '[{\"name\":\"url\",\"label\":\"Store URL\",\"type\":\"url\",\"placeholder\":\"https:\\/\\/yourstore.com\",\"required\":true,\"help\":\"Your WooCommerce storefront URL.\"},{\"name\":\"consumer_key\",\"label\":\"Consumer Key\",\"type\":\"text\",\"placeholder\":\"ck_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"required\":true,\"help\":\"Starts with ck_.\"},{\"name\":\"consumer_secret\",\"label\":\"Consumer Secret\",\"type\":\"password\",\"placeholder\":\"cs_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"required\":true,\"sensitive\":true,\"help\":\"Starts with cs_. Treat your Consumer Secret as sensitive information.\"}]', '[\"Products\",\"Orders\",\"Customers\",\"Coupons\",\"Categories\"]', '[{\"step\":1,\"title\":\"Open WordPress Admin\",\"instruction\":\"Log in to your WordPress administrative dashboard where WooCommerce is installed.\",\"example\":\"https:\\/\\/yourstore.com\\/wp-admin\",\"where_to_find\":\"Where to find this \\u2192 Enter your store admin URL in your browser.\",\"screenshot\":\"api-guides\\/woocommerce\\/step-01-login.svg\"},{\"step\":2,\"title\":\"Open WooCommerce Settings\",\"instruction\":\"In the left sidebar, click WooCommerce \\u2192 Settings. Next, click on the \\\"Advanced\\\" tab at the top right of the settings tabs, then select \\\"REST API\\\".\",\"example\":\"WooCommerce \\u2192 Settings \\u2192 Advanced \\u2192 REST API\",\"where_to_find\":\"Where to find this \\u2192 Left sidebar: WooCommerce > Settings, then top tab \\\"Advanced\\\", sub-link \\\"REST API\\\".\",\"screenshot\":\"api-guides\\/woocommerce\\/step-02-settings.svg\"},{\"step\":3,\"title\":\"Add API Key\",\"instruction\":\"Click the \\\"Add key\\\" or \\\"Create an API key\\\" button. Set the Description to \\\"AppifyHub\\\", select an administrator or store manager user, and set Permissions to \\\"Read\\/Write\\\".\",\"example\":\"Description: AppifyHub | Permissions: Read\\/Write\",\"where_to_find\":\"Where to find this \\u2192 Blue \\\"Add key\\\" button in the REST API list.\",\"screenshot\":\"api-guides\\/woocommerce\\/step-03-rest-api.svg\"},{\"step\":4,\"title\":\"Generate API Credentials\",\"instruction\":\"Click \\\"Generate API key\\\". WooCommerce will display your Consumer Key and Consumer Secret. Copy both values now before leaving the page.\",\"example\":\"ck_... (Consumer Key) & cs_... (Consumer Secret)\",\"where_to_find\":\"Where to find this \\u2192 Key details page displayed immediately after creation.\",\"screenshot\":\"api-guides\\/woocommerce\\/step-04-create-key.svg\"}]', '{\"requires_ssl\":true,\"key_prefix\":\"ck_\",\"secret_prefix\":\"cs_\"}', '{\"check_wc_api\":true,\"check_permalinks\":true}', 1, 2, '2026-10-08 11:48:49', '2026-10-08 11:48:49'),
(3, 'shopify', 'Shopify', 'Storefront / Admin API', 'Direct Connect', 'Connect your Shopify store using Shopify\'s supported APIs and the permissions required by AppifyHub.', '5–10 minutes', 'Shopify Admin API', '[{\"name\":\"url\",\"label\":\"Shopify Store URL\",\"type\":\"url\",\"placeholder\":\"https:\\/\\/your-store.myshopify.com\",\"required\":true,\"help\":\"Your .myshopify.com domain or custom storefront URL.\"},{\"name\":\"access_token\",\"label\":\"Admin API Access Token\",\"type\":\"password\",\"placeholder\":\"shpat_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"required\":true,\"sensitive\":true,\"help\":\"Starts with shpat_. Generated in your Shopify custom app.\"}]', '[\"Products\",\"Orders\",\"Customers\",\"Store data\"]', '[{\"step\":1,\"title\":\"Open Shopify Admin\",\"instruction\":\"Log in to your Shopify administrative dashboard as a store owner or staff member with app development permissions.\",\"example\":\"https:\\/\\/admin.shopify.com\\/store\\/your-store\",\"where_to_find\":\"Where to find this \\u2192 Log in at admin.shopify.com or your myshopify.com address.\",\"screenshot\":\"api-guides\\/shopify\\/step-01-admin.svg\"},{\"step\":2,\"title\":\"Open Apps \\/ App Development\",\"instruction\":\"Open your Shopify admin and navigate to the area where custom\\/development apps are managed (Settings \\u2192 Apps and sales channels \\u2192 Develop apps).\",\"example\":\"Settings \\u2192 Apps and sales channels \\u2192 Develop apps\",\"where_to_find\":\"Where to find this \\u2192 Bottom left \\\"Settings\\\" gear, then \\\"Apps and sales channels\\\", then click \\\"Develop apps\\\".\",\"screenshot\":\"api-guides\\/shopify\\/step-02-app-development.svg\"},{\"step\":3,\"title\":\"Create or Select the App\",\"instruction\":\"Click \\\"Create an app\\\". Enter \\\"AppifyHub Integration\\\" as the App name and assign your store administrator as the App developer.\",\"example\":\"App Name: AppifyHub Integration\",\"where_to_find\":\"Where to find this \\u2192 Green \\\"Create an app\\\" button at the top right of the App Development page.\",\"screenshot\":\"api-guides\\/shopify\\/step-03-api-access.svg\"},{\"step\":4,\"title\":\"Configure API Access & Install App\",\"instruction\":\"Under Configuration \\u2192 Admin API integration, grant only the required permissions: Products (read), Orders (read), Customers (read), Store content (read). Save and click \\\"Install app\\\".\",\"example\":\"Scopes: read_products, read_orders, read_customers, read_content\",\"where_to_find\":\"Where to find this \\u2192 \\\"Configuration\\\" tab, Admin API access scopes, then \\\"Install app\\\".\",\"screenshot\":\"api-guides\\/shopify\\/step-03-api-access.svg\"},{\"step\":5,\"title\":\"Generate & Copy Access Token\",\"instruction\":\"Click \\\"Reveal token once\\\" under API credentials to copy your Admin API access token (starts with shpat_). Note: Shopify displays this token only once.\",\"example\":\"shpat_... (Admin API access token)\",\"where_to_find\":\"Where to find this \\u2192 Under \\\"API credentials\\\" section after installing the app.\",\"screenshot\":\"api-guides\\/shopify\\/step-04-token.svg\"}]', '{\"token_prefix\":\"shpat_\",\"requires_domain\":true}', '{\"check_shopify_api\":true}', 1, 3, '2026-10-08 11:48:49', '2026-10-08 11:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `billing_cycle` enum('one_time','monthly','yearly') NOT NULL DEFAULT 'one_time',
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `max_apps` int(11) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing_plans`
--

INSERT INTO `pricing_plans` (`id`, `name`, `slug`, `description`, `price`, `billing_cycle`, `features`, `max_apps`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Starter App', 'starter-app', 'Ideal for single Android store apps with standard features.', 4999.00, 'one_time', '[\"Android App (APK + AAB)\",\"Push Notifications (Basic)\",\"Standard App Icon & Splash\",\"3 Months Support\"]', 1, 0, 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18'),
(2, 'Pro Combo', 'pro-combo', 'Complete mobile presence for Android and iOS devices.', 8999.00, 'one_time', '[\"Android & iOS Apps\",\"Native Push Notifications\",\"Payment Gateway Sync\",\"Custom Branding & Theming\",\"6 Months Support\"]', 1, 1, 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18'),
(3, 'Enterprise Suite', 'enterprise-suite', 'For high-scale commerce sites requiring full integration.', 14999.00, 'one_time', '[\"Android & iOS Apps\",\"All Add-ons Included\",\"Priority App Store Publishing\",\"Dedicated App Manager\",\"1 Year Support & Updates\"]', 3, 0, 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_number` varchar(100) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `status` enum('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'ecommerce',
  `description` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `preview_image` varchar(500) DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `color_scheme` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`color_scheme`)),
  `badge` varchar(100) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_premium` tinyint(1) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `slug`, `category`, `description`, `features`, `preview_image`, `demo_url`, `color_scheme`, `badge`, `is_featured`, `is_premium`, `price`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Minimal', 'minimal', 'minimal', 'A clean, whitespace-focused mobile experience designed for minimalist online stores and lifestyle brands.', '[\"Clean Navigation\",\"Hero Product Display\",\"Category Carousels\",\"1-Tap Quick Cart\",\"Minimal Typography\"]', 'images/theme_modern_minimalist.jpg', '/themes/modern-minimalist/demo', '{\"primary\":\"#252525\",\"accent\":\"#B69A78\",\"bg\":\"#FBF9F7\"}', 'Minimal Style', 0, 0, 0.00, 1, 'active', '2026-10-07 13:34:18', '2026-10-12 12:09:08'),
(2, 'Trendy', 'trendy', 'trendy', 'A bold, energetic high-contrast mobile design built for trending boutique fashion and beauty brands.', '[\"Dynamic Hero Banners\",\"Lookbook Grid\",\"Instant Wishlist\",\"Discount Badges\",\"Size & Color Selector\"]', 'images/theme_vibrant_commerce.jpg', '/themes/vibrant-commerce/demo', '{\"primary\":\"#111827\",\"accent\":\"#E11D48\",\"bg\":\"#FFFFFF\"}', 'Trendy Style', 0, 1, 1499.00, 3, 'active', '2026-10-07 13:34:18', '2026-10-12 12:09:08'),
(3, 'Dark Luxury', 'dark-luxury', 'business', 'Sleek dark mode theme tailored for boutique & premium services.', NULL, 'theme-03.png', NULL, '{\"primary\":\"#0f172a\",\"accent\":\"#38bdf8\",\"background\":\"#090d16\"}', NULL, 0, 1, 1999.00, 0, 'inactive', '2026-10-07 13:34:18', '2026-10-08 13:18:29'),
(6, 'Modern', 'modern', 'modern', 'A contemporary, refined mobile shopping experience with rich typography and curated storytelling layouts.', '[\"Editorial Typography\",\"Storytelling Layouts\",\"Curated Collections\",\"Refined Gallery Cards\",\"VIP Membership Sync\"]', 'images/theme_elegant_store.jpg', '/themes/elegant-store/demo', '{\"primary\":\"#2E282A\",\"accent\":\"#9A8262\",\"bg\":\"#F8F6F4\"}', 'Modern Style', 0, 1, 1999.00, 2, 'active', '2026-10-08 13:18:29', '2026-10-12 12:09:08'),
(7, 'Restaurant & Dining', 'restaurant', 'restaurant', 'A conversion-focused mobile experience for restaurants, cafes, cloud kitchens and food businesses.', '[\"Interactive Menu Categories\",\"Dish Customizer & Add-ons\",\"Table Reservation \\/ Pickup\",\"Live Order Tracking\",\"Chef Specials Carousel\"]', 'images/theme_restaurant.jpg', '/themes/restaurant/demo', '{\"primary\":\"#831843\",\"accent\":\"#F59E0B\",\"bg\":\"#FFFBEB\"}', 'Food & Drink', 0, 1, 1499.00, 4, 'inactive', '2026-10-08 13:18:29', '2026-10-12 12:09:08'),
(8, 'Business Pro', 'business-pro', 'business', 'A professional mobile experience for service businesses, agencies, consultants and local businesses.', '[\"Service Showcase Cards\",\"Client Testimonials Slider\",\"One-Tap WhatsApp CTA\",\"Instant Consultation Booking\",\"Case Study Portfolio\"]', 'images/theme_business_pro.jpg', '/themes/business-pro/demo', '{\"primary\":\"#1E293B\",\"accent\":\"#0284C7\",\"bg\":\"#F8FAFC\"}', 'Services', 1, 1, 1999.00, 5, 'inactive', '2026-10-08 13:18:29', '2026-10-12 12:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `phone` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'System Administrator', 'admin@converter.local', '$2y$10$zN80GZPUpL/8WVDPxkXucexdc1vAsCyqjYzuL/PCV3CVafc4WABhC', 'admin', NULL, NULL, 'active', '2026-10-07 13:34:18', '2026-10-07 13:34:18'),
(2, 'Test User', 'testuser_1791786576@example.com', '$2y$10$wZUQBMHnB/SK/jgGSLbKgetkT92XzAlYMFVetBi3uLQzr9egZmg3y', 'customer', '+15551234567', NULL, 'active', '2026-10-12 08:29:36', '2026-10-12 08:29:36'),
(3, 'Test User', 'testuser_1791786638@example.com', '$2y$10$W.fzMwonT/z4Qqr1rWVPHe9.zGEhEbP2WcSUgrUoUSqfk2RRcm3LC', 'customer', '+15551234567', NULL, 'active', '2026-10-12 08:30:38', '2026-10-12 08:30:38'),
(4, 'Test User', 'testuser_1791786675@example.com', '$2y$10$TEZq.SM0jJHzneNY8DNziOhcZex4IGjhITZEqESMfcomaK8edDGl6', 'customer', '+15551234567', NULL, 'active', '2026-10-12 08:31:15', '2026-10-12 08:31:15'),
(5, 'Test User', 'testuser_1791786738@example.com', '$2y$10$U0JtMgBXDqm5QpL1y2yQdejoWf6OJ1nhSwaGEt5y5GDtedgg24wD2', 'customer', '+15551234567', NULL, 'active', '2026-10-12 08:32:18', '2026-10-12 08:32:18'),
(7, 'VibeSoft', 'seo.vibesoft@gmail.com', '$2y$10$w6tS7Ahlc0mELWuXtOteX./vAR89i2PdkRKLYJxjiihCVbQ0saumy', 'customer', '+918630016443', NULL, 'active', '2026-10-12 09:22:14', '2026-10-12 09:22:14'),
(8, 'sans', 'sans123@gmail.com', '$2y$10$vjhJ5tBfT3jSiUvj1.oQMuTFTV41MR3FvFBRzCgZ2Ya4tlaSSSo/.', 'customer', '1234567890', NULL, 'active', '2026-10-12 09:56:05', '2026-10-12 09:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `platform` varchar(100) NOT NULL DEFAULT 'custom',
  `ssl_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `last_checked_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `user_id`, `url`, `domain`, `platform`, `ssl_enabled`, `status`, `last_checked_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'https://wordpress.org', 'wordpress.org', 'wordpress', 1, 'compatible', '2026-10-08 08:38:49', '2026-10-08 08:34:08', '2026-10-08 12:08:49'),
(2, 7, 'https://vibesoft.in/', 'vibesoft.in', 'woocommerce', 1, 'pending', '2026-10-09 12:51:40', '2026-10-09 12:51:40', '2026-10-12 09:22:14'),
(4, 8, 'https://uttarakhandekta.com/', 'uttarakhandekta.com', 'wordpress', 1, 'pending', '2026-10-12 09:56:05', '2026-10-12 09:56:05', '2026-10-12 09:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `website_api_credentials`
--

CREATE TABLE `website_api_credentials` (
  `id` int(10) UNSIGNED NOT NULL,
  `website_id` int(10) UNSIGNED NOT NULL,
  `platform` varchar(50) NOT NULL,
  `credentials_encrypted` text NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified_at` datetime DEFAULT NULL,
  `last_error` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_api_credentials`
--

INSERT INTO `website_api_credentials` (`id`, `website_id`, `platform`, `credentials_encrypted`, `is_verified`, `verified_at`, `last_error`, `created_at`, `updated_at`) VALUES
(1, 1, 'wordpress', 'tzNRc4iv4vz3hMGy+S/8STo6Rzl0aTVXZStkME5lTnR5ME5aejh5TzVISmx1b3hzOHJmQWFBbjE5dzRGYm0zQmQ0UFRDUS9ybWFaaEozdzhSbG5HajUwZFpSYXk3azJ1RHdNbmk5UThWNW5nSk9QV1E2RHk1QVhzSXd5VjY2TEwvV0pTVWV0TnhoL01lcVRyT296a0VzSmxJT0laQ1JsVGZUUjR4UXAxTDdQNFMvTjhLUWtEdEc3VlVrTzZMU2d6b2RvSUtmUlJWdDdzeE5TdkRiNU9DV3FpN01uVjJPeG9YcmMwb3FXcUF0TjJmWi9jMi9sQ1M5eGkzQlczN2h2NEVmZXZoekJ2N2xFQW9NUFVXMG1EN05NODVxRHRIUUVRVEFKTzlyTk1Pb2U3am55ZFhuMWFwc01VVUJ5enc9', 0, NULL, 'Authentication failed (HTTP 401). The username or Application Password is incorrect. Please ensure the user has administrator privileges.', '2026-10-08 12:08:46', '2026-10-08 12:08:46'),
(2, 2, 'wordpress', 'SU5BRfB4RCppAGBaSOpuVzo6cnY1a0dPMDB6M1NDMWJFZ2phc0ZtZW1jQzdKRzBab3ZXV2FMOVFpblhRbm50VExhZHJVdUR3NzBwbWtEcmRjcXc1NjlORHcwM2xHUTVDcFRZQW1Hb3lNMFludS9DVGJFKzRMMDl0SjNoRWY2WWwwN0ZlczFuVGtKaUhhMmQ0cVVGZThMWTNOQ1RwR25pN2luQVE5ci9jN0pBeCtEWXI5ZThQcWlOa2JueGt0ejVubzFCZkFHOFU1bXNFS2lsUDhmL0xEcXhJVVU5SVRGTTFkMHRtMFZLWGN1cVRmSzBzWi9wK1Z1YWNxcFdERkxadzRqYm9QTjYvV0tIR2cxSnpJY2poQ2NNL3dFend5TnlDNXo0RGFucyt2M2pzMTVYZEE4SVl3M3dlbXJueFk9', 0, NULL, 'Authentication failed (HTTP 401). The username or Application Password is incorrect. Please ensure the user has administrator privileges.', '2026-10-09 16:22:00', '2026-10-09 16:22:11'),
(3, 4, 'wordpress', 'tQUeYgaass6Q1bBEIdXKNTo6RmdhWSttY2t5eGxlYmtKVzI3cWxxSWIxYWZqdDRlM0JUQ3Q1aTVWNEZ1UWZDOXkvN0pKQkJXbmRQM1Nla05KRXVudGt2QTYySllTTk5qOHV2WkVMUzVHWncra3FhNlUxTjFLalVPbWpyMVZOc1JZU1VTcVZjT3BVeVBWOENPRHQrSXhkZDNhT3kwYlJSYkg0Szl0RUpNL041Nktnc3hvWGxqcGxIU3phd2VzcVdWY2NlczdhSE11UmNEdlExSDZIME03TnpzaHhpaDE4a0JqU04za084U3pkVDJ5WmxKQUovS2NDdTQrcnRUU0ZtcHByVFAwaHd2a3ZWV0hCMnZKVGprOVQ4UTdIT3lYMGpVazdtNm44bHBnUTNJOVluN1ZHWWZvb1NndDZLQjQ9', 0, NULL, 'Authentication failed (HTTP 401). The username or Application Password is incorrect. Please ensure the user has administrator privileges.', '2026-10-12 13:26:35', '2026-10-12 13:28:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_addons_slug` (`slug`),
  ADD KEY `idx_addons_status` (`status`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_apps_user_id` (`user_id`),
  ADD KEY `idx_apps_website_id` (`website_id`),
  ADD KEY `idx_apps_status` (`status`),
  ADD KEY `fk_apps_theme` (`theme_id`),
  ADD KEY `fk_apps_order` (`order_id`);

--
-- Indexes for table `app_features`
--
ALTER TABLE `app_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_features_app_id` (`app_id`),
  ADD KEY `fk_features_addon` (`addon_id`);

--
-- Indexes for table `builds`
--
ALTER TABLE `builds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_builds_app_id` (`app_id`),
  ADD KEY `idx_builds_status` (`status`);

--
-- Indexes for table `compatibility_reports`
--
ALTER TABLE `compatibility_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reports_website_id` (`website_id`);

--
-- Indexes for table `improvement_requests`
--
ALTER TABLE `improvement_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_improvement_status` (`status`),
  ADD KEY `idx_improvement_website_id` (`website_id`),
  ADD KEY `fk_improvement_user` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_notifications_user_id` (`user_id`),
  ADD KEY `idx_notifications_status` (`status`),
  ADD KEY `fk_notifications_app` (`app_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `idx_orders_user_id` (`user_id`),
  ADD KEY `idx_orders_number` (`order_number`),
  ADD KEY `idx_orders_status` (`status`),
  ADD KEY `fk_orders_plan` (`plan_id`),
  ADD KEY `fk_orders_theme` (`theme_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_payments_order_id` (`order_id`),
  ADD KEY `idx_payments_gateway_order` (`gateway_order_id`),
  ADD KEY `fk_payments_user` (`user_id`);

--
-- Indexes for table `platform_configs`
--
ALTER TABLE `platform_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`),
  ADD KEY `idx_platform_key` (`key`),
  ADD KEY `idx_platform_active` (`is_active`);

--
-- Indexes for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_plans_slug` (`slug`),
  ADD KEY `idx_plans_status` (`status`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `idx_tickets_user_id` (`user_id`),
  ADD KEY `idx_tickets_number` (`ticket_number`),
  ADD KEY `idx_tickets_status` (`status`),
  ADD KEY `fk_tickets_app` (`app_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_themes_slug` (`slug`),
  ADD KEY `idx_themes_status` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_role` (`role`),
  ADD KEY `idx_users_status` (`status`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_websites_user_id` (`user_id`),
  ADD KEY `idx_websites_domain` (`domain`);

--
-- Indexes for table `website_api_credentials`
--
ALTER TABLE `website_api_credentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cred_website` (`website_id`),
  ADD KEY `idx_cred_platform` (`platform`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_features`
--
ALTER TABLE `app_features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `builds`
--
ALTER TABLE `builds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compatibility_reports`
--
ALTER TABLE `compatibility_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `improvement_requests`
--
ALTER TABLE `improvement_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platform_configs`
--
ALTER TABLE `platform_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website_api_credentials`
--
ALTER TABLE `website_api_credentials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apps`
--
ALTER TABLE `apps`
  ADD CONSTRAINT `fk_apps_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_apps_theme` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_apps_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_apps_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`);

--
-- Constraints for table `app_features`
--
ALTER TABLE `app_features`
  ADD CONSTRAINT `fk_features_addon` FOREIGN KEY (`addon_id`) REFERENCES `addons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_features_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `builds`
--
ALTER TABLE `builds`
  ADD CONSTRAINT `fk_builds_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compatibility_reports`
--
ALTER TABLE `compatibility_reports`
  ADD CONSTRAINT `fk_reports_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `improvement_requests`
--
ALTER TABLE `improvement_requests`
  ADD CONSTRAINT `fk_improvement_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_improvement_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_plan` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_orders_theme` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `fk_tickets_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_tickets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `websites`
--
ALTER TABLE `websites`
  ADD CONSTRAINT `fk_websites_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `website_api_credentials`
--
ALTER TABLE `website_api_credentials`
  ADD CONSTRAINT `fk_cred_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
