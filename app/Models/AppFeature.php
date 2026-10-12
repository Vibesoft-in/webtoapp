<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class AppFeature extends Model
{
    protected string $table = 'app_features';
    protected array $fillable = [
        'app_id',
        'addon_id',
        'feature_key',
        'config',
        'is_enabled',
        'created_at',
        'updated_at'
    ];

    public function getByAppId(int $appId): array
    {
        return $this->where('app_id', $appId);
    }
}