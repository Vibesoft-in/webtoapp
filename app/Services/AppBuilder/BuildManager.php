<?php

declare(strict_types=1);

namespace App\Services\AppBuilder;
class BuildManager
{
    private BuildQueue $queue;

    public function __construct()
    {
        $this->queue = new BuildQueue();
    }

    public function queueBuild(int $appId, string $platform): array
    {
        $job = [
            'job_id' => uniqid('job_'),
            'app_id' => $appId,
            'platform' => $platform,
            'status' => 'queued',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->queue->push($job);
        return $job;
    }

    public function getBuildStatus(string $buildId): string
    {
        return 'compiling';
    }
}