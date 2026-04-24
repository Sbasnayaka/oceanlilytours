@extends('admin.layouts.app')
@section('title', 'Add Hero Slide')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('hero-slides.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Add New Hero Slide</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-4xl">
    <form action="{{ route('hero-slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-100">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Slide Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="e.g. Discover Coastal Paradise">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Short tagline for the slide...">{{ old('description') }}</textarea>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Slide Image <span class="text-red-500">*</span></label>
                <div class="space-y-4">
                    <div>
                        <span class="text-xs text-gray-500 block mb-1">Option A: Upload File (Recommended)</span>
                        <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none transition text-sm text-gray-600 bg-gray-50">
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="h-px bg-gray-200 flex-1"></div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase">OR</span>
                        <div class="h-px bg-gray-200 flex-1"></div>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 block mb-1">Option B: External Image URL</span>
                        <input type="url" name="image_url" value="{{ old('image_url') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition text-sm" placeholder="https://example.com/image.jpg">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Display Order <span class="text-red-500">*</span></label>
                        <input type="number" name="display_order" value="{{ old('display_order', 0) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div class="flex items-end pb-2">
                        <label class="flex items-center cursor-pointer gap-2">
                            <input type="checkbox" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300">
                            <span class="text-sm font-bold text-gray-700">Active Slide</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Button Text</label>
                        <input type="text" name="button_text" value="{{ old('button_text') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="e.g. View Tours">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Button URL</label>
                        <input type="text" name="button_url" value="{{ old('button_url') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="/packages.html">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition-all">
                <i class="fas fa-save mr-2"></i> Create Hero Slide
            </button>
        </div>
    </form>
</div>
@endsection
