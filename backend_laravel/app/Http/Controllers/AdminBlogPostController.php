<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminBlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->orderBy('id', 'desc')->get();
        return view('admin.blog_posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = CategoryBlog::where('active', true)->get();
        return view('admin.blog_posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:blog_posts,slug',
            'category_id' => 'nullable|exists:categories_blog,id',
            'content' => 'required',
            'excerpt' => 'nullable',
            'featured_image' => 'nullable|image',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $validated['featured'] = $request->has('featured');
        $validated['published'] = $request->has('published');

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_blog_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blog'), $filename);
            $validated['featured_image'] = '/uploads/blog/' . $filename;
        }

        BlogPost::create($validated);
        return redirect()->route('blog-posts.index')->with('success', 'Blog Post published.');
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $categories = CategoryBlog::where('active', true)->get();
        return view('admin.blog_posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:blog_posts,slug,' . $post->id,
            'category_id' => 'nullable|exists:categories_blog,id',
            'content' => 'required',
            'excerpt' => 'nullable',
            'featured_image' => 'nullable|image',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $validated['featured'] = $request->has('featured');
        $validated['published'] = $request->has('published');

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_blog_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blog'), $filename);
            $validated['featured_image'] = '/uploads/blog/' . $filename;
        }

        $post->update($validated);
        return redirect()->route('blog-posts.index')->with('success', 'Blog Post updated.');
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        if ($post->featured_image) {
            $imagePath = public_path(parse_url($post->featured_image, PHP_URL_PATH));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $post->delete();
        return redirect()->route('blog-posts.index')->with('success', 'Blog Post completely deleted (image removed from server).');
    }
}
