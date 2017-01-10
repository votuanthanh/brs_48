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

     /**
     * Get Percent rating book
     *
     * @return int
     */
    public function computePercentRating()
    {
        return (int) ($this->star * 100 / config('settings.book.number_rating'));
    }

    public function likesCount()
    {
        return $this->morphOne(Like::class, 'likes', 'target_type', 'target_id');
    }

    public function getlikeCountAttribute()
    {
        //if relation is not loaded already, let's do it first
        if (! array_key_exists('likesCount', $this->relations)) {
            $this->load('likesCount');
        }

        $related = $this->getRelation('likesCount');

        //then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($review) {
            $review->user_id = auth()->user()->id;
        });
    }
}
