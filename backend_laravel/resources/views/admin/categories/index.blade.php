@extends('admin.layouts.app')

@section('title', 'Tour Categories')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Tour Categories</h2>
    <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add New Category
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-100 flex items-center">
    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                <th class="p-4 font-semibold">Order</th>
                <th class="p-4 font-semibold">Name & Slug</th>
                <th class="p-4 font-semibold">Icon</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4 text-sm text-gray-600">{{ $category->display_order }}</td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $category->name }}</div>
                    <div class="text-xs text-gray-500">{{ $category->slug }}</div>
                </td>
                <td class="p-4 text-sm text-gray-600">
                    @if($category->icon)
                        <i class="{{ $category->icon }} text-lg text-blue-500"></i>
                    @else
                        -
                    @endif
                </td>
                <td class="p-4">
                    @if($category->active)
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Active</span>
                    @else
                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2">
                    <a href="{{ route('categories.edit', $category->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-500">No categories found. Click 'Add New Category' to create one.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
