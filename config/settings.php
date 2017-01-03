<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings all for web application
    |--------------------------------------------------------------------------
    |
    */

    'book' => [
        'image_deault' => 'default_book.png',
        'number_rating' => 0.05,
        'is_read' => 1,
        'limit' => 6,
        'favorite' => 1,
    ],
    'user' => [
        'role' => [
            'admin' => 1,
            'member' => 0,
        ],
        'avatar_path' => public_path() . '/images/avatar/',
        'avatar_default' => 'avatar_default.jpg',
    ],
];
