<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Build extends Model
{
    protected string $table = 'builds';
    protected array $fillable = [
        'app_id',
        'build_number',
        'platform',
        'version',
        'status',
        'apk_url',
        'aab_url',
        'ipa_url',
        'build_log',
        'started_at',
        'completed_at',
        'created_at'
    ];

    public function getByAppId(int $appId): array
    {
        return $this->where('app_id', $appId);
    }
}