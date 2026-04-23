<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        // Only return featured testimonials, newest first
        return response()->json(
            Testimonial::where('featured', true)
                ->orderBy('id', 'desc')
                ->get()
        );
    }
}
