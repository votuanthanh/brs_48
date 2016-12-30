<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
            : asset('uploads/avatar/' . $this->avatar);
    }
}
