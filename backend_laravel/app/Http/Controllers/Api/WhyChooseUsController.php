<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        return response()->json(WhyChooseUs::where('active', true)->orderBy('display_order', 'asc')->get());
    }
}
