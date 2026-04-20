<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with('category');
        if ($request->has('featured')) {
            $query->where('featured', true);
        }
        if ($request->has('slug')) {
            $post = BlogPost::with('category')->where('slug', $request->slug)->first();
            if (!$post) {
                return response()->json(['message' => 'Not found'], 404);
            }
            return response()->json($post);
        }
        return response()->json($query->get());
    }
}
