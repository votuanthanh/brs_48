<?php

namespace App\Models;

class ReadingBook extends BaseModel
{
    protected $table = 'reading_books';

    protected $fillable = [
        'user_id',
        'book_id',
        'is_completed',
    ];
}
