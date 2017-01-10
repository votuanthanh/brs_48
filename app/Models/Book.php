<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Carbon\Carbon;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends BaseModel
{
    use Sluggable;
    use SluggableScopeHelpers;
    use SearchableTrait;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'publish_date',
        'image',
        'number_of_pages',
        'avg_rate',
        'author_id',
        'slug',
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'books.title' => 10,
            'books.description' => 8,
            'books.number_of_pages' => 2,
            'books.publish_date' => 4,
        ],
    ];

    protected $dates = ['publish_date'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

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

    /**
     * Get author belongs to a book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get Percent rating book
     *
     * @return int
     */
    public function computePercentRating()
    {
        //number avg x 0.05(%)
        return (int) ($this->avg_rate * 100 / config('settings.book.number_rating'));
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected static function boot()
    {
        parent::boot();

        //before delete() method call this
        static::deleting(function ($book) {
            $book->with('reviews.comments');
            //delete favorite book of user
            $book->favoriteUsers()->sync([]);

            //delete read or reading book of user
            $book->readingUsers()->detach();

            foreach ($book->reviews as $review) {
                foreach ($review->comments as $comment) {
                    $comment->likes()->delete();
                }
                //delete comments belongs to reviews's book
                $review->comments()->delete();

                //delete likes belongs to reviews's book
                $review->likes()->delete();
            }
            //delete review's book
            $book->reviews()->delete();

            //Delete Images's book
            deleteImage(config('settings.book.image_path'), $book->image);
        });
    }

    /**
     * get all id related user
     *
     * @return Collection
     */
    public function getUserFavoriteIds()
    {
        return $this->favoriteUsers()->getRelatedIds();
    }

    /**
     * Get all id that read book
     * @return Collection
     */
    public function getUserReadBookIds()
    {
        return $this->readingUsers()->getRelatedIds();
    }

    public function reviewsCount()
    {
        return $this->hasOne(Review::class)
            ->selectRaw('book_id, count(*) as aggregate')
            ->groupBy('book_id');
    }

    public function getReviewsCountAttribute()
    {
        //if relation is not loaded already, let's do it first
        if (! array_key_exists('reviewsCount', $this->relations)) {
            $this->load('reviewsCount');
        }

        $related = $this->getRelation('reviewsCount');

        // then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }

    public function userFavoriteCount()
    {
        $hasOne = new HasOne(
            (new User())->newQuery(),
            $this->newPivot(new FavoriteBook(), [], FavoriteBook::getTableName(), false),
            'book_id', 'id'
        );
        $hasOne->getQuery()->from(FavoriteBook::getTableName());

        return $hasOne->selectRaw('book_id, count(*) as aggregate')->groupBy('book_id');
    }

    public function getUserFavoriteCountAttribute()
    {
        //if relation is not loaded already, let's do it first
        if (!array_key_exists('userFavoriteCount', $this->relations)) {
            $this->load('userFavoriteCount');
        }

        $related = $this->getRelation('userFavoriteCount');

        //then return the count directly
        return ($related) ? (int)$related->aggregate : 0;
    }

    public function imagePhoto()
    {
        return config('settings.book.image_path') . $this->image;
    }
}
