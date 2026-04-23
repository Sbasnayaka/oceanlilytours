@extends('admin.layouts.app')
@section('title', 'Edit Partner')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('partners.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Edit Partner</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl">
    <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-100">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Partner Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Website / Profile Link</label>
                <input type="url" name="profile_link" value="{{ old('profile_link', $partner->profile_link) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Partner Logo</label>
                @if($partner->getRawOriginal('logo_image'))
                    <div class="flex items-center gap-3 mb-2 p-2 bg-gray-50 rounded-lg border border-gray-200">
                        <img src="{{ url($partner->getRawOriginal('logo_image')) }}" class="h-8 w-auto max-w-[80px] object-contain" alt="Current logo"/>
                        <span class="text-xs text-gray-500">Current logo</span>
                    </div>
                @endif
                <input type="file" name="logo_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none transition text-sm text-gray-600">
                <p class="text-xs text-gray-500 mt-1">Upload a new logo to replace the current one. Max 2MB.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', $partner->display_order) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description', $partner->description) }}</textarea>
            </div>

            <div>
                <label class="flex items-center cursor-pointer gap-2">
                    <input type="checkbox" name="active" value="1" {{ old('active', $partner->active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300">
                    <span class="text-sm font-bold text-gray-700">Active (Visible on website)</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-save mr-2"></i> Update Partner
            </button>
        </div>
    </form>
</div>
@endsection
