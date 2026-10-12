<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class SupportTicket extends Model
{
    protected string $table = 'support_tickets';
    protected array $fillable = [
        'ticket_number',
        'user_id',
        'app_id',
        'subject',
        'message',
        'priority',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId);
    }
}