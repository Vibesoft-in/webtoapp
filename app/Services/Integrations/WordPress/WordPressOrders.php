<?php

declare(strict_types=1);

namespace App\Services\Integrations\WordPress;

class WordPressOrders
{
    private WordPressAPI $api;

    public function __construct(WordPressAPI $api)
    {
        $this->api = $api;
    }

    public function listOrders(array $filter = []): array
    {
        return [];
    }
}