<?php

namespace App\Http\Controllers;

use App\Models\TripadvisorReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminTripadvisorController extends Controller
{
    public function index()
    {
        $reviews = TripadvisorReview::orderBy('display_order', 'asc')->get();
        return view('admin.tripadvisor.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.tripadvisor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reviewer_name'  => 'required|max:255',
            'location'       => 'nullable|max:255',
            'review_title'   => 'nullable|max:255',
            'trip_date'      => 'nullable|date',
            'rating'         => 'required|integer|min:1|max:5',
            'review_text'    => 'nullable',
            'review_link'    => 'nullable|url|max:500',
            'reviewer_image' => 'nullable|image|max:2048',
            'display_order'  => 'integer',
        ]);

        $data = $request->only([
            'reviewer_name', 'location', 'review_title', 'trip_date',
            'rating', 'review_text', 'review_link', 'display_order',
        ]);
        $data['show_on_homepage'] = $request->has('show_on_homepage');

        if ($request->hasFile('reviewer_image')) {
            $file = $request->file('reviewer_image');
            $filename = time() . '_tripadvisor_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tripadvisor'), $filename);
            $data['reviewer_image'] = '/uploads/tripadvisor/' . $filename;
        }

        TripadvisorReview::create($data);
        return redirect()->route('tripadvisor.index')->with('success', 'TripAdvisor review added successfully.');
    }

    public function edit($id)
    {
        $review = TripadvisorReview::findOrFail($id);
        return view('admin.tripadvisor.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = TripadvisorReview::findOrFail($id);

        $request->validate([
            'reviewer_name'  => 'required|max:255',
            'location'       => 'nullable|max:255',
            'review_title'   => 'nullable|max:255',
            'trip_date'      => 'nullable|date',
            'rating'         => 'required|integer|min:1|max:5',
            'review_text'    => 'nullable',
            'review_link'    => 'nullable|url|max:500',
            'reviewer_image' => 'nullable|image|max:2048',
            'display_order'  => 'integer',
        ]);

        $data = $request->only([
            'reviewer_name', 'location', 'review_title', 'trip_date',
            'rating', 'review_text', 'review_link', 'display_order',
        ]);
        $data['show_on_homepage'] = $request->has('show_on_homepage');

        if ($request->hasFile('reviewer_image')) {
            if ($review->getRawOriginal('reviewer_image')) {
                $oldPath = public_path($review->getRawOriginal('reviewer_image'));
                if (File::exists($oldPath)) File::delete($oldPath);
            }
            $file = $request->file('reviewer_image');
            $filename = time() . '_tripadvisor_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tripadvisor'), $filename);
            $data['reviewer_image'] = '/uploads/tripadvisor/' . $filename;
        }

        $review->update($data);
        return redirect()->route('tripadvisor.index')->with('success', 'TripAdvisor review updated successfully.');
    }

    public function destroy($id)
    {
        $review = TripadvisorReview::findOrFail($id);

        if ($review->getRawOriginal('reviewer_image')) {
            $imagePath = public_path($review->getRawOriginal('reviewer_image'));
            if (File::exists($imagePath)) File::delete($imagePath);
        }

        $review->delete();
        return redirect()->route('tripadvisor.index')->with('success', 'TripAdvisor review deleted.');
    }
}
