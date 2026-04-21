@extends('admin.layouts.app')

@section('title', 'Edit Package')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Edit Package: {{ $package->name }}</h2>
    <a href="{{ route('packages.index') }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left mr-2"></i> Back
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Package Name *</label>
                    <input type="text" name="name" value="{{ old('name', $package->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $package->slug) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detailed Description *</label>
                    <textarea name="description" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition">{{ old('description', $package->description) }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Itinerary (HTML/Text)</label>
                    <textarea name="itinerary" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition">{{ old('itinerary', $package->itinerary) }}</textarea>
                </div>
            </div>

            <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-100">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                        <option value="">-- No Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id') ?? $package->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Base Price ($) *</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration (Days) *</label>
                        <input type="number" min="1" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Max Persons *</label>
                        <input type="number" min="1" name="max_persons" value="{{ old('max_persons', $package->max_persons) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                    @if($package->image_url)
                        <img src="{{ $package->image_url }}" alt="Preview" class="w-full h-32 object-cover rounded-lg shadow-sm border border-gray-200 mb-2">
                    @else
                        <div class="text-sm italic text-gray-400 mb-2">No image currently selected.</div>
                    @endif
                    <label class="block text-sm font-medium text-gray-700 mt-2 mb-1">Replace Image</label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                </div>

                <hr class="border-gray-200">

                <div class="space-y-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $package->featured) ? 'checked' : '' }} class="w-5 h-5 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                        <span class="ml-3 text-sm font-bold text-gray-800">Featured Package</span>
                    </label>
                    
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="active" value="1" {{ old('active', $package->active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-3 text-sm font-medium text-gray-700">Active & Visible</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                    Update Package details
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
