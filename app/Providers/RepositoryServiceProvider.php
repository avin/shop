<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // User
        $app->bind('App\Repositories\User\UserRepositoryInterface', function ($app) {
            return new EloquentUserRepository(
                new User
            );
        });
    }
}
