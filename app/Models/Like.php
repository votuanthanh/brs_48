<?php

namespace App\Models;

class Like extends BaseModel
{
    protected $fillable = [
        'user_id',
        'target_id',
        'target_type',
    ];

    /**
     * Get all of the owning target models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function target()
    {
        return $this->morphTo();
    }

    /**
     * A like belongs to a user's reviews or comments
     *
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
