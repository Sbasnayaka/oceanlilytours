@extends('admin.layouts.app')

@section('title', 'System Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome back, Admin!</h2>
    <p class="text-sm text-gray-500">Here is a quick summary of your system's current state.</p>
</div>

<!-- Key Metrics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
    <!-- Stat Card -->
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="text-blue-600 text-xl"><i class="fas fa-suitcase"></i></div>
        <div>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Packages</p>
            <p class="text-2xl font-black text-gray-800">{{ $metrics['packages'] ?? 0 }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-purple-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="text-purple-600 text-xl"><i class="fas fa-envelope-open-text"></i></div>
        <div>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Inquiries</p>
            <p class="text-2xl font-black text-gray-800">{{ $metrics['inquiries'] ?? 0 }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="text-green-600 text-xl"><i class="fas fa-blog"></i></div>
        <div>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Blog Posts</p>
            <p class="text-2xl font-black text-gray-800">{{ $metrics['blogs'] ?? 0 }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-yellow-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="text-yellow-500 text-xl"><i class="fas fa-star"></i></div>
        <div>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Reviews</p>
            <p class="text-2xl font-black text-gray-800">{{ $metrics['testimonials'] ?? 0 }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-pink-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="text-pink-500 text-xl"><i class="fas fa-images"></i></div>
        <div>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Hero Slides</p>
            <p class="text-2xl font-black text-gray-800">{{ $metrics['hero_slides'] ?? 0 }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="text-indigo-600 text-xl"><i class="fas fa-search"></i></div>
        <div>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">SEO Pages</p>
            <p class="text-2xl font-black text-gray-800">{{ $metrics['seo_pages'] ?? 0 }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Actions Timeline -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 lg:col-span-2">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-xl">
            <h3 class="text-base font-bold text-gray-800"><i class="fas fa-bolt text-yellow-500 mr-2"></i>Recent Activity</h3>
            <a href="{{ route('inquiries.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase tracking-wider">View Inquiries</a>
        </div>
        <div class="p-6">
            @if(isset($recentActions) && $recentActions->count() > 0)
                <div class="relative border-l-2 border-gray-100 ml-3 space-y-6">
                    @foreach($recentActions as $action)
                    <div class="relative pl-6">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 bg-white border-2 border-{{ $action->color }}-100 rounded-full flex items-center justify-center text-{{ $action->color }}-500 text-xs shadow-sm">
                            <i class="fas {{ $action->icon }}"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $action->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $action->description }}</p>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-2 block">{{ $action->time }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-gray-300 mb-3 text-2xl">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <p class="text-sm text-gray-500">No recent activity found.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- System Status -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-5 border-b border-gray-100 bg-gray-50/50 rounded-t-xl">
            <h3 class="text-base font-bold text-gray-800"><i class="fas fa-server text-gray-400 mr-2"></i>System Status</h3>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-green-50 text-green-500 flex items-center justify-center"><i class="fas fa-database"></i></div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Database</p>
                        <p class="text-xs text-gray-400">Connection Active</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Online</span>
            </div>
            
            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-blue-50 text-blue-500 flex items-center justify-center"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Admin Guard</p>
                        <p class="text-xs text-gray-400">Auth Middleware</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Active</span>
            </div>

            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-purple-50 text-purple-500 flex items-center justify-center"><i class="fas fa-globe"></i></div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">API Status</p>
                        <p class="text-xs text-gray-400">Frontend Bridge</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-purple-100 text-purple-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Ready</span>
            </div>
        </div>
    </div>
</div>
@endsection
