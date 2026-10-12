<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Payment extends Model
{
    protected string $table = 'payments';
    protected array $fillable = [
        'order_id',
        'user_id',
        'gateway',
        'gateway_order_id',
        'gateway_payment_id',
        'gateway_signature',
        'amount',
        'currency',
        'status',
        'payload',
        'created_at',
        'updated_at'
    ];

    public function findByGatewayOrderId(string $gatewayOrderId): ?array
    {
        return $this->findWhere('gateway_order_id', $gatewayOrderId);
    }
}