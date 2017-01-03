<?php

namespace App\Models;

class Review extends BaseModel
{
    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'content',
        'star',
    ];

    /**
     * Get all like's user from review of books
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'target');
    }

    /**
     * Get a book that user reviewed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get a user that one has reviewed books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *  Get all comment belongs to Reivew
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
