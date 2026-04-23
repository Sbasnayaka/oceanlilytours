<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'location'      => 'nullable|max:255',
            'rating'        => 'required|integer|min:1|max:5',
            'review_text'   => 'required',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'rating', 'review_text']);
        $data['featured'] = $request->has('featured');
        $data['verified'] = $request->has('verified');

        // Handle optional profile photo upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_testimonial_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials'), $filename);
            $data['profile_image'] = '/uploads/testimonials/' . $filename;
        }

        Testimonial::create($data);
        return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name'          => 'required|max:255',
            'location'      => 'nullable|max:255',
            'rating'        => 'required|integer|min:1|max:5',
            'review_text'   => 'required',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'rating', 'review_text']);
        $data['featured'] = $request->has('featured');
        $data['verified'] = $request->has('verified');

        // Replace photo if a new one is uploaded
        if ($request->hasFile('profile_image')) {
            // Delete old photo from disk if it exists
            if ($testimonial->getRawOriginal('profile_image')) {
                $oldPath = public_path($testimonial->getRawOriginal('profile_image'));
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $file = $request->file('profile_image');
            $filename = time() . '_testimonial_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials'), $filename);
            $data['profile_image'] = '/uploads/testimonials/' . $filename;
        }

        $testimonial->update($data);
        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Safely delete the photo file from disk
        if ($testimonial->getRawOriginal('profile_image')) {
            $imagePath = public_path($testimonial->getRawOriginal('profile_image'));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
