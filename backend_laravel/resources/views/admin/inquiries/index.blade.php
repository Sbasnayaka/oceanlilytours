@extends('admin.layouts.app')

@section('title', 'Inquiries')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Inquiries Inbox</h2>
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
                <th class="p-4 font-semibold">Date</th>
                <th class="p-4 font-semibold">Contact Details</th>
                <th class="p-4 font-semibold">Subject</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($inquiries as $inquiry)
            <tr class="hover:bg-gray-50 transition {{ $inquiry->status === 'new' ? 'bg-blue-50/30' : '' }}">
                <td class="p-4 text-sm text-gray-600 whitespace-nowrap">
                    {{ $inquiry->created_at->format('M d, Y') }}<br>
                    <span class="text-xs text-gray-400">{{ $inquiry->created_at->format('h:i A') }}</span>
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $inquiry->name }}</div>
                    <div class="text-xs text-gray-500">{{ $inquiry->email }}</div>
                </td>
                <td class="p-4">
                    <div class="font-medium text-gray-800 truncate max-w-xs">{{ $inquiry->subject }}</div>
                </td>
                <td class="p-4">
                    @if($inquiry->status === 'new')
                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full border border-red-200">New</span>
                    @elseif($inquiry->status === 'read')
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Read</span>
                    @elseif($inquiry->status === 'replied')
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Replied</span>
                    @else
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">Archived</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2">
                    <a href="{{ route('inquiries.show', $inquiry->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="View Message">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to completely delete this inquiry?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4 text-gray-300 block"></i>
                    No inquiries received yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
