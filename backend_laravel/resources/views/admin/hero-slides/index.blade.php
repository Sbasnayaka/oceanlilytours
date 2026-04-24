@extends('admin.layouts.app')
@section('title', 'Hero Slider')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Homepage Hero Slider</h2>
    <a href="{{ route('hero-slides.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add New Slide
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
                <th class="p-4 font-semibold w-32">Image</th>
                <th class="p-4 font-semibold">Slide Details</th>
                <th class="p-4 font-semibold w-24">Order</th>
                <th class="p-4 font-semibold w-24">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($slides as $slide)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    <img src="{{ $slide->image_url }}" class="w-24 h-16 object-cover rounded-lg border border-gray-200" alt="{{ $slide->title }}">
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $slide->title }}</div>
                    <div class="text-xs text-gray-500 line-clamp-1 mt-1">{{ $slide->description }}</div>
                    @if($slide->button_text)
                        <div class="mt-2 text-[10px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full inline-block font-bold">Button: {{ $slide->button_text }}</div>
                    @endif
                </td>
                <td class="p-4 text-center font-bold text-gray-600">{{ $slide->display_order }}</td>
                <td class="p-4">
                    @if($slide->active)
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase">Active</span>
                    @else
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded uppercase">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2 mt-2">
                    <a href="{{ route('hero-slides.edit', $slide->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('hero-slides.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Delete this slide?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">No slides found. Add your first one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
