<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(BookRepositoryInterface::class, BookRepository::class);
    }
}
