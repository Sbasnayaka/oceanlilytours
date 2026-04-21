@extends('admin.layouts.app')

@section('title', 'Manage Booking')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <h2 class="text-2xl font-bold text-gray-800">
            Booking #{{ $booking->booking_reference }}
        </h2>
        @if($booking->status === 'pending')
            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-bold rounded-full">Pending</span>
        @elseif($booking->status === 'confirmed')
            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-bold rounded-full">Confirmed</span>
        @elseif($booking->status === 'completed')
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full">Completed</span>
        @else
            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm font-bold rounded-full">Cancelled</span>
        @endif
    </div>
    <a href="{{ route('bookings.index') }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i> Back
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-100 flex items-center">
    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Package Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                <i class="fas fa-suitcase text-blue-600 text-xl"></i>
                <h3 class="font-bold text-gray-800 text-lg">Tour Package Details</h3>
            </div>
            <div class="p-6">
                <div class="text-xl font-bold text-gray-800 mb-1">{{ $booking->package->name ?? 'Package Not Found' }}</div>
                <div class="text-sm text-blue-600 font-medium mb-6">
                    Duration: {{ $booking->package->duration_days ?? 'N/A' }} Days 
                </div>
                
                <div class="grid grid-cols-2 gap-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Travel Date</p>
                        <p class="text-gray-800 font-bold text-lg"><i class="far fa-calendar-alt text-gray-400 mr-1"></i> {{ \Carbon\Carbon::parse($booking->travel_date)->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Pax (Persons)</p>
                        <p class="text-gray-800 font-bold text-lg"><i class="fas fa-users text-gray-400 mr-1"></i> {{ $booking->number_of_persons }}</p>
                    </div>
                </div>
                
                @if($booking->special_requests)
                <div class="mt-6">
                    <p class="text-xs text-red-500 font-bold uppercase tracking-wider mb-2"><i class="fas fa-exclamation-circle"></i> Special Requests</p>
                    <div class="p-4 bg-red-50 text-red-900 rounded-lg border border-red-100 text-sm whitespace-pre-wrap">{{ $booking->special_requests }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Management Interface -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                <i class="fas fa-sliders-h text-blue-600 text-xl"></i>
                <h3 class="font-bold text-gray-800 text-lg">Booking Management</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                        <select name="status" class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Internal Only)</label>
                        <textarea name="admin_notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition placeholder-gray-400" placeholder="Jot down payment references, confirmation IDs, or internal notes here...">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    </div>
                    
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">
                        Update Booking Record
                    </button>
                    
                    @if($booking->confirmed_at)
                    <p class="text-xs text-gray-400 mt-4">Last confirmed at: {{ \Carbon\Carbon::parse($booking->confirmed_at)->format('M d, Y h:i A') }}</p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Context -->
    <div class="space-y-6">
        <!-- Client Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-bold text-gray-800">Client Details</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Name</p>
                    <p class="text-gray-800 font-medium flex items-center gap-2">
                        <i class="fas fa-user text-gray-400"></i> {{ $booking->customer_name }}
                    </p>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Email Address</p>
                    <p class="text-gray-800 font-medium flex items-center gap-2">
                        <i class="fas fa-envelope text-gray-400"></i>
                        <a href="mailto:{{ $booking->customer_email }}" class="text-blue-600 hover:underline">{{ $booking->customer_email }}</a>
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Phone Number</p>
                    <p class="text-gray-800 font-medium flex items-center gap-2">
                        <i class="fas fa-phone text-gray-400"></i>
                        <a href="tel:{{ $booking->customer_phone }}" class="text-blue-600 hover:underline">{{ $booking->customer_phone }}</a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Payment Details -->
        <div class="bg-gray-800 rounded-xl shadow-sm text-white">
            <div class="p-6 border-b border-gray-700 block">
                <h3 class="font-bold">Financial Summary</h3>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-400">Total Quoted</span>
                    <span class="font-bold text-xl">${{ number_format($booking->total_price, 2) }}</span>
                </div>
                <div class="flex justify-between items-center mb-4 border-b border-gray-700 pb-4">
                    <span class="text-gray-400">Paid Amount</span>
                    <span class="font-bold text-xl text-green-400">${{ number_format($booking->paid_amount, 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-bold">Balance Due</span>
                    <span class="font-bold text-2xl text-red-400">${{ number_format($booking->total_price - $booking->paid_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
