<?php

namespace App\Interfaces;

interface BoardingHouseRepositoryInterface
{
    /**
     * Ambil semua boarding house dengan filter opsional
     */
    public function getAllBoardingHouses($search = null, $cityId = null, $category = null);

    /**
     * Ambil boarding house terpopuler (global)
     */
    public function getPopularBoardingHouses($limit = 5);

    /**
     * Ambil boarding house berdasarkan city slug
     */
    public function getBoardingHouseByCitySlug($slug);

    /**
     * Ambil boarding house berdasarkan category slug
     */
    public function getBoardingHouseByCategorySlug($slug);

    /**
     * Ambil detail boarding house berdasarkan slug
     */
    public function getBoardingHouseBySlug($slug);
}
