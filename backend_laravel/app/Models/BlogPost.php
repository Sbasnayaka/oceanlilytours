<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category_id', 'content', 'excerpt', 
        'featured_image', 'featured', 'published', 'published_at'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryBlog::class, 'category_id');
    }

    public function getFeaturedImageAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return url($value);
        }
        return $value;
    }
}
