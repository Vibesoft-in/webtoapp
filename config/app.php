<?php

return [
    'name' => getenv('APP_NAME') ?: 'Website to App Converter',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => filter_var(getenv('APP_DEBUG') ?: false, FILTER_VALIDATE_BOOLEAN),
    'url' => getenv('APP_URL') ?: 'http://localhost/webintoapp/public',
    'timezone' => 'UTC',
    'key' => getenv('APP_KEY') ?: 'random-secret-key',
    'session_lifetime' => (int) (getenv('SESSION_LIFETIME') ?: 120),
];