<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Ocean Lilly Tours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4ed8',
                        secondary: '#475569',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col h-full overflow-y-auto">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-center">Ocean Lilly</h2>
            <p class="text-xs text-gray-400 text-center mt-1">Admin Portal</p>
        </div>
        
        <nav class="flex-1 px-4 py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gray-800 text-white font-medium">
                <i class="fas fa-home w-5"></i> Dashboard
            </a>
            
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2 px-4">Tours</div>
            <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-suitcase w-5"></i> Packages
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-tags w-5"></i> Categories
            </a>
            <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-calendar-check w-5"></i> Bookings
            </a>
            <a href="{{ route('inquiries.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-envelope-open-text w-5"></i> Inquiries
            </a>

            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2 px-4">Content</div>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-blog w-5"></i> Blog Posts
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-images w-5"></i> Gallery
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-concierge-bell w-5"></i> Services
            </a>

            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2 px-4">Social</div>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-star w-5"></i> Testimonials
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fab fa-tripadvisor w-5"></i> TripAdvisor
            </a>
            
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2 px-4">System</div>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-layer-group w-5"></i> UI Layout
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 rounded-lg text-gray-300">
                <i class="fas fa-cog w-5"></i> Settings
            </a>
        </nav>
        
        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Top Header -->
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-8 z-10">
            <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <a href="/" target="_blank" class="text-sm text-primary font-medium hover:underline"><i class="fas fa-external-link-alt"></i> View Live Site</a>
                <div class="flex items-center gap-2 text-sm text-gray-600 border-l border-gray-200 pl-4">
                    <i class="fas fa-user-circle text-gray-400 text-xl"></i> {{ Auth::guard('admin')->user()->name }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-auto p-8 bg-gray-50">
            @yield('content')
        </div>
    </main>
</body>
</html>
