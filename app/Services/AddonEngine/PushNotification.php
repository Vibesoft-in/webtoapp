<?php

declare(strict_types=1);

namespace App\Services\AddonEngine;

class PushNotification
{
    public function send(string $appId, string $title, string $message): bool
    {
        return true;
    }

    public function sendBroadcast(int|string $appId, string $title, string $message): bool
    {
        return $this->send((string)$appId, $title, $message);
    }
}