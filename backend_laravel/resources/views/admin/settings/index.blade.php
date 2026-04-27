@extends('admin.layouts.app')
@section('title', 'System Settings')

@section('content')
<div class="mb-6 flex justify-between items-center flex-wrap gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">System Configuration</h2>
        <p class="text-sm text-gray-500">Manage your site identity and maintenance mode.</p>
    </div>
    <form action="{{ route('settings.cache.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to purge the server cache? This might take a few seconds.');">
        @csrf
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition flex items-center gap-2">
            <i class="fas fa-sync-alt"></i> Purge Cache
        </button>
        <p class="text-[10px] text-gray-400 mt-1 max-w-[200px] leading-tight text-right">Click this if recent changes aren't showing up. It clears the server's temporary memory.</p>
    </form>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-100 flex items-center">
    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
    <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-5xl" x-data="{ tab: 'identity' }">
        <!-- Tabs -->
        <div class="flex border-b border-gray-200">
            <button type="button" @click="tab = 'identity'" :class="{'border-b-2 border-primary text-primary font-bold': tab === 'identity', 'text-gray-500 hover:text-gray-700': tab !== 'identity'}" class="px-6 py-4 text-sm font-medium transition-colors">
                <i class="fas fa-id-card mr-2"></i> Site Identity
            </button>
            <button type="button" @click="tab = 'maintenance'" :class="{'border-b-2 border-primary text-primary font-bold': tab === 'maintenance', 'text-gray-500 hover:text-gray-700': tab !== 'maintenance'}" class="px-6 py-4 text-sm font-medium transition-colors">
                <i class="fas fa-tools mr-2"></i> Maintenance & Coming Soon
            </button>
        </div>

        <!-- Site Identity Tab -->
        <div x-show="tab === 'identity'" class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Site Title</label>
                    <input type="text" name="settings[site_title]" value="{{ $settings['site_title']->value ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Footer Copyright Text</label>
                    <input type="text" name="settings[footer_copyright_text]" value="{{ $settings['footer_copyright_text']->value ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Site Main Logo</label>
                    @if(isset($settings['site_logo']) && $settings['site_logo']->value)
                        <div class="mb-2 p-2 bg-gray-100 rounded inline-block">
                            <img src="{{ $settings['site_logo']->value }}" class="h-12 object-contain" alt="Logo">
                        </div>
                    @endif
                    <input type="file" name="files[site_logo]" accept="image/*" class="w-full border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Recommended format: Transparent PNG. Used in Header.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Site Favicon</label>
                    @if(isset($settings['site_favicon']) && $settings['site_favicon']->value)
                        <div class="mb-2 p-2 bg-gray-100 rounded inline-block">
                            <img src="{{ $settings['site_favicon']->value }}" class="h-8 w-8 object-contain" alt="Favicon">
                        </div>
                    @endif
                    <input type="file" name="files[site_favicon]" accept=".png,.ico,.jpg,.jpeg" class="w-full border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Browser tab icon.</p>
                </div>
            </div>
        </div>

        <!-- Maintenance Mode Tab -->
        <div x-show="tab === 'maintenance'" class="p-6 space-y-6" style="display: none;">
            <div class="flex items-center justify-between p-4 bg-amber-50 rounded-lg border border-amber-200">
                <div>
                    <h4 class="font-bold text-amber-800">Enable Maintenance Mode</h4>
                    <p class="text-sm text-amber-700">When ON, visitors will be redirected to the "Coming Soon" page.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="settings[maintenance_mode]" value="1" class="sr-only peer" {{ (isset($settings['maintenance_mode']) && $settings['maintenance_mode']->value == '1') ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Page Title</label>
                    <input type="text" name="settings[maintenance_title]" value="{{ $settings['maintenance_title']->value ?? 'Something Exciting is Coming!' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Expected Launch Date</label>
                    <input type="date" name="settings[maintenance_date]" value="{{ $settings['maintenance_date']->value ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                    <p class="text-xs text-gray-500 mt-1">This will show a countdown on the coming soon page (if date is in future).</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Coming Soon Message</label>
                <textarea name="settings[maintenance_message]" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">{{ $settings['maintenance_message']->value ?? 'We are currently working hard to bring you the best experience of Sri Lankan travel. Stay tuned!' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Background Image URL</label>
                @if(isset($settings['maintenance_bg']) && $settings['maintenance_bg']->value)
                    <div class="mb-2">
                        <img src="{{ $settings['maintenance_bg']->value }}" class="h-32 object-cover rounded-lg" alt="Maintenance BG">
                    </div>
                @endif
                <input type="file" name="files[maintenance_bg]" accept="image/*" class="w-full border-gray-300 rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Upload a background image for the coming soon page.</p>
            </div>
        </div>

        <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition-all">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </div>
</form>

<!-- Alpine.js for Tabs -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
