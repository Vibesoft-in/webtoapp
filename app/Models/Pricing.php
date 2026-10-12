<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Pricing extends Model
{
    protected string $table = 'pricing_plans';
    protected array $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'billing_cycle',
        'features',
        'max_apps',
        'is_featured',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getActivePlans(): array
    {
        return $this->where('status', 'active');
    }
}