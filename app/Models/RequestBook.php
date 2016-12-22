<?php

namespace App\Models;

class RequestBook extends BaseModel
{
    protected $table = 'request_books';

    protected $fillable = [
        'user_id',
        'requested_book_id',
        'book_name',
        'description',
        'is_accepted',
    ];

    /**
     * Get user requested books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
