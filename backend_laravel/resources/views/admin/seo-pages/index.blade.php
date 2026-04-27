@extends('admin.layouts.app')
@section('title', 'SEO Manager')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-gray-600">Manage Meta tags, descriptions, and OpenGraph settings for your pages.</p>
    <a href="{{ route('seo-pages.create') }}" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Add New Page SEO
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="p-4 font-semibold text-gray-600">Page Name</th>
                <th class="p-4 font-semibold text-gray-600">Meta Title</th>
                <th class="p-4 font-semibold text-gray-600">Meta Description</th>
                <th class="p-4 font-semibold text-gray-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($seoPages as $page)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800">{{ $page->page_name }}</td>
                    <td class="p-4 text-gray-600 text-sm">{{ \Illuminate\Support\Str::limit($page->meta_title, 40) }}</td>
                    <td class="p-4 text-gray-600 text-sm">{{ \Illuminate\Support\Str::limit($page->meta_description, 50) }}</td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('seo-pages.edit', $page) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('seo-pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this SEO setting?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        No SEO settings found. Click "Add New Page SEO" to create one.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
