@extends('admin.layouts.app')

@section('title', 'Edit Tour Package Builder')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Edit Tour: {{ $package->name }}</h2>
    <a href="{{ route('packages.index') }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
        <i class="fas fa-list mr-2"></i> Back to List
    </a>
</div>

<form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg border border-red-100">
            <h4 class="font-bold mb-2">Please fix the following errors:</h4>
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- PANEL: Basic Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 border-b pb-2">Basic information</h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tour Name *</label>
                <input type="text" name="name" value="{{ old('name', $package->name) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Slug (URL)</label>
                    <input type="text" name="slug" value="{{ old('slug', $package->slug) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Sub Heading (Top Banner Text)</label>
                    <input type="text" name="sub_heading" value="{{ old('sub_heading', $package->sub_heading) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
                </div>
            </div>

            <div class="pt-2">
                <label class="block text-xs font-semibold text-gray-500 mb-2">Categories *</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 bg-gray-50 p-4 rounded border border-gray-200">
                    @php
                        $selectedCategoryIds = old('categories') ?: $package->categories->pluck('id')->toArray();
                    @endphp
                    @forelse($categories as $category)
                        <label class="flex items-center space-x-2 text-sm cursor-pointer hover:text-blue-600 transition">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($category->id, $selectedCategoryIds) ? 'checked' : '' }}>
                            <span>{{ $category->name }}</span>
                        </label>
                    @empty
                        <span class="text-sm text-red-500 col-span-4">No categories found!</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL: Key Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 border-b pb-2">Key Details</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Price / Range ($) *</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Duration (Days) *</label>
                <input type="number" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tour Type</label>
                <input type="text" name="tour_type" value="{{ old('tour_type', $package->tour_type) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Min / Max People *</label>
                <input type="number" name="max_persons" value="{{ old('max_persons', $package->max_persons) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Location Count</label>
                <input type="text" name="location_count" value="{{ old('location_count', $package->location_count) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            <div class="col-span-1 md:col-span-3 flex gap-6 items-center pt-5">
                <label class="flex items-center space-x-2 text-sm cursor-pointer hover:text-green-600 transition">
                    <input type="checkbox" name="featured" value="1" class="rounded text-green-600 focus:ring-green-500" {{ old('featured', $package->featured) ? 'checked' : '' }}>
                    <span class="font-bold text-green-600">Mark as Featured</span>
                </label>
                <label class="flex items-center space-x-2 text-sm cursor-pointer hover:text-blue-600 transition">
                    <input type="checkbox" name="active" value="1" class="rounded text-blue-600 focus:ring-blue-500" {{ old('active', $package->active) ? 'checked' : '' }}>
                    <span class="font-bold text-blue-600">Active & Published</span>
                </label>
            </div>
        </div>
    </div>

    <!-- PANEL: Media & Map -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 border-b pb-2">Media & Map</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($package->image_url)
                    <img src="{{ $package->image_url }}" alt="Preview" class="w-full h-32 object-cover rounded-lg shadow-sm border border-gray-200 mb-2">
                @endif
                <label class="block text-xs font-semibold text-gray-500 mb-1">Replace Main Background Image</label>
                <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer bg-gray-50 border border-gray-200 p-1">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Map Embed Code (Iframe)</label>
                <textarea name="map_embed_code" rows="5" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm font-mono text-xs">{{ old('map_embed_code', $package->map_embed_code) }}</textarea>
            </div>
        </div>
    </div>

    <!-- PANEL: Detailed Content (TinyMCE fields) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 border-b pb-2">Detailed Content</h3>
        
        <div class="space-y-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tour Description (Before Itinerary) *</label>
                <textarea name="description" class="rich-editor">{{ old('description', $package->description) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Journey Highlights</label>
                <textarea name="journey_highlights" class="rich-editor">{{ old('journey_highlights', $package->journey_highlights) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-red-500 mb-1">Insightful Tips (Pink Box)</label>
                <textarea name="insightful_tips" class="rich-editor">{{ old('insightful_tips', $package->insightful_tips) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">FAQ Content</label>
                <textarea name="faq_content" class="rich-editor">{{ old('faq_content', $package->faq_content) }}</textarea>
            </div>
        </div>
    </div>

    <!-- PANEL: Dynamic Itinerary Builder -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-blue-100 p-6">
        <div class="flex justify-between items-center mb-4 border-b border-blue-200 pb-2">
            <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wider"><i class="fas fa-route mr-2"></i> Day-by-Day Itinerary Builder</h3>
            <button type="button" id="add-day-btn" class="px-3 py-1 bg-blue-600 text-white text-sm font-bold rounded shadow hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-1"></i> Add Day to Itinerary
            </button>
        </div>
        
        <div id="itinerary-container" class="space-y-4">
            @php $itineraries = old('itineraries') ?: $package->itineraries; @endphp
            
            @if(count($itineraries) == 0)
                <p id="empty-itinerary-msg" class="text-sm text-blue-500 italic text-center py-4">No days added yet. Click "Add Day to Itinerary" to start building!</p>
            @endif

            <!-- Existing Pre-Filled Days -->
            @foreach($itineraries as $index => $itin)
                @php $safeIndex = 'old_'. $index; @endphp
                <div class="bg-white border text-sm border-blue-200 rounded-lg p-4 shadow-sm relative itinerary-block transition-all" id="itin-block-{{ $safeIndex }}">
                    <button type="button" class="absolute top-4 right-4 text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded remove-day-btn" title="Remove Day">
                        <i class="fas fa-trash"></i>
                    </button>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-blue-600 text-white font-bold w-8 h-8 rounded-full flex items-center justify-center day-number-badge">
                            {{ $loop->iteration }}
                        </div>
                        <h4 class="font-bold text-gray-700 text-lg">Day Details</h4>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Day Title *</label>
                            <!-- Use exact array syntax so controller ingests it clean -->
                            <input type="text" name="itineraries[{{ $safeIndex }}][title]" value="{{ is_array($itin) ? ($itin['title'] ?? '') : $itin->title }}" required class="w-full md:w-3/4 px-3 py-2 bg-gray-50 border border-gray-200 rounded outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Replace Destination Image</label>
                                <input type="file" name="itineraries[{{ $safeIndex }}][image]" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            </div>
                            <div>
                                @php $currentImage = is_array($itin) ? ($itin['existing_image_url'] ?? '') : $itin->image_url; @endphp
                                @if($currentImage)
                                    <div class="text-xs text-gray-500 italic">Current image: <img src="{{ $currentImage }}" class="h-12 w-16 object-cover inline ml-2 rounded border"></div>
                                    <input type="hidden" name="itineraries[{{ $safeIndex }}][existing_image_url]" value="{{ $currentImage }}">
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Activities & Description</label>
                            <textarea name="itineraries[{{ $safeIndex }}][description]" rows="3" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded outline-none focus:ring-1 focus:ring-blue-500 text-sm">{{ is_array($itin) ? ($itin['description'] ?? '') : $itin->description }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- PANEL: SEO Optimizations -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-bold text-blue-600 uppercase tracking-wider mb-4 border-b pb-2"><i class="fas fa-search mr-2"></i> SEO Optimizations</h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">SEO Meta Title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $package->seo_title) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">SEO Meta Description</label>
                <textarea name="seo_description" rows="2" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">{{ old('seo_description', $package->seo_description) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">SEO Keywords</label>
                <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $package->seo_keywords) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:bg-white focus:ring-2 focus:ring-blue-600 outline-none transition text-sm">
            </div>
        </div>
    </div>

    <!-- Big Save Button -->
    <button type="submit" class="w-full py-4 bg-cyan-500 hover:bg-cyan-600 text-white font-bold text-lg rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
        <i class="fas fa-check-circle mr-2"></i> Update Tour Details
    </button>
</form>
@endsection

@stack('scripts')
@push('scripts')
<!-- TinyMCE Script (Self-hosted Open Source version from CDNJS to bypass API key) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '.rich-editor',
        height: 250,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
        'bold italic underline | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'link image code | removeformat',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        promotion: false
    });
</script>

<!-- Dynamic Vanilla JS Itinerary Builder Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('itinerary-container');
        const addBtn = document.getElementById('add-day-btn');
        const emptyMsg = document.getElementById('empty-itinerary-msg');
        
        let dayCounter = container.querySelectorAll('.itinerary-block').length;

        function addDayBlock() {
            dayCounter++;
            if(emptyMsg) emptyMsg.style.display = 'none';

            const idx = Date.now() + Math.floor(Math.random() * 100);

            const blockHTML = `
                <div class="bg-white border text-sm border-blue-200 rounded-lg p-4 shadow-sm relative itinerary-block transition-all" id="itin-block-${idx}">
                    <button type="button" class="absolute top-4 right-4 text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded remove-day-btn" title="Remove Day">
                        <i class="fas fa-trash"></i>
                    </button>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-blue-600 text-white font-bold w-8 h-8 rounded-full flex items-center justify-center day-number-badge">
                            ${dayCounter}
                        </div>
                        <h4 class="font-bold text-gray-700 text-lg">Day Details</h4>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Day Title (e.g. Arrival in Colombo) *</label>
                            <input type="text" name="itineraries[${idx}][title]" required class="w-full md:w-3/4 px-3 py-2 bg-gray-50 border border-gray-200 rounded outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Day Destination Image</label>
                            <input type="file" name="itineraries[${idx}][image]" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Activities & Description</label>
                            <textarea name="itineraries[${idx}][description]" rows="3" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded outline-none focus:ring-1 focus:ring-blue-500 text-sm" placeholder="Write what happens on this day..."></textarea>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', blockHTML);
            updateDayBadges();
        }

        function updateDayBadges() {
            const badges = container.querySelectorAll('.day-number-badge');
            badges.forEach((badge, index) => {
                badge.innerText = index + 1;
            });
            dayCounter = badges.length;
            
            if(dayCounter === 0 && emptyMsg) {
                emptyMsg.style.display = 'block';
            }
        }

        addBtn.addEventListener('click', addDayBlock);

        container.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-day-btn');
            if(removeBtn) {
                if(confirm('Delete this day from the itinerary?')) {
                    removeBtn.closest('.itinerary-block').remove();
                    updateDayBadges();
                }
            }
        });
    });
</script>
@endpush
