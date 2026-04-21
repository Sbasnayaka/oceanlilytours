<?php

namespace App\Http\Controllers;

use App\Models\CategoryTour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryTour::orderBy('display_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:categories_tour,slug',
            'description' => 'nullable',
            'icon' => 'nullable|max:100',
            'display_order' => 'integer',
            'active' => 'boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        // Check for active toggle since unchecked checkboxes are not sent
        if(!$request->has('active')) {
            $validated['active'] = false;
        }

        CategoryTour::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(CategoryTour $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, CategoryTour $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories_tour,slug,'.$category->id,
            'description' => 'nullable',
            'icon' => 'nullable|max:100',
            'display_order' => 'integer',
            'active' => 'boolean'
        ]);
        
        // Handle boolean toggle
        $validated['active'] = $request->has('active');

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(CategoryTour $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
