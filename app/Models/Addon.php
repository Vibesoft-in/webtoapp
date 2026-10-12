<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Addon extends Model
{
    protected string $table = 'addons';
    protected array $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'icon',
        'price',
        'billing_type',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getAvailableAddons(): array
    {
        return $this->where('status', 'active');
    }
}