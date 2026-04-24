<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminHeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('display_order', 'asc')->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|max:255',
            'badge_text'         => 'nullable|max:100',
            'description'        => 'nullable',
            'image_file'         => 'nullable|image|max:5120',
            'image_url'          => 'nullable|url|max:500',
            'button_text'        => 'nullable|max:100',
            'button_url'         => 'nullable|url|max:500',
            'cta_primary_text'   => 'nullable|max:100',
            'cta_secondary_text' => 'nullable|max:100',
            'display_order'      => 'required|integer',
        ]);

        // Unique constraint check for active slides
        if ($request->has('active')) {
            $exists = HeroSlide::where('display_order', $request->display_order)
                ->where('active', true)
                ->exists();
            if ($exists) {
                return back()->withErrors(['display_order' => 'Another active slide already uses this display order.'])->withInput();
            }
        }

        $data = $request->only(['title', 'badge_text', 'description', 'button_text', 'button_url', 'cta_primary_text', 'cta_secondary_text', 'display_order']);
        $data['active'] = $request->has('active');

        // Handle image
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_hero_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/hero'), $filename);
            $data['image_url'] = '/uploads/hero/' . $filename;
        } elseif ($request->image_url) {
            $data['image_url'] = $request->image_url;
        } else {
            return back()->withErrors(['image_file' => 'Please provide either an image file or a URL.'])->withInput();
        }

        HeroSlide::create($data);
        return redirect()->route('hero-slides.index')->with('success', 'Hero slide added successfully.');
    }

    public function edit($id)
    {
        $slide = HeroSlide::findOrFail($id);
        return view('admin.hero-slides.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = HeroSlide::findOrFail($id);

        $request->validate([
            'title'              => 'required|max:255',
            'badge_text'         => 'nullable|max:100',
            'description'        => 'nullable',
            'image_file'         => 'nullable|image|max:5120',
            'image_url'          => 'nullable|url|max:500',
            'button_text'        => 'nullable|max:100',
            'button_url'         => 'nullable|url|max:500',
            'cta_primary_text'   => 'nullable|max:100',
            'cta_secondary_text' => 'nullable|max:100',
            'display_order'      => 'required|integer',
        ]);

        // Unique constraint check for active slides (excluding self)
        if ($request->has('active')) {
            $exists = HeroSlide::where('display_order', $request->display_order)
                ->where('active', true)
                ->where('id', '!=', $id)
                ->exists();
            if ($exists) {
                return back()->withErrors(['display_order' => 'Another active slide already uses this display order.'])->withInput();
            }
        }

        $data = $request->only(['title', 'badge_text', 'description', 'button_text', 'button_url', 'cta_primary_text', 'cta_secondary_text', 'display_order']);
        $data['active'] = $request->has('active');

        if ($request->hasFile('image_file')) {
            // Delete old file if it was a local upload
            if ($slide->getRawOriginal('image_url') && str_starts_with($slide->getRawOriginal('image_url'), '/uploads/')) {
                $oldPath = public_path($slide->getRawOriginal('image_url'));
                if (File::exists($oldPath)) File::delete($oldPath);
            }
            $file = $request->file('image_file');
            $filename = time() . '_hero_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/hero'), $filename);
            $data['image_url'] = '/uploads/hero/' . $filename;
        } elseif ($request->image_url) {
            $data['image_url'] = $request->image_url;
        }

        $slide->update($data);
        return redirect()->route('hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy($id)
    {
        $slide = HeroSlide::findOrFail($id);
        if ($slide->getRawOriginal('image_url') && str_starts_with($slide->getRawOriginal('image_url'), '/uploads/')) {
            $imagePath = public_path($slide->getRawOriginal('image_url'));
            if (File::exists($imagePath)) File::delete($imagePath);
        }
        $slide->delete();
        return redirect()->route('hero-slides.index')->with('success', 'Hero slide deleted.');
    }
}
