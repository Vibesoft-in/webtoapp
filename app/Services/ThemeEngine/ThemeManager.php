<?php

declare(strict_types=1);

namespace App\Services\ThemeEngine;

use App\Models\Theme;

class ThemeManager
{
    private Theme $themeModel;

    public function __construct()
    {
        $this->themeModel = new Theme();
    }

    /**
     * Get all active themes from database with parsed features and demo content
     */
    public function getAllThemes(): array
    {
        $dbThemes = $this->themeModel->getActiveThemes();
        $results = [];

        foreach ($dbThemes as $theme) {
            $slug = $theme['slug'];
            $demoContent = ThemeConfiguration::getThemeDemoContent($slug);

            $features = [];
            if (!empty($theme['features'])) {
                $decoded = json_decode($theme['features'], true);
                $features = is_array($decoded) ? $decoded : explode(',', $theme['features']);
            }

            $theme['parsed_features'] = $features;
            $theme['demo_content'] = $demoContent;
            $theme['formatted_price'] = (float)$theme['price'] <= 0 
                ? 'Included in Plan' 
                : '₹' . number_format((float)$theme['price'], 0);

            $results[] = $theme;
        }

        return $results;
    }

    /**
     * Get single theme by slug with alias support
     */
    public function getThemeBySlug(string $slug): ?array
    {
        $aliasMap = [
            'minimal' => ['minimal', 'modern-minimalist'],
            'modern-minimalist' => ['minimal', 'modern-minimalist'],
            'minimalist' => ['minimal', 'modern-minimalist'],
            'modern' => ['modern', 'elegant-store'],
            'elegant-store' => ['modern', 'elegant-store'],
            'trendy' => ['trendy', 'vibrant-commerce'],
            'vibrant-commerce' => ['trendy', 'vibrant-commerce'],
        ];

        $candidates = $aliasMap[$slug] ?? [$slug];
        $theme = null;
        foreach ($candidates as $cSlug) {
            $theme = $this->themeModel->findWhere('slug', $cSlug);
            if ($theme) {
                break;
            }
        }

        if (!$theme) {
            $theme = $this->themeModel->findWhere('category', $slug);
        }

        if (!$theme) {
            return null;
        }

        $features = [];
        if (!empty($theme['features'])) {
            $decoded = json_decode($theme['features'], true);
            $features = is_array($decoded) ? $decoded : explode(',', $theme['features']);
        }

        $theme['parsed_features'] = $features;
        $theme['demo_content'] = ThemeConfiguration::getThemeDemoContent($theme['slug']);
        $theme['formatted_price'] = (float)$theme['price'] <= 0 
            ? 'Included in Plan' 
            : '₹' . number_format((float)$theme['price'], 0);

        return $theme;
    }

    /**
     * Get list of unique categories (Minimal, Modern, Trendy)
     */
    public function getCategories(): array
    {
        return [
            'all' => 'All Themes',
            'minimal' => 'Minimal',
            'modern' => 'Modern',
            'trendy' => 'Trendy',
        ];
    }
}