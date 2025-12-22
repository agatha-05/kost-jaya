<?php

namespace App\Interfaces;
use App\Models\category;

interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function getCategoryBySlug($slug);

}
