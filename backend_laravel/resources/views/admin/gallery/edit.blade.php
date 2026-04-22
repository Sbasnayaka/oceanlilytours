@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('gallery.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Edit Gallery Image</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-4xl">
    <form action="{{ route('gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Current Image</label>
                @if($image->image_url)
                    <img src="{{ $image->image_url }}" class="h-48 w-auto rounded-lg shadow-sm border border-gray-200 mb-4">
                @endif
                <label class="block text-sm font-bold text-gray-700 mb-2">Replace File (Leave blank to keep current)</label>
                <input type="file" name="image_file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Image Title</label>
                <input type="text" name="title" value="{{ $image->title }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="display_order" value="{{ $image->display_order }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ $image->description }}</textarea>
            </div>

            <div class="flex items-center mt-4">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ $image->active ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-sm font-bold text-gray-700">Active (Visible in gallery)</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-save mr-2"></i> Update Metadata
            </button>
        </div>
    </form>
</div>
@endsection
