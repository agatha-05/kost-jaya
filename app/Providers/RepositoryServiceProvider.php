<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CityRepositoryInterface::class, \App\Repository\CityRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, \App\Repository\CategoryRepository::class);
        $this->app->bind(BoardingHouseRepositoryInterface::class, \App\Repository\BoardingHouseRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
