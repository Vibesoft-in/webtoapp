<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class ImprovementRequest extends Model
{
    protected string $table = 'improvement_requests';
    protected array $fillable = [
        'website_id',
        'user_id',
        'issue_type',
        'description',
        'notes',
        'status',
        'admin_response',
        'created_at',
        'updated_at'
    ];

    public function getPendingRequests(): array
    {
        return $this->where('status', 'pending');
    }
}