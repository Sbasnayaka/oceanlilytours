<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\CategoryTour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('category')->orderBy('id', 'desc')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $categories = CategoryTour::where('active', true)->get();
        return view('admin.packages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:packages,slug',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories_tour,id',
            'image_url' => 'nullable|max:500',
            'description' => 'required',
            'itinerary' => 'nullable',
            'duration_days' => 'required|integer|min:1',
            'max_persons' => 'required|integer|min:1',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active');

        // File upload handling via local storage
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Move directly to public uploads to guarantee it works flawlessly on cPanel without symlinks!
            $file->move(public_path('uploads/packages'), $filename);
            $validated['image_url'] = '/uploads/packages/' . $filename;
        }

        Package::create($validated);
        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $categories = CategoryTour::where('active', true)->get();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:packages,slug,'.$package->id,
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories_tour,id',
            'image_url' => 'nullable|max:500',
            'description' => 'required',
            'itinerary' => 'nullable',
            'duration_days' => 'required|integer|min:1',
            'max_persons' => 'required|integer|min:1',
        ]);

        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active');

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/packages'), $filename);
            $validated['image_url'] = '/uploads/packages/' . $filename;
        }

        $package->update($validated);
        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
