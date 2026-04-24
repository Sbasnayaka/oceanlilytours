@extends('admin.layouts.app')
@section('title', 'Navbar Items')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Navigation Menu Items</h2>
    <a href="{{ route('navbar-items.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add Menu Item
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
                <th class="p-4 font-semibold">Label & URL</th>
                <th class="p-4 font-semibold">Level</th>
                <th class="p-4 font-semibold w-24">Order</th>
                <th class="p-4 font-semibold w-24">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($items as $item)
            <!-- Parent Row -->
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $item->label }}</div>
                    <div class="text-xs text-blue-500 font-mono">{{ $item->url ?: '#' }}</div>
                </td>
                <td class="p-4"><span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded uppercase">Main Menu</span></td>
                <td class="p-4 text-center font-bold text-gray-600">{{ $item->display_order }}</td>
                <td class="p-4">
                    @if($item->active)
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase">Active</span>
                    @else
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded uppercase">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2 mt-2">
                    <a href="{{ route('navbar-items.edit', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('navbar-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this menu item and its sub-menus?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Children Rows -->
            @foreach($item->children as $child)
            <tr class="bg-gray-50/30 hover:bg-gray-50 transition">
                <td class="p-4 pl-12 border-l-4 border-blue-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-level-up-alt rotate-90 text-gray-300"></i>
                        <div class="font-medium text-gray-700">{{ $child->label }}</div>
                    </div>
                    <div class="text-xs text-blue-400 font-mono pl-6">{{ $child->url ?: '#' }}</div>
                </td>
                <td class="p-4"><span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded uppercase">Dropdown</span></td>
                <td class="p-4 text-center font-medium text-gray-400">{{ $child->display_order }}</td>
                <td class="p-4">
                    @if($child->active)
                        <span class="px-2 py-0.5 bg-green-50 text-green-600 text-[10px] font-bold rounded uppercase">Active</span>
                    @else
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-400 text-[10px] font-bold rounded uppercase">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2 mt-1">
                    <a href="{{ route('navbar-items.edit', $child->id) }}" class="p-1.5 text-blue-500 hover:bg-blue-50 rounded transition">
                        <i class="fas fa-edit text-xs"></i>
                    </a>
                    <form action="{{ route('navbar-items.destroy', $child->id) }}" method="POST" onsubmit="return confirm('Delete sub-menu?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-500">No navigation items found. Add your first one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
