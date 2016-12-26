<?php

namespace App\Models;

class FavoriteBook extends BaseModel
{
    protected $table = 'favorite_books';

    protected $fillable = ['user_id', 'book_id'];
}
