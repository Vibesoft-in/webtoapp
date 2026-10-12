<?php

declare(strict_types=1);

namespace App\Services\AppBuilder;

class BuildQueue
{
    public function push(array $job): bool
    {
        return true;
    }
}