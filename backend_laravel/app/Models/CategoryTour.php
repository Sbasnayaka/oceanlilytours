<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTour extends Model
{
    use HasFactory;

    protected $table = 'categories_tour';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'display_order',
        'active'
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'category_tour_package', 'category_tour_id', 'package_id');
    }
}
