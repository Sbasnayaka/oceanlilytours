<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;

class HeroSlideController extends Controller
{
    public function index()
    {
        return response()->json(HeroSlide::where('active', true)->orderBy('display_order', 'asc')->get());
    }
}
