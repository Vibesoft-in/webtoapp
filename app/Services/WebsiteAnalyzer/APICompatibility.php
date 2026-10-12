<?php

declare(strict_types=1);

namespace App\Services\WebsiteAnalyzer;

class APICompatibility
{
    public function test(string $url, string $platform): array
    {
        $supported = false;
        $endpointTested = '';
        $statusCode = 0;

        switch ($platform) {
            case 'wordpress':
            case 'woocommerce':
                $endpointTested = $url . '/wp-json/wp/v2/types';
                break;
            case 'shopify':
                $endpointTested = $url . '/products.json?limit=1';
                break;
            default:
                $endpointTested = $url;
                break;
        }

        $headers = @get_headers($endpointTested);
        if ($headers && !empty($headers[0])) {
            preg_match('/HTTP\/\d\.\d\s+(\d+)/', $headers[0], $match);
            $statusCode = isset($match[1]) ? (int)$match[1] : 0;
            $supported = ($statusCode === 200);
        }

        return [
            'supported' => $supported,
            'endpoint' => $endpointTested,
            'status_code' => $statusCode,
        ];
    }
}