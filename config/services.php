<?php

return [
    'build_engine' => [
        'url' => getenv('BUILD_SERVER_URL') ?: 'http://localhost:8080/build',
        'timeout' => (int) (getenv('BUILD_TIMEOUT') ?: 900),
    ],
    'platforms' => [
        'wordpress' => [
            'timeout' => 15,
            'api_endpoint' => '/wp-json/wp/v2',
        ],
        'woocommerce' => [
            'timeout' => 15,
            'api_endpoint' => '/wp-json/wc/v3',
        ],
        'shopify' => [
            'timeout' => 15,
            'api_version' => '2024-01',
        ],
    ],
];