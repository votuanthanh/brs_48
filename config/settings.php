<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings all for web application
    |--------------------------------------------------------------------------
    |
    */

    'book' => [
        'image_deault' => 'book_default.jpg',
        'number_rating' => 5,
        'is_read' => 1,
        'limit' => 6,
        'favorite' => 1,
        'image_path' => '/images/book/',
    ],
    'user' => [
        'role' => [
            'admin' => 1,
            'member' => 0,
        ],
        'avatar_path' => '/images/avatar/',
        'avatar_default' => 'avatar_default.jpg',
    ],
    'pagination' => [
        'limit' => 12,
    ],
    'request_book' => [
        'not_accept' => 0,
        'accepted' => 1,
    ],
    'status' => [
        'success' => 1,
        'fail' => 0,
    ],
    'tab' => [
        'favorite_book' => 'favorite-book',
        'read_book' => 'read-book',
        'reading_book' => 'reading-book',
        'followers' => 'followers',
        'following_users' => 'following-users',
        'request_book' => 'request-book',
        'review_book' => 'review-book',
    ],
];
