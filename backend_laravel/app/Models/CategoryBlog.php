<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    use HasFactory;

    protected $table = 'categories_blog';

    protected $fillable = [
        'name', 'slug', 'description', 'display_order', 'active'
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }
}
