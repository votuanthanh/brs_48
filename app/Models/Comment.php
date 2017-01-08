<?php

namespace App\Models;

class Comment extends BaseModel
{
    protected $fillable = [
        'content',
        'user_id',
        'review_id',
    ];

    /**
     * A comment belongs to review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    /**
     * A comment have many likes
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'target');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
