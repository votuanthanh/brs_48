<?php

namespace App\Models;

class Book extends BaseModel
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'author',
        'publish_date',
        'image',
        'number_of_pages',
        'avg_rate',
    ];

    /**
     * Define a book to many user favorited books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, FavoriteBook::getTableName())
            ->withTimestamps();
    }

    /**
     * Define a book to many user read books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function readingUsers()
    {
        return $this->belongsToMany(User::class, ReadingBook::getTableName())
            ->withPivot('is_completed')
            ->withTimestamps();
    }

    /**
     * Define a book to many user reviewed with books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviewUsers()
    {
        return $this->belongsToMany(User::class, Review::getTableName())
            ->withTimestamps();
    }

    /**
     * Define a book belongs to a category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
