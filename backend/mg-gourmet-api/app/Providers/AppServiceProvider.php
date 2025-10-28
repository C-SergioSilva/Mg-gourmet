<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repositories
        $this->app->bind(
            \App\Domain\Product\ProductRepositoryInterface::class,
            \App\Infrastructure\Repositories\ProductRepository::class
        );

        //bind Services
        $this->app->bind(
            \App\Domain\Product\ProductServiceInterface::class,
            \App\Application\Services\ProductService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enable storage link for public files
        if (app()->environment('local') && !file_exists(public_path('storage'))) {
            app('files')->link(
                storage_path('app/public'), public_path('storage')
            );
        }
    }
}
