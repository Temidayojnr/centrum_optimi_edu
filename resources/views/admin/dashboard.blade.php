@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Donations -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium mb-1">Total Donations</p>
                <p class="text-3xl font-bold">₦{{ number_format($stats['total_donations'], 2) }}</p>
                <p class="text-green-100 text-xs mt-2">{{ $stats['donations_count'] }} donations</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Programs -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Active Programs</p>
                <p class="text-3xl font-bold">{{ $stats['programs_count'] }}</p>
                <p class="text-blue-100 text-xs mt-2">Running programs</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Volunteers -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium mb-1">Volunteers</p>
                <p class="text-3xl font-bold">{{ $stats['volunteers_count'] }}</p>
                <p class="text-purple-100 text-xs mt-2">Applications received</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="bg-gradient-to-br from-gold-500 to-gold-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gold-100 text-sm font-medium mb-1">Blog Posts</p>
                <p class="text-3xl font-bold">{{ $stats['posts_count'] }}</p>
                <p class="text-gold-100 text-xs mt-2">Published articles</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Recent Donations -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 border-b">
            <h3 class="text-lg font-bold text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Recent Donations
            </h3>
        </div>
        <div class="p-6">
            @if($recentDonations->count() > 0)
            <div class="space-y-4">
                @foreach($recentDonations as $donation)
                <div class="flex items-center justify-between pb-3 border-b last:border-0">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ $donation->donor_name }}</p>
                        <p class="text-sm text-gray-600">{{ $donation->donor_email }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $donation->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-bold text-green-600">₦{{ number_format($donation->amount, 2) }}</span>
                        @if($donation->program)
                        <p class="text-xs text-gray-500">{{ $donation->program->title }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.donations.index') }}" class="block mt-4 text-center text-green-600 hover:text-green-700 font-medium">
                View All Donations →
            </a>
            @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-500 mt-2">No donations yet</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Recent Volunteers -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-700 border-b">
            <h3 class="text-lg font-bold text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Recent Volunteer Applications
            </h3>
        </div>
        <div class="p-6">
            @if($recentVolunteers->count() > 0)
            <div class="space-y-4">
                @foreach($recentVolunteers as $volunteer)
                <div class="flex items-center justify-between pb-3 border-b last:border-0">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ $volunteer->name }}</p>
                        <p class="text-sm text-gray-600">{{ $volunteer->email }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $volunteer->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $volunteer->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($volunteer->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($volunteer->status) }}
                    </span>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.volunteers.index') }}" class="block mt-4 text-center text-purple-600 hover:text-purple-700 font-medium">
                View All Applications →
            </a>
            @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-500 mt-2">No volunteer applications yet</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Contact Messages -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gold-600 to-gold-700 border-b">
        <h3 class="text-lg font-bold text-white flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Recent Contact Messages
        </h3>
    </div>
    <div class="p-6">
        @if($recentContacts->count() > 0)
        <div class="space-y-4">
            @foreach($recentContacts as $contact)
            <div class="pb-4 border-b last:border-0">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $contact->name }}</p>
                        <p class="text-sm text-gray-600">{{ $contact->email }}</p>
                    </div>
                    <span class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-gray-700 line-clamp-2">{{ $contact->message }}</p>
            </div>
            @endforeach
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="block mt-4 text-center text-gold-600 hover:text-gold-700 font-medium">
            View All Messages →
        </a>
        @else
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-500 mt-2">No contact messages yet</p>
        </div>
        @endif
    </div>
</div>
@endsection
