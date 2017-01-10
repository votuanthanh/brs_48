<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use File;

class User extends Authenticatable
{
    use Notifiable;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'users.name' => 10,
            'users.email' => 10,
        ],
    ];

    /**
     * Define a many-to-many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, Follower::getTableName(), 'follower_id', 'following_id')
            ->withTimestamps();
    }

    /**
     * Define a many-to-many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, Follower::getTableName(), 'following_id', 'follower_id')
            ->withTimestamps();
    }

    /**
     * Define a one-to-many relationship with Model\RequestBook
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requestBooks()
    {
        return $this->hasMany(RequestBook::class);
    }

    /**
     * Define a user to many favorite books relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, FavoriteBook::getTableName())
            ->withTimestamps();
    }

    /**
     * Define a user to many reading books relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function readingBooks()
    {
        return $this->belongsToMany(Book::class, ReadingBook::getTableName())
            ->withPivot('is_completed')
            ->withTimestamps();
    }

    /**
     * Define a user can many reviews from books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviewBooks()
    {
        return $this->belongsToMany(Book::class, Review::getTableName())
            ->withTimestamps();
    }

    /**
     * Define a user to many reviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Define a user to many likes from review and review of comments that books
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Define a user to many likes from review and review of comments that books
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check user is admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role == config('settings.user.role.admin');
    }

    protected static function boot()
    {
        parent::boot();

        //before delete() method call this
        static::deleting(function ($user) {
            $user->load('reviews.comments');
            //delete request book of user
            $user->requestBooks()->delete();

            //delete read or reading book of user
            $user->readingBooks()->detach();

            //delete favorite book
            $user->favoriteBooks()->detach();

            //delete users following
            $user->following()->detach();

            //delete followers
            $user->followers()->detach();

            //delete comments
            $user->comments()->delete();

            //delete reivew
            $user->reviews()->delete();

            //delete likes
            $user->likes()->delete();

            //delete image
            deleteImage(config('settings.user.avatar_path'), $user->avatar);
        });

        static::creating(function ($user) {
            //set role user for register
            $user->role = config('settings.user.role.member');
        });
    }

    /**
     * Hash the password given
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Get Path Avatar
     *
     * @return string
     */
    public function avatarPath()
    {
        return preg_match('#^(http)|(https).*$#', $this->avatar)
            ? $this->avatar
            : asset(config('settings.user.avatar_path') . $this->avatar);
    }
}
