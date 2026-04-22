@extends('admin.layouts.app')

@section('title', 'Add Service')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('services.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Add Premium Service</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-4xl">
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Service Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Icon Name (Material Symbols)</label>
                <input type="text" name="icon" placeholder="e.g., flight_takeoff" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                <p class="text-xs text-gray-500 mt-1">
                    Find free icons at:
                    <a href="https://fonts.google.com/icons" target="_blank" class="text-blue-600 font-semibold underline hover:text-blue-800">fonts.google.com/icons</a>
                    — Copy the icon name (e.g. <code class="bg-gray-100 px-1 rounded">flight_takeoff</code>, <code class="bg-gray-100 px-1 rounded">hotel</code>, <code class="bg-gray-100 px-1 rounded">nature_people</code>).
                </p>
                {{-- Live Icon Preview --}}
                <div id="icon-preview" class="mt-2 hidden flex items-center gap-2 text-blue-600 text-sm font-medium">
                    <span id="preview-icon" class="material-symbols-outlined text-2xl"></span>
                    <span id="preview-label" class="text-gray-500"></span>
                </div>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="display_order" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                <p class="text-xs text-gray-500 mt-1">Lower numbers appear first (0 = top).</p>
            </div>

            <div class="flex items-center mt-6">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="active" value="1" checked class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-sm font-bold text-gray-700">Active (Visible on website)</span>
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-save mr-2"></i> Save Service
            </button>
        </div>
    </form>
</div>

{{-- Load Material Symbols for preview --}}
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

@push('scripts')
<script>
(function() {
    var input = document.querySelector('input[name="icon"]');
    var preview = document.getElementById('icon-preview');
    var previewIcon = document.getElementById('preview-icon');
    var previewLabel = document.getElementById('preview-label');

    if (!input) return;

    input.addEventListener('input', function() {
        var val = input.value.trim();
        if (val.length > 0) {
            previewIcon.textContent = val;
            previewLabel.textContent = '"' + val + '"';
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    });
})();
</script>
@endpush
@endsection
