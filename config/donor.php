<?php

return [
    'cache' => [
        'storage' => env('DONOR_CACHE_STORAGE', 'redis'),
        'ttl' => env('DONOR_CACHE_STORAGE_TTL', 300),
    ],

    'eventToObject' => [
        'order_create' => 'order', //todo create order
        'order_delete' => 'order', //todo delete order
        'user_update' => 'user', //todo update user
    ],

    // идея в том что-бы рулить обьектами в методе получение филдов и данных через switch
    'object_id_mapping' => [
        'order_create' => 'data.order.id',
    ]
];
