@extends('admin.layouts.app')

@section('title', 'System Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl">
            <i class="fas fa-suitcase"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium whitespace-nowrap">Total Packages</p>
            <p class="text-2xl font-bold text-gray-800">{{\App\Models\Package::count()}}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center text-xl">
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium whitespace-nowrap">Inquiries</p>
            <p class="text-2xl font-bold text-gray-800">{{\App\Models\Inquiry::count()}}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-xl">
            <i class="fas fa-blog"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium whitespace-nowrap">Published Posts</p>
            <p class="text-2xl font-bold text-gray-800">{{\App\Models\BlogPost::count()}}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center text-xl">
            <i class="fas fa-star"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium whitespace-nowrap">Testimonials</p>
            <p class="text-2xl font-bold text-gray-800">{{\App\Models\Testimonial::count()}}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Recent Inquiries</h3>
            <a href="#" class="text-sm text-blue-600 hover:underline">View All</a>
        </div>
        <div class="p-6">
            <p class="text-sm text-gray-500">No recent inquiries to display yet.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">System Status</h3>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                <span class="text-sm text-gray-600">Database Connection</span>
                <span class="px-2 py-1 bg-green-50 text-green-700 text-xs font-bold rounded">Connected</span>
            </div>
            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                <span class="text-sm text-gray-600">Active Admin Guard</span>
                <span class="text-sm font-semibold">Active & Shielded</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Asset Directory</span>
                <span class="text-sm font-semibold">/public</span>
            </div>
        </div>
    </div>
</div>
@endsection
