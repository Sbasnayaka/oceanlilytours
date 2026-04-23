<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profile_link',
        'logo_image',
        'description',
        'display_order',
        'active',
    ];

    /**
     * Convert stored relative logo path to a full URL.
     */
    public function getLogoImageAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return url($value);
        }
        return $value;
    }
}
