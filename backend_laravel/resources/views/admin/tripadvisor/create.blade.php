@extends('admin.layouts.app')
@section('title', 'Add TripAdvisor Review')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('tripadvisor.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Add TripAdvisor Review</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl">
    <form action="{{ route('tripadvisor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-100">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Reviewer Name <span class="text-red-500">*</span></label>
                <input type="text" name="reviewer_name" value="{{ old('reviewer_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g., Australia" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Review Title</label>
                <input type="text" name="review_title" value="{{ old('review_title') }}" placeholder="e.g., An unforgettable experience!" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Trip Date</label>
                <input type="date" name="trip_date" value="{{ old('trip_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Star Rating <span class="text-red-500">*</span></label>
                <select name="rating" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                <p class="text-xs text-gray-500 mt-1">Lower = appears first.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Reviewer Photo</label>
                <input type="file" name="reviewer_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none transition text-sm text-gray-600">
                <p class="text-xs text-gray-500 mt-1">Optional. Max 2MB.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">TripAdvisor Review Link</label>
                <input type="url" name="review_link" value="{{ old('review_link') }}" placeholder="https://tripadvisor.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Review Text</label>
                <textarea name="review_text" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('review_text') }}</textarea>
            </div>

            <div>
                <label class="flex items-center cursor-pointer gap-2">
                    <input type="checkbox" name="show_on_homepage" value="1" checked class="w-4 h-4 text-blue-600 rounded border-gray-300">
                    <span class="text-sm font-bold text-gray-700">Show on Homepage</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 shadow-sm transition">
                <i class="fas fa-save mr-2"></i> Save Review
            </button>
        </div>
    </form>
</div>
@endsection
