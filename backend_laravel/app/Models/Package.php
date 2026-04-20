<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(CategoryTour::class, 'category_id');
    }
}
