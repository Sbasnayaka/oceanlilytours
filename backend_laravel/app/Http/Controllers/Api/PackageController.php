<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::with(['category', 'categories', 'itineraries']);
        if ($request->has('featured')) {
            $query->where('featured', true);
        }
        return response()->json($query->get());
    }

    public function show($id)
    {
        $package = Package::with(['category', 'categories', 'itineraries'])->find($id);
        if (!$package) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($package);
    }
}
