@extends('admin.layouts.app')
@section('title', 'Edit Page SEO')

@section('content')
<div class="mb-6">
    <a href="{{ route('seo-pages.index') }}" class="text-blue-600 hover:underline flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Back to SEO Manager
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm p-6 max-w-3xl">
    <form action="{{ route('seo-pages.update', $seoPage) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Page Name / ID <span class="text-red-500">*</span></label>
                <input type="text" name="page_name" value="{{ old('page_name', $seoPage->page_name) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="e.g. home, about, packages">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Page URL (Optional)</label>
                <input type="text" name="page_url" value="{{ old('page_url', $seoPage->page_url) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Meta Tags</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $seoPage->meta_title) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('meta_description', $seoPage->meta_description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $seoPage->meta_keywords) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">OpenGraph Tags (Social Sharing)</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OG Title</label>
                    <input type="text" name="og_title" value="{{ old('og_title', $seoPage->og_title) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OG Description</label>
                    <textarea name="og_description" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('og_description', $seoPage->og_description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OG Image</label>
                    @if($seoPage->og_image)
                        <div class="mb-2">
                            <img src="{{ $seoPage->og_image }}" alt="OG Image" class="h-32 object-contain bg-gray-100 rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="og_image" accept="image/*" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep existing image.</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6 flex justify-end">
            <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition">
                Update SEO Settings
            </button>
        </div>
    </form>
</div>
@endsection
