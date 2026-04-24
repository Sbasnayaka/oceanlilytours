<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSlide extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'badge_text',
        'description',
        'image_url',
        'button_text',
        'button_url',
        'cta_primary_text',
        'cta_secondary_text',
        'display_order',
        'active',
    ];

    /**
     * Convert stored relative image path to a full URL for API responses.
     */
    public function getImageUrlAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL) && !str_starts_with($value, 'assets/')) {
            return url($value);
        }
        return $value;
    }
}
