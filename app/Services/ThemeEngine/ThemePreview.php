<?php

declare(strict_types=1);

namespace App\Services\ThemeEngine;

class ThemePreview
{
    /**
     * Generate preview meta and simulation payload
     */
    public function generatePreview(string $themeSlug, array $brandConfig = []): array
    {
        $demoData = ThemeConfiguration::getThemeDemoContent($themeSlug);

        return [
            'theme' => $themeSlug,
            'brand_name' => $brandConfig['brand_name'] ?? $demoData['brand_name'],
            'primary_color' => $brandConfig['primary_color'] ?? $demoData['colors']['primary'],
            'accent_color' => $brandConfig['accent_color'] ?? $demoData['colors']['accent'],
            'font' => $brandConfig['font'] ?? 'Plus Jakarta Sans',
            'demo_url' => url("themes/{$themeSlug}/demo"),
            'demo_data' => $demoData,
        ];
    }
}