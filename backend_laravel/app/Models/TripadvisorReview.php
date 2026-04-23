<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripadvisorReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_name',
        'location',
        'review_title',
        'trip_date',
        'rating',
        'review_text',
        'reviewer_image',
        'review_link',
        'display_order',
        'show_on_homepage',
    ];

    /**
     * Convert stored relative reviewer image path to a full URL.
     */
    public function getReviewerImageAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return url($value);
        }
        return $value;
    }
}
