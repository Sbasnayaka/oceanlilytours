<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'category_id',
        'image_url',
        'description',
        'itinerary',
        'duration_days',
        'max_persons',
        'featured',
        'active'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryTour::class, 'category_id');
    }
}
