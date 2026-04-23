<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'rating',
        'review_text',
        'package_id',
        'profile_image',
        'featured',
        'verified',
    ];

    /**
     * Convert stored relative image path to a full URL for API responses.
     */
    public function getProfileImageAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return url($value);
        }
        return $value;
    }
}
