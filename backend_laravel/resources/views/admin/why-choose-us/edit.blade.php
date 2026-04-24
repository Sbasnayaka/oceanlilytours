@extends('admin.layouts.app')
@section('title', 'Edit Feature')
@section('content')

<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('why-choose-us.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Edit Feature Block</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl">
    <form action="{{ route('why-choose-us.update', $feature->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Feature Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $feature->title) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description', $feature->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Material Icon Name</label>
                <div class="flex gap-2">
                    <input type="text" name="icon_class" id="icon_input" value="{{ old('icon_class', $feature->icon_class) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <div id="icon_preview" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg text-gray-600 border border-gray-200 flex-shrink-0">
                        <span class="material-symbols-outlined">{{ $feature->icon_class ?: 'help_outline' }}</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', $feature->display_order) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Icon Background Color</label>
                <input type="color" name="icon_bg_color" value="{{ old('icon_bg_color', $feature->icon_bg_color ?: '#EFF6FF') }}" class="w-full h-10 p-1 border border-gray-300 rounded-lg outline-none transition cursor-pointer">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Icon Text Color</label>
                <input type="color" name="icon_text_color" value="{{ old('icon_text_color', $feature->icon_text_color ?: '#1E40AF') }}" class="w-full h-10 p-1 border border-gray-300 rounded-lg outline-none transition cursor-pointer">
            </div>

            <div>
                <label class="flex items-center cursor-pointer gap-2">
                    <input type="checkbox" name="active" value="1" {{ old('active', $feature->active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300">
                    <span class="text-sm font-bold text-gray-700">Active (Visible)</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition-all">
                <i class="fas fa-save mr-2"></i> Update Feature
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const iconInput = document.getElementById('icon_input');
    const iconPreview = document.getElementById('icon_preview').querySelector('span');
    
    iconInput.addEventListener('input', (e) => {
        iconPreview.textContent = e.target.value || 'help_outline';
    });
</script>
@endpush
@endsection
