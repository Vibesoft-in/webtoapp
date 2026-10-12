<?php

declare(strict_types=1);

namespace App\Services\AddonEngine;

class Ads
{
    public function getAdMobConfig(string $platform): array
    {
        return [
            'banner_id' => '',
            'interstitial_id' => '',
            'rewarded_id' => '',
        ];
    }
}