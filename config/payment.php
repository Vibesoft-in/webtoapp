<?php

return [
    'gateway' => 'razorpay',
    'razorpay' => [
        'key_id' => getenv('RAZORPAY_KEY_ID') ?: '',
        'key_secret' => getenv('RAZORPAY_KEY_SECRET') ?: '',
        'currency' => getenv('RAZORPAY_CURRENCY') ?: 'INR',
        'webhook_secret' => getenv('RAZORPAY_WEBHOOK_SECRET') ?: '',
    ],
];