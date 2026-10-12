<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class CompatibilityReport extends Model
{
    protected string $table = 'compatibility_reports';
    protected array $fillable = [
        'website_id',
        'overall_score',
        'platform_status',
        'ssl_status',
        'api_status',
        'mobile_score',
        'report_summary',
        'recommendations',
        'raw_metrics',
        'created_at'
    ];

    public function getLatestByWebsiteId(int $websiteId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE website_id = :id ORDER BY id DESC LIMIT 1");
        $stmt->execute(['id' => $websiteId]);
        $res = $stmt->fetch();
        return $res ?: null;
    }
}