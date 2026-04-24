<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NavbarItem;

class NavbarController extends Controller
{
    public function index()
    {
        return response()->json(NavbarItem::where('active', true)->orderBy('display_order', 'asc')->get());
    }
}
