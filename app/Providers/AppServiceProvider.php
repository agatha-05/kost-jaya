<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

// --- Impor semua Interfaces ---
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;

// --- Impor semua Repositories (HARUS menggunakan App\Repositories) ---
use App\Repositories\CityRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\BoardingHouseRepository;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // --- DAFTARKAN SEMUA BINDING ---
        $this->app->bind(
            CityRepositoryInterface::class,
            CityRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            BoardingHouseRepositoryInterface::class,
            BoardingHouseRepository::class
        );
    }

    public function boot(): void
    {
        if (str_contains(request()->url(), 'ngrok-free.dev')){
            URL::forceScheme('https'); 
        }
    }
}