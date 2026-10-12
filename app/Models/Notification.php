<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Notification extends Model
{
    protected string $table = 'notifications';
    protected array $fillable = [
        'user_id',
        'app_id',
        'title',
        'message',
        'type',
        'status',
        'scheduled_at',
        'sent_at',
        'created_at'
    ];

    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId);
    }
}