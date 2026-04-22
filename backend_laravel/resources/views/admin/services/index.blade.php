@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Premium Services</h2>
    <a href="{{ route('services.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add Service
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
                <th class="p-4 font-semibold w-16">Icon</th>
                <th class="p-4 font-semibold">Service Name & Description</th>
                <th class="p-4 font-semibold">Order</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($services as $service)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4 text-center">
                    @if($service->icon)
                        <span class="material-symbols-outlined text-2xl text-blue-600">{{ $service->icon }}</span>
                    @else
                        <span class="material-symbols-outlined text-2xl text-gray-300">volunteer_activism</span>
                    @endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $service->title }}</div>
                    <div class="text-xs text-gray-500 line-clamp-1 mt-1">{{ $service->description }}</div>
                </td>
                <td class="p-4">
                    <div class="text-sm font-bold text-gray-800">{{ $service->display_order }}</div>
                </td>
                <td class="p-4">
                    @if($service->active)
                        <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded w-max">Active</span>
                    @else
                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-[10px] font-bold rounded w-max">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2 text-right">
                    <a href="{{ route('services.edit', $service->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">No services found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
