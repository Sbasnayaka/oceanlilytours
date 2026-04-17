<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('featured')) {
            return response()->json(BlogPost::where('featured', true)->get());
        }
        if ($request->has('slug')) {
            $post = BlogPost::where('slug', $request->slug)->first();
            if (!$post) {
                return response()->json(['message' => 'Not found'], 404);
            }
            return response()->json($post);
        }
        return response()->json(BlogPost::all());
    }
}
