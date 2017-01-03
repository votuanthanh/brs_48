<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings all for web application
    |--------------------------------------------------------------------------
    |
    */

    'book' => [
        'image_deault' => 'book_default.png',
        'number_rating' => 5,
        'is_read' => 1,
        'limit' => 6,
        'favorite' => 1,
        'image_path' => public_path() . '/images/book/',
    ],
    'user' => [
        'role' => [
            'admin' => 1,
            'member' => 0,
        ],
        'avatar_path' => public_path() . '/images/avatar/',
        'avatar_default' => 'avatar_default.jpg',
    ],
    'pagination' => [
        'limit' => 10,
    ],
    'request_book' => [
        'not_accept' => 0,
        'accepted' => 1,
    ],
    'status' => [
        'success' => 1,
        'fail' => 0,
    ],
];
