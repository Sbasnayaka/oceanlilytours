<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(CategoryBlog::class, 'category_id');
    }
}
