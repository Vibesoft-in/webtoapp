<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Theme extends Model
{
    protected string $table = 'themes';
    protected array $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'features',
        'preview_image',
        'demo_url',
        'color_scheme',
        'badge',
        'is_featured',
        'is_premium',
        'price',
        'sort_order',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getActiveThemes(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'active' AND category IN ('minimal', 'modern', 'trendy') ORDER BY sort_order ASC, id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}