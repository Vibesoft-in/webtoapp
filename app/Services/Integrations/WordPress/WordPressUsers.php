<?php

declare(strict_types=1);

namespace App\Services\Integrations\WordPress;

class WordPressUsers
{
    private WordPressAPI $api;

    public function __construct(WordPressAPI $api)
    {
        $this->api = $api;
    }

    public function authenticate(string $username, string $password): bool
    {
        return false;
    }
}