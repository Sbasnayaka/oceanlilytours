@extends('admin.layouts.app')
@section('title', 'TripAdvisor Reviews')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">TripAdvisor Reviews</h2>
    <a href="{{ route('tripadvisor.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add Review
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
                <th class="p-4 font-semibold w-16">Photo</th>
                <th class="p-4 font-semibold">Reviewer & Review</th>
                <th class="p-4 font-semibold">Rating</th>
                <th class="p-4 font-semibold">Order</th>
                <th class="p-4 font-semibold">Show</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($reviews as $review)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    @if($review->getRawOriginal('reviewer_image'))
                        <img src="{{ url($review->getRawOriginal('reviewer_image')) }}" alt="{{ $review->reviewer_name }}" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200"/>
                    @else
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-lg">
                            {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                        </div>
                    @endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $review->reviewer_name }}</div>
                    <div class="text-xs text-gray-400">{{ $review->location }} {{ $review->trip_date ? '· ' . \Carbon\Carbon::parse($review->trip_date)->format('M Y') : '' }}</div>
                    @if($review->review_title)
                        <div class="text-xs font-semibold text-gray-600 mt-1">"{{ $review->review_title }}"</div>
                    @endif
                    <div class="text-xs text-gray-500 line-clamp-1 mt-0.5">{{ $review->review_text }}</div>
                </td>
                <td class="p-4">
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-circle text-xs {{ $i <= $review->rating ? 'text-green-500' : 'text-gray-200' }}"></i>
                        @endfor
                    </div>
                </td>
                <td class="p-4 text-sm text-gray-600">{{ $review->display_order }}</td>
                <td class="p-4">
                    @if($review->show_on_homepage)
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded">Visible</span>
                    @else
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-bold rounded">Hidden</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2">
                    @if($review->review_link)
                    <a href="{{ $review->review_link }}" target="_blank" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="View on TripAdvisor">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @endif
                    <a href="{{ route('tripadvisor.edit', $review->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('tripadvisor.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Delete this review?');" class="inline">
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
                <td colspan="6" class="p-8 text-center text-gray-500">No TripAdvisor reviews found. Add your first one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
