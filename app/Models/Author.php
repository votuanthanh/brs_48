<?php

namespace App\Models;

class Author extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all book from author's books
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
