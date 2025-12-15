<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'slug',
        
    ];


    /**
     * RELATIONSHIP: 1 Category = banyak BoardingHouse
     */
    public function boardingHouses()
    {
        return $this->hasMany(BoardingHouse::class);
    }

    /**
     * BOOT MODEL:
     * - Generate slug otomatis jika kosong
     * - Meta title default
     * - Meta description default
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {

            // Slug otomatis
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }

        });

        static::updating(function ($category) {

            // Auto update slug jika nama berubah
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * ACCESSOR: Total relasi kost (untuk badge di panel)
     */
    protected $appends = ['boarding_houses_count'];

    public function getBoardingHousesCountAttribute()
    {
        return $this->boardingHouses()->count();
    }
}
