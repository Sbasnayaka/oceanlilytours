@extends('admin.layouts.app')

@section('title', 'View Inquiry')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">
        Inquiry from {{ $inquiry->name }}
    </h2>
    <a href="{{ route('inquiries.index') }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to Inbox
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-100 flex items-center">
    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Message Panel -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <h3 class="text-xl font-bold text-gray-800">{{ $inquiry->subject }}</h3>
                <p class="text-sm text-gray-500 mt-1">Received on {{ $inquiry->created_at->format('M d, Y') }} at {{ $inquiry->created_at->format('h:i A') }}</p>
            </div>
            
            <form action="{{ route('inquiries.update', $inquiry->id) }}" method="POST" class="flex gap-2">
                @csrf
                @method('PUT')
                <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 outline-none w-32 bg-white cursor-pointer hover:bg-gray-50">
                    <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New</option>
                    <option value="read" {{ $inquiry->status === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ $inquiry->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="archived" {{ $inquiry->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </form>
        </div>
        
        <div class="p-8">
            <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $inquiry->message }}</p>
        </div>
    </div>

    <!-- Contact Info Panel -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 h-fit">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Sender Details</h3>
        </div>
        
        <div class="p-6 space-y-4">
            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Name</p>
                <p class="text-gray-800 font-medium flex items-center gap-2">
                    <i class="fas fa-user text-gray-400"></i> {{ $inquiry->name }}
                </p>
            </div>
            
            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Email Address</p>
                <p class="text-gray-800 font-medium flex items-center gap-2">
                    <i class="fas fa-envelope text-gray-400"></i>
                    <a href="mailto:{{ $inquiry->email }}" class="text-blue-600 hover:underline">{{ $inquiry->email }}</a>
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Phone Number</p>
                <p class="text-gray-800 font-medium flex items-center gap-2">
                    <i class="fas fa-phone text-gray-400"></i>
                    @if($inquiry->phone)
                        <a href="tel:{{ $inquiry->phone }}" class="text-blue-600 hover:underline">{{ $inquiry->phone }}</a>
                    @else
                        <span class="text-gray-400 italic">Not provided</span>
                    @endif
                </p>
            </div>
            
            <hr class="border-gray-100 my-4">
            
            <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->subject) }}" target="_blank" class="w-full text-center block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition shadow-sm font-medium">
                <i class="fas fa-reply mr-2"></i> Reply directly via Email
            </a>
        </div>
    </div>
</div>
@endsection
