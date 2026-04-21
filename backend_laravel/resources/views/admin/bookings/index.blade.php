@extends('admin.layouts.app')

@section('title', 'Tour Bookings')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Tour Bookings</h2>
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
                <th class="p-4 font-semibold">Reference</th>
                <th class="p-4 font-semibold">Client Info</th>
                <th class="p-4 font-semibold">Package & Date</th>
                <th class="p-4 font-semibold">Amount</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($bookings as $booking)
            <tr class="hover:bg-gray-50 transition {{ $booking->status === 'pending' ? 'bg-yellow-50/20' : '' }}">
                <td class="p-4 text-sm font-mono text-blue-600 font-bold">
                    #{{ $booking->booking_reference }}
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $booking->customer_name }}</div>
                    <div class="text-xs text-gray-500">{{ $booking->customer_email }}</div>
                </td>
                <td class="p-4">
                    <div class="text-sm font-medium text-gray-800 truncate max-w-[200px]" title="{{ $booking->package->name ?? 'N/A' }}">
                        {{ $booking->package->name ?? 'Deleted Package' }}
                    </div>
                    <div class="text-xs text-gray-500"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}</div>
                </td>
                <td class="p-4">
                    <div class="text-sm font-bold text-gray-800">${{ number_format($booking->total_price, 2) }}</div>
                    <div class="text-xs text-gray-500">{{ $booking->number_of_persons }} pax</div>
                </td>
                <td class="p-4">
                    @if($booking->status === 'pending')
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full border border-yellow-200">Pending</span>
                    @elseif($booking->status === 'confirmed')
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Confirmed</span>
                    @elseif($booking->status === 'completed')
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Completed</span>
                    @else
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full border border-gray-200">Cancelled</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2">
                    <a href="{{ route('bookings.show', $booking->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Manage Booking">
                        <i class="fas fa-tasks"></i>
                    </a>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to completely delete this booking record?');" class="inline">
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
                <td colspan="6" class="p-8 text-center text-gray-500">
                    <i class="fas fa-calendar-times text-4xl mb-4 text-gray-300 block"></i>
                    No bookings found in the system.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
