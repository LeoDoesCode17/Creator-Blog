<?php

namespace App\Providers;

use App\Repositories\Contracts\FriendshipRepositoryInterface;
use App\Repositories\Eloquent\FriendshipRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            FriendshipRepositoryInterface::class,
            FriendshipRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
