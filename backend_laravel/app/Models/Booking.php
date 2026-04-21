<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference', 'package_id', 'inquiry_id', 'customer_name', 
        'customer_email', 'customer_phone', 'number_of_persons', 
        'travel_date', 'total_price', 'paid_amount', 'status', 
        'special_requests', 'admin_notes', 'confirmed_at', 'confirmed_by'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
