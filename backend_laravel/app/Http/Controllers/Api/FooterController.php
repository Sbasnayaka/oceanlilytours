<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterContent;

class FooterController extends Controller
{
    public function index()
    {
        return response()->json(FooterContent::where('active', true)->orderBy('display_order', 'asc')->get());
    }
}
