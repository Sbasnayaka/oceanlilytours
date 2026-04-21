<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\CategoryTour;
use App\Models\PackageItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['category', 'categories'])->orderBy('id', 'desc')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $categories = CategoryTour::where('active', true)->get();
        return view('admin.packages.create', compact('categories'));
    }

    private function validatePackageData(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:packages,slug' . ($id ? ",$id" : ''),
            'sub_heading' => 'nullable|max:255',
            'price' => 'required|numeric|min:0',
            'tour_type' => 'nullable|max:100',
            'location_count' => 'nullable|max:100',
            'duration_days' => 'required|integer|min:1',
            'max_persons' => 'required|integer|min:1',
            'category_id' => 'nullable|exists:categories_tour,id', // Legacy primary
            'categories' => 'array',
            'categories.*' => 'exists:categories_tour,id',
            'image_file' => 'nullable|image',
            'map_embed_code' => 'nullable',
            'description' => 'required',
            'journey_highlights' => 'nullable',
            'insightful_tips' => 'nullable',
            'faq_content' => 'nullable',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable|max:500',
            'itineraries' => 'array',
            'itineraries.*.title' => 'required_with:itineraries|max:255',
            'itineraries.*.description' => 'nullable',
            'itineraries.*.image' => 'nullable|image'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePackageData($request);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active');

        // Extract related fields
        $categoryIds = $request->input('categories', []);
        
        // Auto-assign first category to legacy category_id if not explicitly set
        if (empty($validated['category_id']) && count($categoryIds) > 0) {
            $validated['category_id'] = $categoryIds[0];
        }

        // Handle Main Image locally
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/packages'), $filename);
            $validated['image_url'] = '/uploads/packages/' . $filename;
        }

        $package = Package::create($validated);
        
        // Sync Pivot
        $package->categories()->sync($categoryIds);

        // Handle Dynamic Itineraries
        $this->processItineraries($request, $package);

        return redirect()->route('packages.index')->with('success', 'Package created beautifully!');
    }

    public function edit(Package $package)
    {
        $categories = CategoryTour::where('active', true)->get();
        $package->load(['categories', 'itineraries']);
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $this->validatePackageData($request, $package->id);

        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active');

        $categoryIds = $request->input('categories', []);
        
        if (empty($validated['category_id']) && count($categoryIds) > 0) {
            $validated['category_id'] = $categoryIds[0];
        } elseif (empty($validated['category_id'])) {
            $validated['category_id'] = null;
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/packages'), $filename);
            $validated['image_url'] = '/uploads/packages/' . $filename;
        }

        $package->update($validated);
        $package->categories()->sync($categoryIds);

        // Clear out old itineraries and rebuild them dynamically to maintain exact sync order 
        // This is the simplest & absolute safest way to handle deep dynamic DOM sorting arrays
        $package->itineraries()->delete(); 
        $this->processItineraries($request, $package);

        return redirect()->route('packages.index')->with('success', 'Package architecture updated successfully!');
    }

    private function processItineraries(Request $request, Package $package)
    {
        if ($request->has('itineraries')) {
            $dayNumber = 1;
            foreach ($request->itineraries as $index => $itineraryData) {
                // Determine image path (preserve old path if rebuilding from DB, or upload new)
                $imageUrl = $itineraryData['existing_image_url'] ?? null;
                
                if ($request->hasFile("itineraries.{$index}.image")) {
                    $file = $request->file("itineraries.{$index}.image");
                    $filename = time() . '_itin_' . $dayNumber . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/packages/itineraries'), $filename);
                    $imageUrl = '/uploads/packages/itineraries/' . $filename;
                }

                PackageItinerary::create([
                    'package_id' => $package->id,
                    'day_number' => $dayNumber,
                    'title' => $itineraryData['title'],
                    'description' => $itineraryData['description'] ?? null,
                    'image_url' => $imageUrl
                ]);
                
                $dayNumber++;
            }
        }
    }

    public function destroy(Package $package)
    {
        // 1. Delete main package image
        if ($package->image_url) {
            $imagePath = public_path(parse_url($package->image_url, PHP_URL_PATH));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // 2. Delete all itinerary images
        foreach ($package->itineraries as $itin) {
            if ($itin->image_url) {
                $itinPath = public_path(parse_url($itin->image_url, PHP_URL_PATH));
                if (File::exists($itinPath)) {
                    File::delete($itinPath);
                }
            }
        }

        $package->delete(); // Automatically cascades to package_itineraries and category pivot table natively
        return redirect()->route('packages.index')->with('success', 'Package completely deleted (images removed from server).');
    }
}
