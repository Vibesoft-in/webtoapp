-- Migration: Create platform_configs and website_api_credentials tables
-- Date: 2026-10-08

CREATE TABLE IF NOT EXISTS `platform_configs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(50) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `subtitle` VARCHAR(150) NOT NULL,
    `badge` VARCHAR(50) NULL,
    `description` TEXT NOT NULL,
    `setup_time` VARCHAR(50) NOT NULL DEFAULT '2–5 minutes',
    `api_type` VARCHAR(100) NOT NULL DEFAULT 'REST API',
    `required_fields` JSON NOT NULL,
    `api_scopes` JSON NULL,
    `setup_steps` JSON NOT NULL,
    `validation_rules` JSON NULL,
    `compatibility_rules` JSON NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `sort_order` INT NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_platform_key` (`key`),
    INDEX `idx_platform_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `website_api_credentials` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `website_id` INT UNSIGNED NOT NULL,
    `platform` VARCHAR(50) NOT NULL,
    `credentials_encrypted` TEXT NOT NULL,
    `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
    `verified_at` DATETIME NULL,
    `last_error` TEXT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_cred_website` (`website_id`),
    INDEX `idx_cred_platform` (`platform`),
    CONSTRAINT `fk_cred_website` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
