@extends('admin.layouts.app')
@section('title', 'Edit Testimonial')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('testimonials.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Edit Testimonial</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl">
    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-100">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Guest Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $testimonial->location) }}" placeholder="e.g., London, UK" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Star Rating <span class="text-red-500">*</span></label>
                <select name="rating" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Profile Photo</label>
                @if($testimonial->getRawOriginal('profile_image'))
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ url($testimonial->getRawOriginal('profile_image')) }}" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200" alt="Current photo"/>
                        <span class="text-xs text-gray-500">Current photo</span>
                    </div>
                @endif
                <input type="file" name="profile_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none transition text-sm text-gray-600">
                <p class="text-xs text-gray-500 mt-1">Upload a new photo to replace the current one. Max 2MB.</p>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Review Text <span class="text-red-500">*</span></label>
                <textarea name="review_text" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('review_text', $testimonial->review_text) }}</textarea>
            </div>

            <div class="flex gap-6">
                <label class="flex items-center cursor-pointer gap-2">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $testimonial->featured) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300">
                    <span class="text-sm font-bold text-gray-700">Featured on Homepage</span>
                </label>
                <label class="flex items-center cursor-pointer gap-2">
                    <input type="checkbox" name="verified" value="1" {{ old('verified', $testimonial->verified) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300">
                    <span class="text-sm font-bold text-gray-700">Verified Guest</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-save mr-2"></i> Update Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
