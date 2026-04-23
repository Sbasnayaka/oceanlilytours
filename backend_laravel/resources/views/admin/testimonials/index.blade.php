@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Guest Testimonials</h2>
    <a href="{{ route('testimonials.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm transition">
        <i class="fas fa-plus mr-2"></i> Add Testimonial
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
                <th class="p-4 font-semibold">Name & Review</th>
                <th class="p-4 font-semibold">Rating</th>
                <th class="p-4 font-semibold">Flags</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($testimonials as $testimonial)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4">
                    @if($testimonial->getRawOriginal('profile_image'))
                        <img src="{{ url($testimonial->getRawOriginal('profile_image')) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200"/>
                    @else
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </div>
                    @endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $testimonial->name }}</div>
                    <div class="text-xs text-gray-400">{{ $testimonial->location }}</div>
                    <div class="text-xs text-gray-500 line-clamp-2 mt-1">{{ $testimonial->review_text }}</div>
                </td>
                <td class="p-4">
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                        @endfor
                    </div>
                </td>
                <td class="p-4 space-y-1">
                    @if($testimonial->featured)
                        <span class="block w-max px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded">Featured</span>
                    @endif
                    @if($testimonial->verified)
                        <span class="block w-max px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded">Verified</span>
                    @endif
                </td>
                <td class="p-4 flex items-center justify-end gap-2">
                    <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');" class="inline">
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
                <td colspan="5" class="p-8 text-center text-gray-500">No testimonials found. Add your first one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
