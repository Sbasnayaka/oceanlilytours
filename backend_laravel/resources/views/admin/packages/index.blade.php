@extends('admin.layouts.app')

@section('title', 'Tour Packages')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Tour Packages</h2>
    <a href="{{ route('packages.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add New Package
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
                <th class="p-4 font-semibold">Package Image</th>
                <th class="p-4 font-semibold">Name & Category</th>
                <th class="p-4 font-semibold">Duration/Price</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($packages as $package)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    @if($package->image_url)
                        <img src="{{ $package->image_url }}" alt="Package Image" class="w-16 h-12 object-cover rounded-lg shadow-sm">
                    @else
                        <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $package->name }}</div>
                    <div class="text-xs text-blue-600 font-medium">{{ $package->category ? $package->category->name : 'Uncategorized' }}</div>
                </td>
                <td class="p-4">
                    <div class="text-sm text-gray-800 font-bold">${{ number_format($package->price, 2) }}</div>
                    <div class="text-xs text-gray-500">{{ $package->duration_days }} Days</div>
                </td>
                <td class="p-4 space-y-1">
                    @if($package->active)
                        <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded w-max">Active</span>
                    @else
                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-[10px] font-bold rounded w-max">Hidden</span>
                    @endif
                    
                    @if($package->featured)
                        <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 text-[10px] font-bold rounded w-max"><i class="fas fa-star mr-1"></i> Featured</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2 text-right">
                    <a href="{{ route('packages.edit', $package->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to completely delete this package?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">No packages found. Click 'Add New Package' to create one.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
