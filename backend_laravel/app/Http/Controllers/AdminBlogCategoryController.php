<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryBlog::orderBy('display_order', 'asc')->get();
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:categories_blog,slug',
            'description' => 'nullable',
            'display_order' => 'integer'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        $validated['active'] = $request->has('active');

        CategoryBlog::create($validated);
        return redirect()->route('blog-categories.index')->with('success', 'Blog Category created.');
    }

    public function edit($id)
    {
        $blogCategory = CategoryBlog::findOrFail($id);
        return view('admin.blog_categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, $id)
    {
        $blogCategory = CategoryBlog::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:categories_blog,slug,' . $blogCategory->id,
            'description' => 'nullable',
            'display_order' => 'integer'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        $validated['active'] = $request->has('active');

        $blogCategory->update($validated);
        return redirect()->route('blog-categories.index')->with('success', 'Blog Category updated.');
    }

    public function destroy($id)
    {
        CategoryBlog::findOrFail($id)->delete();
        return redirect()->route('blog-categories.index')->with('success', 'Blog Category deleted.');
    }
}
