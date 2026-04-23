<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('display_order', 'asc')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'profile_link'  => 'nullable|url|max:500',
            'logo_image'    => 'nullable|image|max:2048',
            'description'   => 'nullable',
            'display_order' => 'integer',
        ]);

        $data = $request->only(['name', 'profile_link', 'description', 'display_order']);
        $data['active'] = $request->has('active');

        if ($request->hasFile('logo_image')) {
            $file = $request->file('logo_image');
            $filename = time() . '_partner_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/partners'), $filename);
            $data['logo_image'] = '/uploads/partners/' . $filename;
        }

        Partner::create($data);
        return redirect()->route('partners.index')->with('success', 'Partner added successfully.');
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'name'          => 'required|max:255',
            'profile_link'  => 'nullable|url|max:500',
            'logo_image'    => 'nullable|image|max:2048',
            'description'   => 'nullable',
            'display_order' => 'integer',
        ]);

        $data = $request->only(['name', 'profile_link', 'description', 'display_order']);
        $data['active'] = $request->has('active');

        if ($request->hasFile('logo_image')) {
            if ($partner->getRawOriginal('logo_image')) {
                $oldPath = public_path($partner->getRawOriginal('logo_image'));
                if (File::exists($oldPath)) File::delete($oldPath);
            }
            $file = $request->file('logo_image');
            $filename = time() . '_partner_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/partners'), $filename);
            $data['logo_image'] = '/uploads/partners/' . $filename;
        }

        $partner->update($data);
        return redirect()->route('partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        if ($partner->getRawOriginal('logo_image')) {
            $logoPath = public_path($partner->getRawOriginal('logo_image'));
            if (File::exists($logoPath)) File::delete($logoPath);
        }

        $partner->delete();
        return redirect()->route('partners.index')->with('success', 'Partner deleted.');
    }
}
