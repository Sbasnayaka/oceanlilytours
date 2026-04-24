@extends('admin.layouts.app')
@section('title', 'System Settings')
@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">System Configuration</h2>
    <p class="text-sm text-gray-500">Global site settings, contact details, and SEO defaults.</p>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-100 flex items-center">
    <i class="fas fa-check-circle mr-2 text-lg"></i> {{ session('success') }}
</div>
@endif

<form action="{{ route('settings.update') }}" method="POST">
    @csrf

    <div class="space-y-8 max-w-5xl">
        @forelse($settings as $category => $items)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                <i class="fas fa-cog text-blue-600"></i>
                <h3 class="font-bold text-gray-800 uppercase tracking-wider text-xs">{{ $category }} Settings</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($items as $setting)
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 tracking-tight">
                        {{ str_replace('_', ' ', $setting->key_name) }}
                    </label>
                    
                    @if($setting->value_type == 'textarea')
                        <textarea name="settings[{{ $setting->key_name }}]" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">{{ $setting->value }}</textarea>
                    @else
                        <input type="text" name="settings[{{ $setting->key_name }}]" value="{{ $setting->value }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="bg-blue-50 text-blue-700 p-8 text-center rounded-xl border border-blue-100">
            <i class="fas fa-info-circle text-2xl mb-2"></i>
            <p>No settings found in the database. Run migrations and seeders to initialize.</p>
        </div>
        @endforelse

        @if($settings->count() > 0)
        <div class="flex justify-end pt-4 pb-12">
            <button type="submit" class="px-10 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg transition-all transform hover:scale-105">
                <i class="fas fa-save mr-2"></i> Save All Settings
            </button>
        </div>
        @endif
    </div>
</form>
@endsection
