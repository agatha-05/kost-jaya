<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BoardingHouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'city_id',
        'category_id',
        'description',
        'price',
        'address',
    ];

    protected $casts = [
        'price' => 'integer',
        'city_id' => 'integer',
        'category_id' => 'integer',
    ];

    // OPTIONAL: Auto-generate slug if empty
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ===== RELATIONS =====

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
