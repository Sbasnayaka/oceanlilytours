<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('featured')) {
            return response()->json(Package::where('featured', true)->get());
        }
        return response()->json(Package::all());
    }

    public function show($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($package);
    }
}
