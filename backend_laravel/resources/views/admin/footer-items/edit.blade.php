@extends('admin.layouts.app')
@section('title', 'Edit Footer Item')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('footer-items.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Edit Footer Item</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-2xl">
    <form action="{{ route('footer-items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Section Title <span class="text-red-500">*</span></label>
                <input type="text" name="section" value="{{ old('section', $item->section) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Label / Key Name <span class="text-red-500">*</span></label>
                <input type="text" name="key_name" value="{{ old('key_name', $item->key_name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Value / URL <span class="text-red-500">*</span></label>
                <textarea name="value" rows="2" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('value', $item->value) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $item->display_order) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center cursor-pointer gap-2">
                        <input type="checkbox" name="active" value="1" {{ old('active', $item->active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300">
                        <span class="text-sm font-bold text-gray-700">Active</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition-all">
                <i class="fas fa-save mr-2"></i> Update Footer Item
            </button>
        </div>
    </form>
</div>
@endsection
