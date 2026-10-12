<?php

declare(strict_types=1);

namespace App\Services\Platform;

class WordPressConnector
{
    public function verify(string $url, string $username, string $applicationPassword): array
    {
        $cleanUrl = rtrim(trim($url), '/');
        if (!preg_match('#^https?://#i', $cleanUrl)) {
            $cleanUrl = 'https://' . $cleanUrl;
        }

        $endpoint = $cleanUrl . '/wp-json/wp/v2/users/me';
        // Clean application password from spaces sometimes pasted by users
        $cleanPassword = str_replace(' ', '', trim($applicationPassword));

        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => trim($username) . ':' . $cleanPassword,
            CURLOPT_TIMEOUT => 12,
            CURLOPT_CONNECTTIMEOUT => 8,
            CURLOPT_SSL_VERIFYPEER => false, // Allow self-signed or local dev if needed
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_USERAGENT => 'AppifyHub-Compatibility-Analyzer/2.0',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
            ],
        ]);

        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return [
                'success' => false,
                'message' => "Unable to connect: {$curlError}. Please verify your website URL and ensure your server is online.",
                'error_code' => 'NETWORK_ERROR',
            ];
        }

        if ($httpCode === 200 && $responseBody) {
            $data = json_decode($responseBody, true) ?: [];
            $displayName = $data['name'] ?? $username;
            $userId = $data['id'] ?? 1;

            return [
                'success' => true,
                'message' => "WordPress connected successfully. Authenticated as '{$displayName}'.",
                'details' => [
                    'platform' => 'WordPress',
                    'user_id' => $userId,
                    'user_name' => $displayName,
                    'rest_endpoint' => $endpoint,
                    'ssl_active' => str_starts_with($cleanUrl, 'https://'),
                    'permissions' => 'administrator',
                ],
            ];
        }

        if ($httpCode === 401 || $httpCode === 403) {
            return [
                'success' => false,
                'message' => "Authentication failed (HTTP {$httpCode}). The username or Application Password is incorrect. Please ensure the user has administrator privileges.",
                'error_code' => 'AUTH_FAILED',
            ];
        }

        if ($httpCode === 404) {
            return [
                'success' => false,
                'message' => "WordPress REST API endpoint not found (/wp-json). Ensure pretty permalinks are enabled under WordPress Settings → Permalinks.",
                'error_code' => 'ENDPOINT_NOT_FOUND',
            ];
        }

        return [
            'success' => false,
            'message' => "Server responded with status code HTTP {$httpCode}. Please check your website URL and server firewall settings.",
            'error_code' => 'SERVER_ERROR',
        ];
    }
}
