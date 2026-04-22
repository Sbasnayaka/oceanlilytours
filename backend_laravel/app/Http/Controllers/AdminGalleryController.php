<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::orderBy('display_order', 'asc')->get();
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'image_file' => 'required|image',
            'description' => 'nullable',
            'display_order' => 'integer'
        ]);

        $validated = $request->only(['title', 'description', 'display_order']);
        $validated['active'] = $request->has('active');

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_gallery_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/gallery'), $filename);
            $validated['image_url'] = '/uploads/gallery/' . $filename;
        }

        GalleryImage::create($validated);
        return redirect()->route('gallery.index')->with('success', 'Image uploaded safely.');
    }

    public function edit($id)
    {
        $image = GalleryImage::findOrFail($id);
        return view('admin.gallery.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = GalleryImage::findOrFail($id);
        
        $request->validate([
            'title' => 'nullable|max:255',
            'image_file' => 'nullable|image',
            'description' => 'nullable',
            'display_order' => 'integer'
        ]);

        $validated = $request->only(['title', 'description', 'display_order']);
        $validated['active'] = $request->has('active');

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_gallery_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/gallery'), $filename);
            $validated['image_url'] = '/uploads/gallery/' . $filename;
        }

        $image->update($validated);
        return redirect()->route('gallery.index')->with('success', 'Gallery metadata updated.');
    }

    public function destroy($id)
    {
        $image = GalleryImage::findOrFail($id);
        if ($image->image_url) {
            $imagePath = public_path(parse_url($image->image_url, PHP_URL_PATH));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $image->delete();
        return redirect()->route('gallery.index')->with('success', 'Image completely removed from server.');
    }
}
