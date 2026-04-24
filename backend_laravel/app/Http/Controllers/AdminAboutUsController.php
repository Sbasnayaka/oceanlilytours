<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminAboutUsController extends Controller
{
    public function edit()
    {
        $about = AboutUs::first();
        if (!$about) {
            $about = new AboutUs();
        }
        return view('admin.about-us.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'        => 'nullable|max:255',
            'description'  => 'nullable',
            'team_image'   => 'nullable|image|max:5120',
            'mission_text' => 'nullable',
            'vision_text'  => 'nullable',
            'values_text'  => 'nullable',
        ]);

        $about = AboutUs::first() ?: new AboutUs();
        $data = $request->only(['title', 'description', 'mission_text', 'vision_text', 'values_text']);

        if ($request->hasFile('team_image')) {
            if ($about->getRawOriginal('team_image')) {
                $oldPath = public_path($about->getRawOriginal('team_image'));
                if (File::exists($oldPath)) File::delete($oldPath);
            }
            $file = $request->file('team_image');
            $filename = time() . '_about_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/about'), $filename);
            $data['team_image'] = '/uploads/about/' . $filename;
        }

        if ($about->exists) {
            $about->update($data);
        } else {
            AboutUs::create($data);
        }

        return redirect()->route('about-us.edit')->with('success', 'About Us content updated successfully.');
    }
}
