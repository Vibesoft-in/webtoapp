<?php

declare(strict_types=1);

namespace App\Services\Payment;

class RazorpayService
{
    private string $keyId;
    private string $keySecret;

    public function __construct()
    {
        $config = require CONFIG_PATH . '/payment.php';
        $this->keyId = $config['razorpay']['key_id'] ?? '';
        $this->keySecret = $config['razorpay']['key_secret'] ?? '';
    }

    public function createOrder(float $amount, string $receiptId, string $currency = 'INR'): ?array
    {
        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->keyId}:{$this->keySecret}");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'amount' => (int)($amount * 100), // convert to paise
            'currency' => $currency,
            'receipt' => $receiptId,
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        
        $res = curl_exec($ch);
        curl_close($ch);
        return $res ? json_decode($res, true) : null;
    }
}