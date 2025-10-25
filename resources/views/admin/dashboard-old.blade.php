@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        <img src="{{ asset('logos/centrum..1.jpg') }}" alt="Logo" class="h-10 w-auto">
                        <span class="ml-3 text-xl font-bold text-gray-800">Admin Panel</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" target="_blank" class="text-gray-600 hover:text-gold-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg min-h-screen sticky top-16">
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 bg-gold-50 border-r-4 border-gold-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.programs.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Programs
                </a>
                
                <a href="{{ route('admin.donations.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Donations
                </a>
                
                <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Volunteers
                </a>
                
                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Blog Posts
                </a>
                
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Gallery
                </a>
                
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Contact Messages
                </a>
                
                @if(auth()->user()->role === 'super_admin')
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gold-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Users
                </a>
                @endif
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Donations -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Donations</p>
                            <p class="text-3xl font-bold text-gray-800">₦{{ number_format($stats['total_donations'], 2) }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $stats['donations_count'] }} donations</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Programs -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Active Programs</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['programs_count'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">Running programs</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Volunteers -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Volunteers</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['volunteers_count'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">Applications received</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Blog Posts -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-gold-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Blog Posts</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['posts_count'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">Published articles</p>
                        </div>
                        <div class="bg-gold-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Donations -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white">
                        <h3 class="text-lg font-bold">Recent Donations</h3>
                    </div>
                    <div class="p-6">
                        @if($recentDonations->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentDonations as $donation)
                            <div class="flex items-center justify-between border-b pb-3">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $donation->donor_name }}</p>
                                    <p class="text-sm text-gray-600">{{ $donation->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-green-600 font-bold">₦{{ number_format($donation->amount, 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('admin.donations.index') }}" class="block mt-4 text-center text-gold-600 hover:text-gold-700 font-medium">
                            View All →
                        </a>
                        @else
                        <p class="text-gray-500 text-center py-4">No donations yet</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Volunteers -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white">
                        <h3 class="text-lg font-bold">Recent Volunteer Applications</h3>
                    </div>
                    <div class="p-6">
                        @if($recentVolunteers->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentVolunteers as $volunteer)
                            <div class="flex items-center justify-between border-b pb-3">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $volunteer->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $volunteer->email }}</p>
                                    <p class="text-xs text-gray-500">{{ $volunteer->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs rounded-full {{ $volunteer->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($volunteer->status) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('admin.volunteers.index') }}" class="block mt-4 text-center text-gold-600 hover:text-gold-700 font-medium">
                            View All →
                        </a>
                        @else
                        <p class="text-gray-500 text-center py-4">No volunteer applications yet</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Messages -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
                <div class="px-6 py-4 bg-gradient-to-r from-gold-600 to-gold-700 text-white">
                    <h3 class="text-lg font-bold">Recent Contact Messages</h3>
                </div>
                <div class="p-6">
                    @if($recentContacts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentContacts as $contact)
                        <div class="border-b pb-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <p class="font-semibold text-gray-800">{{ $contact->name }}</p>
                                        <span class="text-sm text-gray-600">{{ $contact->email }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-2">{{ Str::limit($contact->message, 100) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $contact->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="block mt-4 text-center text-gold-600 hover:text-gold-700 font-medium">
                        View All →
                    </a>
                    @else
                    <p class="text-gray-500 text-center py-4">No contact messages yet</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
