<?php

namespace App\Http\Controllers;

use App\Models\SeoPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSeoPageController extends Controller
{
    public function index()
    {
        $seoPages = SeoPage::orderBy('page_name')->get();
        return view('admin.seo-pages.index', compact('seoPages'));
    }

    public function create()
    {
        return view('admin.seo-pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255|unique:seo_pages,page_name',
            'meta_title' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|max:5120',
        ]);

        $data = $request->except('og_image');

        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $filename = time() . '_seo_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/seo'), $filename);
            $data['og_image'] = '/uploads/seo/' . $filename;
        }

        SeoPage::create($data);

        return redirect()->route('seo-pages.index')->with('success', 'SEO Page created successfully.');
    }

    public function edit(SeoPage $seoPage)
    {
        return view('admin.seo-pages.edit', compact('seoPage'));
    }

    public function update(Request $request, SeoPage $seoPage)
    {
        $request->validate([
            'page_name' => 'required|string|max:255|unique:seo_pages,page_name,' . $seoPage->id,
            'meta_title' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|max:5120',
        ]);

        $data = $request->except('og_image');

        if ($request->hasFile('og_image')) {
            if ($seoPage->getRawOriginal('og_image')) {
                $oldPath = public_path($seoPage->getRawOriginal('og_image'));
                if (File::exists($oldPath)) File::delete($oldPath);
            }
            $file = $request->file('og_image');
            $filename = time() . '_seo_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/seo'), $filename);
            $data['og_image'] = '/uploads/seo/' . $filename;
        }

        $seoPage->update($data);

        return redirect()->route('seo-pages.index')->with('success', 'SEO Page updated successfully.');
    }

    public function destroy(SeoPage $seoPage)
    {
        if ($seoPage->getRawOriginal('og_image')) {
            $oldPath = public_path($seoPage->getRawOriginal('og_image'));
            if (File::exists($oldPath)) File::delete($oldPath);
        }
        
        $seoPage->delete();

        return redirect()->route('seo-pages.index')->with('success', 'SEO Page deleted successfully.');
    }
}
