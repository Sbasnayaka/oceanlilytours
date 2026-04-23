<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        // Only return active partners, in display_order
        return response()->json(
            Partner::where('active', true)
                ->orderBy('display_order', 'asc')
                ->get()
        );
    }
}
