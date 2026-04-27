@extends('admin.layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
    <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
        <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center text-2xl font-bold">
            {{ substr($admin->name, 0, 1) }}
        </div>
        <div>
            <h2 class="text-xl font-bold text-gray-800">{{ $admin->name }}</h2>
            <p class="text-gray-500">{{ $admin->email }}</p>
            <span class="inline-block mt-1 px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full capitalize">
                Role: {{ $admin->role }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            {{ session('success') }}
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

    <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Current Password <span class="text-red-500">*</span></label>
            <input type="password" name="current_password" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password <span class="text-red-500">*</span></label>
            <input type="password" name="password" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters long.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password <span class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition">
                Update Password
            </button>
        </div>
    </form>
</div>
@endsection
