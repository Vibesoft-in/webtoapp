<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class App extends Model
{
    protected string $table = 'apps';
    protected array $fillable = [
        'user_id',
        'website_id',
        'theme_id',
        'order_id',
        'app_name',
        'package_name',
        'version',
        'app_icon',
        'splash_screen',
        'primary_color',
        'secondary_color',
        'platforms',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId);
    }
}