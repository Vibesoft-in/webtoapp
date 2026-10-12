<?php

declare(strict_types=1);

namespace App\Services\AddonEngine;

class WhatsApp
{
    public function configureChatWidget(string $phone, string $prefilledMessage): array
    {
        return [
            'phone' => $phone,
            'message' => $prefilledMessage,
            'enabled' => true,
        ];
    }
}