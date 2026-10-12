<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Order extends Model
{
    protected string $table = 'orders';
    protected array $fillable = [
        'order_number',
        'user_id',
        'plan_id',
        'theme_id',
        'selected_addons',
        'subtotal',
        'tax',
        'total_amount',
        'currency',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId);
    }
}