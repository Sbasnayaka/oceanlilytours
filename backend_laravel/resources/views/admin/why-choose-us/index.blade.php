@extends('admin.layouts.app')
@section('title', 'Why Choose Us')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Why Choose Us Features</h2>
    <a href="{{ route('why-choose-us.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add Feature
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
                <th class="p-4 font-semibold w-24 text-center">Icon</th>
                <th class="p-4 font-semibold">Title & Description</th>
                <th class="p-4 font-semibold w-24">Order</th>
                <th class="p-4 font-semibold w-24 text-center">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($features as $feature)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto" 
                         style="background-color: {{ $feature->icon_bg_color ?: '#EFF6FF' }}; color: {{ $feature->icon_text_color ?: '#1E40AF' }};">
                        <span class="material-symbols-outlined">{{ $feature->icon_class ?: 'verified_user' }}</span>
                    </div>
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $feature->title }}</div>
                    <div class="text-xs text-gray-500 line-clamp-1 mt-1">{{ $feature->description }}</div>
                </td>
                <td class="p-4 text-center font-bold text-gray-600">{{ $feature->display_order }}</td>
                <td class="p-4 text-center">
                    @if($feature->active)
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase">Active</span>
                    @else
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded uppercase">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2 mt-2">
                    <a href="{{ route('why-choose-us.edit', $feature->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('why-choose-us.destroy', $feature->id) }}" method="POST" onsubmit="return confirm('Delete this feature?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">No features found. Add your first one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
