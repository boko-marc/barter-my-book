<?php

namespace App\Providers;

use Core\Books\Repository\BooksPicturesRepository;
use Core\Books\Repository\BooksPicturesRepositoryInterface;
use Core\Books\Repository\BooksRepository;
use Core\Books\Repository\BooksRepositoryInterface;
use Core\Repository\Eloquent\BaseRepository;
use Core\Repository\Eloquent\EloquentRepositoryInterface;
use Core\Schools\Repository\SchoolRepository;
use Core\Schools\Repository\SchoolRepositoryInterface;
use Core\Users\Repository\UsersRepository;
use Core\Users\Repository\UsersRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(BooksRepositoryInterface::class, BooksRepository::class);
        $this->app->bind(BooksPicturesRepositoryInterface::class, BooksPicturesRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
