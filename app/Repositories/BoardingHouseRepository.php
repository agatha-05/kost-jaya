<?php

namespace App\Repositories;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{
    /**
     * Ambil semua boarding house dengan filter opsional
     */
    public function getAllBoardingHouses($search = null, $cityId = null, $category = null)
    {
        $query = BoardingHouse::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($cityId) {
            $query->whereHas('city', function (Builder $query) use ($cityId) {
                $query->where('slug', $cityId);
            });
        }

        if ($category) {
            $query->whereHas('categories', function (Builder $query) use ($category) {
                $query->where('slug', $category);
            });
        }

        return $query->get();
    }

    /**
     * Ambil boarding house terpopuler
     */
    public function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Ambil boarding house berdasarkan city slug
     * (WAJIB karena ada di Interface)
     */
    public function getBoardingHouseByCitySlug($slug)
    {
        return BoardingHouse::whereHas('city', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    /**
     * Ambil boarding house berdasarkan category slug
     */
    public function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('categories', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    /**
     * Ambil detail boarding house berdasarkan slug
     */
    public function getBoardingHouseBySlug($slug)
    {
        return BoardingHouse::where('slug', $slug)->first();
    }

    /**
     * Ambil boarding house terpopuler berdasarkan city
     * (opsional, TIDAK wajib di interface)
     */
    public function getPopularBoardingHouseByCitySlug($slug, $limit = 5)
    {
        return BoardingHouse::whereHas('city', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->take($limit)
            ->get();
    }
}
