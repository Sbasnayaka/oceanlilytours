<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $table = 'why_choose_us';

    protected $fillable = [
        'icon_class',
        'title',
        'description',
        'icon_bg_color',
        'icon_text_color',
        'display_order',
        'active',
    ];
}
