<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Website extends Model
{
    protected string $table = 'websites';
    protected array $fillable = [
        'user_id',
        'url',
        'domain',
        'platform',
        'ssl_enabled',
        'status',
        'last_checked_at',
        'created_at',
        'updated_at'
    ];

    public function getByUserId(int $userId): array
    {
        return $this->where('user_id', $userId);
    }
}