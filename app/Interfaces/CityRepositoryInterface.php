<?php

namespace App\Interfaces;
use App\Models\City;
interface CityRepositoryInterface
{
    public function getAllCities();
    public function getCityBySlug($slug);

}
