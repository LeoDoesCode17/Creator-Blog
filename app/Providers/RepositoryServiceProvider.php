<?php

namespace App\Providers;

use App\Repositories\Contracts\FriendshipRepositoryInterface;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Eloquent\FriendshipRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //friendship repository
        $this->app->bind(
            FriendshipRepositoryInterface::class,
            FriendshipRepository::class
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

        //add more for others repositories like friendship repository
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
