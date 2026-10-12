<?php

declare(strict_types=1);

namespace App\Services\AppBuilder;

class AppConfiguration
{
    public function generateManifest(array $appData): array
    {
        return [
            'name' => $appData['app_name'],
            'package' => $appData['package_name'],
            'version' => $appData['version'] ?? '1.0.0',
            'theme' => $appData['theme'] ?? 'default',
            'features' => $appData['features'] ?? [],
        ];
    }
}