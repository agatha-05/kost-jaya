<?php

namespace App\Repositories;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{
    /**
     * Ambil semua boarding house dengan filter search, city, category
     */
    public function getAllBoardingHouses($search = null, $citySlug = null, $categorySlug = null)
    {
        return BoardingHouse::query()
            ->when($search, function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })

            ->when($citySlug, function (Builder $query) use ($citySlug) {
                $query->whereHas('city', function (Builder $q) use ($citySlug) {
                    $q->where('slug', $citySlug);
                });
            })

            ->when($categorySlug, function (Builder $query) use ($categorySlug) {
                $query->whereHas('category', function (Builder $q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })

            ->with(['city', 'category']) // 🔥 biar index blade aman
            ->get();
    }

    /**
     * Boarding house terpopuler
     */
    public function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::with(['city', 'category'])
            ->withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->take($limit)
            ->get();
    }

    public function getBoardingHouseByCitySlug($slug)
    {
        return BoardingHouse::whereHas('city', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->with(['city', 'category'])
            ->get();
    }

    public function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('category', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->with(['city', 'category'])
            ->get();
    }

    public function getBoardingHouseBySlug($slug)
    {
        return BoardingHouse::with(['city', 'category'])
            ->where('slug', $slug)
            ->first();
    }
}
