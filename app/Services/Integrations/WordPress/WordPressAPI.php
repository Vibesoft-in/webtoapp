<?php

declare(strict_types=1);

namespace App\Services\Integrations\WordPress;

class WordPressAPI
{
    protected string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function request(string $endpoint, array $params = []): ?array
    {
        $url = $this->baseUrl . '/wp-json/wp/v2/' . ltrim($endpoint, '/');
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $res = @file_get_contents($url);
        return $res ? json_decode($res, true) : null;
    }
}