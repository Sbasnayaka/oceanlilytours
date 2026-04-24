<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'url',
        'parent_id',
        'display_order',
        'active',
    ];

    public function children()
    {
        return $this->hasMany(NavbarItem::class, 'parent_id')->orderBy('display_order');
    }

    public function parent()
    {
        return $this->belongsTo(NavbarItem::class, 'parent_id');
    }
}
