@extends('admin.layouts.app')

@section('title', 'Volunteer Details - ' . $volunteer->first_name . ' ' . $volunteer->last_name)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.volunteers.index') }}" class="text-gold-600 hover:text-gold-700 mb-2 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Volunteers
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Volunteer Application</h1>
            <p class="text-gray-600 mt-2">Review and manage volunteer application</p>
        </div>
        <div>
            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ 
                $volunteer->status === 'approved' ? 'bg-green-100 text-green-800' : 
                ($volunteer->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
            }}">
                {{ ucfirst($volunteer->status) }}
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Personal Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Personal Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">First Name</label>
                    <p class="text-gray-900 font-medium">{{ $volunteer->first_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Last Name</label>
                    <p class="text-gray-900 font-medium">{{ $volunteer->last_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $volunteer->email }}" class="text-gold-600 hover:text-gold-700">
                            {{ $volunteer->email }}
                        </a>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $volunteer->phone }}" class="text-gold-600 hover:text-gold-700">
                            {{ $volunteer->phone }}
                        </a>
                    </p>
                </div>
                @if($volunteer->occupation)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Occupation</label>
                    <p class="text-gray-900">{{ $volunteer->occupation }}</p>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Availability</label>
                    <p class="text-gray-900">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ ucfirst($volunteer->availability) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        @if($volunteer->address || $volunteer->city || $volunteer->state)
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Address Information
            </h2>
            <div class="space-y-3">
                @if($volunteer->address)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Address</label>
                    <p class="text-gray-900">{{ $volunteer->address }}</p>
                </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($volunteer->city)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">City</label>
                        <p class="text-gray-900">{{ $volunteer->city }}</p>
                    </div>
                    @endif
                    @if($volunteer->state)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">State</label>
                        <p class="text-gray-900">{{ $volunteer->state }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Skills & Experience -->
        @if($volunteer->skills)
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Skills & Experience
            </h2>
            <p class="text-gray-900 whitespace-pre-line">{{ $volunteer->skills }}</p>
        </div>
        @endif

        <!-- Why Volunteer -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                Why They Want to Volunteer
            </h2>
            <p class="text-gray-900 whitespace-pre-line">{{ $volunteer->why_volunteer }}</p>
        </div>

        <!-- Admin Notes -->
        @if($volunteer->admin_notes)
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <h2 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Admin Notes
            </h2>
            <p class="text-blue-900 whitespace-pre-line">{{ $volunteer->admin_notes }}</p>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Application Info -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Application Info</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ 
                        $volunteer->status === 'approved' ? 'bg-green-100 text-green-800' : 
                        ($volunteer->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                    }}">
                        {{ ucfirst($volunteer->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Submitted</label>
                    <p class="text-gray-900 text-sm">{{ $volunteer->created_at->format('M d, Y') }}</p>
                    <p class="text-gray-500 text-xs">{{ $volunteer->created_at->diffForHumans() }}</p>
                </div>
                @if($volunteer->updated_at != $volunteer->created_at)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                    <p class="text-gray-900 text-sm">{{ $volunteer->updated_at->format('M d, Y') }}</p>
                    <p class="text-gray-500 text-xs">{{ $volunteer->updated_at->diffForHumans() }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Update Status</h3>
            <form action="{{ route('admin.volunteers.updateStatus', $volunteer) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('status') border-red-500 @enderror">
                        <option value="pending" {{ $volunteer->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $volunteer->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $volunteer->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                    <textarea name="admin_notes" 
                              id="admin_notes" 
                              rows="4"
                              placeholder="Add notes about this application..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('admin_notes') border-red-500 @enderror">{{ old('admin_notes', $volunteer->admin_notes) }}</textarea>
                    @error('admin_notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold">
                    Update Status
                </button>
            </form>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="mailto:{{ $volunteer->email }}" 
                   class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Send Email
                </a>
                <a href="tel:{{ $volunteer->phone }}" 
                   class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Volunteer
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
