<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'boarding_house_id',
        'photo',
        'name',
        'content',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship ke Boarding House
     */
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    /**
     * Accessor otomatis mengubah path foto ke URL full
     */
    public function getPhotoUrlAttribute()
    {
        return $this->photo 
            ? asset('storage/' . $this->photo) 
            : asset('default-user.png'); // default avatar opsional
    }

    /**
     * Helper mempersingkat content untuk preview
     */
    public function shortContent(int $limit = 40): string
    {
        return strlen($this->content) > $limit
            ? substr($this->content, 0, $limit) . '...'
            : $this->content;
    }

    /**
     * Mutator rating supaya otomatis dijaga 1–5
     */
    public function setRatingAttribute($value)
    {
        $value = (int) $value;

        if ($value < 1) $value = 1;
        if ($value > 5) $value = 5;

        $this->attributes['rating'] = $value;
    }
}
