@extends('admin.layouts.app')
@section('title', 'Partners')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Travel Partners</h2>
    <a href="{{ route('partners.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add Partner
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
                <th class="p-4 font-semibold w-20">Logo</th>
                <th class="p-4 font-semibold">Partner Name & Description</th>
                <th class="p-4 font-semibold">Order</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($partners as $partner)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    @if($partner->getRawOriginal('logo_image'))
                        <img src="{{ url($partner->getRawOriginal('logo_image')) }}" alt="{{ $partner->name }}" class="h-10 w-auto max-w-[80px] object-contain"/>
                    @else
                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                            <i class="fas fa-handshake text-xl"></i>
                        </div>
                    @endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $partner->name }}</div>
                    @if($partner->profile_link)
                        <a href="{{ $partner->profile_link }}" target="_blank" class="text-xs text-blue-500 hover:underline">{{ $partner->profile_link }}</a>
                    @endif
                    <div class="text-xs text-gray-500 line-clamp-1 mt-1">{{ $partner->description }}</div>
                </td>
                <td class="p-4 text-sm text-gray-600">{{ $partner->display_order }}</td>
                <td class="p-4">
                    @if($partner->active)
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded">Active</span>
                    @else
                        <span class="px-2 py-1 bg-red-100 text-red-700 text-[10px] font-bold rounded">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2">
                    <a href="{{ route('partners.edit', $partner->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Delete this partner?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">No partners found. Add your first one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
