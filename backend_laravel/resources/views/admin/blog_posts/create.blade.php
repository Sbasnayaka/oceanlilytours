@extends('admin.layouts.app')

@section('title', 'Write Blog Post')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('blog-posts.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Write New Blog Post</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-5xl">
    <form action="{{ route('blog-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="md:col-span-2 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Slug (Optional)</label>
                    <input type="text" name="slug" placeholder="Auto-generated if left empty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Excerpt (Short description)</label>
                    <textarea name="excerpt" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Post Content <span class="text-red-500">*</span></label>
                    <textarea name="content" id="rich-editor" class="w-full border border-gray-300 rounded-lg"></textarea>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-3">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="published" value="1" checked class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-bold text-gray-700">Publish immediately</span>
                    </label>
                    
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="featured" value="1" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-bold text-gray-700">Feature this post</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-paper-plane mr-2"></i> Submit Post
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- TinyMCE Rich Text Editor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#rich-editor',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
        'bold italic forecolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | link image | code',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@endpush
