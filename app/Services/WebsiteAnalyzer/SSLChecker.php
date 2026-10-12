<?php

declare(strict_types=1);

namespace App\Services\WebsiteAnalyzer;

class SSLChecker
{
    public function check(string $url): array
    {
        $parsed = parse_url($url);
        $scheme = $parsed['scheme'] ?? 'http';
        $host = $parsed['host'] ?? '';

        $hasSSL = ($scheme === 'https');
        $validCert = false;
        $issuer = '';

        if ($hasSSL && $host) {
            $context = stream_context_create(["ssl" => ["capture_peer_cert" => true]]);
            $client = @stream_socket_client("ssl://{$host}:443", $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context);
            if ($client) {
                $params = stream_context_get_params($client);
                $cert = openssl_x509_parse($params["options"]["ssl"]["peer_certificate"]);
                $validCert = !empty($cert);
                $issuer = $cert['issuer']['O'] ?? ($cert['issuer']['CN'] ?? 'Unknown');
                fclose($client);
            }
        }

        return [
            'has_ssl' => $hasSSL,
            'valid_certificate' => $validCert,
            'issuer' => $issuer,
            'score' => ($hasSSL && $validCert) ? 100 : 0,
        ];
    }
}