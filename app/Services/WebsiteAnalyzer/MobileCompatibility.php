<?php

declare(strict_types=1);

namespace App\Services\WebsiteAnalyzer;

class MobileCompatibility
{
    public function check(string $url): array
    {
        $html = @file_get_contents($url, false, stream_context_create([
            'http' => ['timeout' => 10, 'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X)']
        ])) ?: '';

        $hasViewport = (bool)preg_match('/<meta[^>]+name=["\']viewport["\'][^>]*>/i', $html);
        $hasResponsiveFramework = (bool)preg_match('/(bootstrap|tailwind|foundation|bulma)/i', $html);

        $score = 50;
        if ($hasViewport) $score += 35;
        if ($hasResponsiveFramework) $score += 15;

        return [
            'has_viewport' => $hasViewport,
            'responsive_framework_detected' => $hasResponsiveFramework,
            'score' => min(100, $score),
        ];
    }
}