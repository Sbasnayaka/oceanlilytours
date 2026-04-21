<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItinerary extends Model
{
    use HasFactory;
    
    protected $table = 'package_itineraries';
    
    protected $fillable = [
        'package_id', 'day_number', 'title', 'description', 'image_url'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    /**
     * Automatically convert relative upload paths to absolute URLs for the API
     */
    public function getImageUrlAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return url($value);
        }
        return $value;
    }
}
