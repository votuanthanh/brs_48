<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $fillable = ['name', 'description'];

    /**
     * A category have many books
     *
     * \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
