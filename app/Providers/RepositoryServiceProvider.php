<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\Product\EloquentProductRepository;
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

        // Product
        $app->bind('App\Repositories\Product\ProductRepositoryInterface', function ($app) {
            return new EloquentProductRepository(
                new Product,
                new Review,
                $app->make('App\Repositories\Category\CategoryRepositoryInterface'),
                $app->make('App\Repositories\User\UserRepositoryInterface')

            );
        });

        // Category
        $app->bind('App\Repositories\Category\CategoryRepositoryInterface', function ($app) {
            return new EloquentCategoryRepository(
                new Category
            );
        });
    }
}
