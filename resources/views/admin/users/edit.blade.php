@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
            <p class="text-gray-600 mt-1">Update user information and permissions</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Users
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Full Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="name" 
                   id="name" 
                   value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent @error('name') border-red-500 @enderror"
                   required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email Address <span class="text-red-500">*</span>
            </label>
            <input type="email" 
                   name="email" 
                   id="email" 
                   value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent @error('email') border-red-500 @enderror"
                   required>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                New Password <span class="text-gray-500">(leave blank to keep current)</span>
            </label>
            <input type="password" 
                   name="password" 
                   id="password" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent @error('password') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Confirmation -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                Confirm New Password
            </label>
            <input type="password" 
                   name="password_confirmation" 
                   id="password_confirmation" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent">
        </div>

        <!-- Role -->
        <div class="mb-6">
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                Role <span class="text-red-500">*</span>
            </label>
            <select name="role" 
                    id="role" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent @error('role') border-red-500 @enderror"
                    required>
                <option value="">Select Role</option>
                <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="content_editor" {{ old('role', $user->role) == 'content_editor' ? 'selected' : '' }}>Content Editor</option>
            </select>
            <p class="mt-1 text-xs text-gray-500">
                <strong>Super Admin:</strong> Full system access | 
                <strong>Admin:</strong> Manage content & users | 
                <strong>Content Editor:</strong> Create & edit content only
            </p>
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Active Status -->
        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       value="1" 
                       {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Active Account</span>
            </label>
            <p class="mt-1 text-xs text-gray-500">Inactive accounts cannot log in</p>
        </div>

        <!-- User Info -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <h3 class="text-sm font-medium text-gray-700 mb-2">User Information</h3>
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-gray-500">Created:</span>
                    <span class="text-gray-900 font-medium">{{ $user->created_at->format('M d, Y h:i A') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Last Updated:</span>
                    <span class="text-gray-900 font-medium">{{ $user->updated_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <div>
                @if($user->id !== auth()->id())
                <button type="button" 
                        onclick="if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }"
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium text-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete User
                </button>
                @else
                <span class="text-sm text-gray-500 italic">You cannot delete your own account</span>
                @endif
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gold-600 text-white rounded-lg hover:bg-gold-700 font-medium text-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update User
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Delete Form -->
@if($user->id !== auth()->id())
<form id="delete-form-{{ $user->id }}" 
      action="{{ route('admin.users.destroy', $user) }}" 
      method="POST" 
      class="hidden">
    @csrf
    @method('DELETE')
</form>
@endif

<!-- Warning Box -->
@if($user->id === auth()->id())
<div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
    <div class="flex items-start">
        <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-yellow-900">Editing Your Own Account</h3>
            <p class="text-xs text-yellow-700 mt-1">Be careful when changing your own role or active status. Changes take effect immediately and may affect your access.</p>
        </div>
    </div>
</div>
@endif
@endsection
