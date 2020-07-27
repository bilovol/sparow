<?php

return [
    'api' => [
        'url' => env('SENDPULSE_API_URL', 'https://api.sendpulse.com'),
        'token' => [
            'storage' => env('SENDPULSE_API_TOKEN_STORAGE', 'redis'),
            'ttl' => env('SENDPULSE_API_TOKEN_TTL', 3600),
        ]
    ],

    'cache' => [
        'storage' => env('SENDPULSE_CACHE_STORAGE', 'redis'),
        'ttl' => env('SENDPULSE_CACHE_STORAGE_TTL', 300),
    ]
];
