<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class WebsiteCredential extends Model
{
    protected string $table = 'website_api_credentials';
    protected array $fillable = [
        'website_id',
        'platform',
        'credentials_encrypted',
        'is_verified',
        'verified_at',
        'last_error',
    ];

    private string $cipher = 'AES-256-CBC';

    private function getSecretKey(): string
    {
        $key = getenv('APP_KEY') ?: 'appifyhub_secure_vault_key_2026_prod_salt';
        return hash('sha256', $key, true);
    }

    /**
     * Encrypt credential payload.
     */
    public function encryptData(array $data): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encrypted = openssl_encrypt(json_encode($data), $this->cipher, $this->getSecretKey(), 0, $iv);
        return base64_encode($iv . '::' . $encrypted);
    }

    /**
     * Decrypt credential payload.
     */
    public function decryptData(string $payload): ?array
    {
        try {
            $raw = base64_decode($payload, true);
            if (!$raw || !str_contains($raw, '::')) {
                return null;
            }
            [$iv, $encrypted] = explode('::', $raw, 2);
            $decrypted = openssl_decrypt($encrypted, $this->cipher, $this->getSecretKey(), 0, $iv);
            return $decrypted ? json_decode($decrypted, true) : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Store or update verified connection for a website.
     */
    public function saveCredentials(int $websiteId, string $platform, array $credentials, bool $isVerified = false, ?string $error = null): int|string
    {
        $encrypted = $this->encryptData($credentials);

        $existing = $this->findWhere('website_id', $websiteId);
        $data = [
            'website_id' => $websiteId,
            'platform' => $platform,
            'credentials_encrypted' => $encrypted,
            'is_verified' => $isVerified ? 1 : 0,
            'verified_at' => $isVerified ? date('Y-m-d H:i:s') : null,
            'last_error' => $error,
        ];

        if ($existing) {
            $this->update((int)$existing['id'], $data);
            return $existing['id'];
        }

        return $this->create($data);
    }

    /**
     * Get verified credentials for website.
     */
    public function getCredentials(int $websiteId): ?array
    {
        $row = $this->findWhere('website_id', $websiteId);
        if (!$row || empty($row['credentials_encrypted'])) {
            return null;
        }

        $decrypted = $this->decryptData($row['credentials_encrypted']);
        if (!$decrypted) {
            return null;
        }

        return [
            'platform' => $row['platform'],
            'is_verified' => (bool)$row['is_verified'],
            'verified_at' => $row['verified_at'],
            'credentials' => $decrypted,
        ];
    }
}
