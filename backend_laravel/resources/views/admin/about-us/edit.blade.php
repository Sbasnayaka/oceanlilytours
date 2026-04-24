@extends('admin.layouts.app')
@section('title', 'About Us Content')
@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Manage About Us Content</h2>
    <p class="text-sm text-gray-500">This content appears on the About page and partly on the homepage.</p>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-100 flex items-center">
    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-5xl">
    <form action="{{ route('about-us.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">About Title</label>
                <input type="text" name="title" value="{{ old('title', $about->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="e.g. Crafting Unforgettable Coastal Memories">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Main Description (Home & About)</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description', $about->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Team / Hero Image</label>
                @if($about->team_image)
                    <img src="{{ $about->team_image }}" class="w-full h-48 object-cover rounded-xl mb-4 border border-gray-100 shadow-sm" alt="About us image">
                @endif
                <input type="file" name="team_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none transition text-sm text-gray-600 bg-gray-50">
                <p class="text-[10px] text-gray-500 mt-1">Recommended size: 1200x800px. Max 5MB.</p>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Our Mission</label>
                    <textarea name="mission_text" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('mission_text', $about->mission_text) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Our Vision</label>
                    <textarea name="vision_text" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('vision_text', $about->vision_text) }}</textarea>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Our Values</label>
                <textarea name="values_text" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Sustainability, Integrity, Excellence...">{{ old('values_text', $about->values_text) }}</textarea>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-10 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition-all">
                <i class="fas fa-save mr-2"></i> Save About Us Content
            </button>
        </div>
    </form>
</div>
@endsection
