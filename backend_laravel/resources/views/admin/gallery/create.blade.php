@extends('admin.layouts.app')

@section('title', 'Upload Gallery Image')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('gallery.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Upload Gallery Image</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-4xl">
    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Select Image File <span class="text-red-500">*</span></label>
                <div class="bg-blue-50 p-6 rounded-xl border-2 border-dashed border-blue-200 text-center">
                    <i class="fas fa-cloud-upload-alt text-4xl text-blue-400 mb-3"></i>
                    <input type="file" name="image_file" accept="image/*" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition mx-auto">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Image Title (Optional)</label>
                <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="display_order" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Description (Optional)</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"></textarea>
            </div>

            <div class="flex items-center mt-4">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="active" value="1" checked class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-sm font-bold text-gray-700">Active (Visible in gallery)</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-upload mr-2"></i> Upload Image
            </button>
        </div>
    </form>
</div>
@endsection
