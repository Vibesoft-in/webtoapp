<?php

declare(strict_types=1);

namespace App\Services\AppBuilder;

class AppBuilder
{
    public function initiateBuild(int $appId, string $platform): array
    {
        return [
            'build_id' => uniqid('build_'),
            'app_id' => $appId,
            'platform' => $platform,
            'status' => 'queued',
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}