<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'slug',
    ];

    /**
     * RELASI:
     * 1 Kota = banyak boarding house
     */
    public function boardingHouses()
    {
        return $this->hasMany(BoardingHouse::class);
    }

    /**
     * BOOT MODEL:
     * - Slug otomatis saat create
     * - SEO default
     * - Auto update slug saat name berubah
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($city) {
            // Generate slug jika kosong
            if (empty($city->slug)) {
                $city->slug = Str::slug($city->name);
            }
        });

        static::updating(function ($city) {
            // Jika name berubah, slug ikut update
            if ($city->isDirty('name')) {
                $city->slug = Str::slug($city->name);
            }
        });
    }

    /**
     * ACCESSOR: Hitung jumlah BoardingHouse
     */
    protected $appends = ['boarding_houses_count'];

    public function getBoardingHousesCountAttribute()
    {
        return $this->boardingHouses()->count();
    }
}
