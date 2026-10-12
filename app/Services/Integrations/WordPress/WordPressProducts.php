<?php

declare(strict_types=1);

namespace App\Services\Integrations\WordPress;

class WordPressProducts
{
    private WordPressAPI $api;

    public function __construct(WordPressAPI $api)
    {
        $this->api = $api;
    }

    public function getPosts(int $perPage = 10, int $page = 1): array
    {
        return $this->api->request('posts', ['per_page' => $perPage, 'page' => $page]) ?: [];
    }
}