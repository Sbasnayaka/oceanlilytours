<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'sub_heading', 'price', 'category_id', 'tour_type', 
        'location_count', 'duration_days', 'max_persons', 'image_url', 'map_embed_code', 
        'description', 'itinerary', 'journey_highlights', 'insightful_tips', 
        'faq_content', 'seo_title', 'seo_description', 'seo_keywords', 
        'featured', 'active'
    ];

    // Legacy support for single category frontend setup
    public function category()
    {
        return $this->belongsTo(CategoryTour::class, 'category_id');
    }

    // New Multi-category support
    public function categories()
    {
        return $this->belongsToMany(CategoryTour::class, 'category_tour_package', 'package_id', 'category_tour_id');
    }

    // Dynamic Itinerary Day Blocks
    public function itineraries()
    {
        return $this->hasMany(PackageItinerary::class, 'package_id')->orderBy('day_number', 'asc');
    }
}
