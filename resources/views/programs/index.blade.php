@extends('layouts.app')

@section('title', 'Our Programs - Centrum Optimi Educational Foundation')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-gold-600 to-gold-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6">
                Our Programs
            </h1>
            <p class="text-xl md:text-2xl text-gold-100 max-w-3xl mx-auto">
                Empowering communities through education and sustainable development
            </p>
        </div>
    </div>
</div>

<!-- Programs Grid -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($programs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($programs as $program)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <!-- Program Image -->
                <div class="relative h-64 overflow-hidden">
                    @if($program->featured_image)
                    <img src="{{ asset('storage/' . $program->featured_image) }}" 
                         alt="{{ $program->title }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gold-200 to-gold-400 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $program->status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                            {{ ucfirst($program->status) }}
                        </span>
                    </div>
                </div>

                <!-- Program Content -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">
                        {{ $program->title }}
                    </h3>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ strip_tags($program->short_description ?? $program->description) }}
                    </p>

                    <!-- Progress Bar (if goals are set) -->
                    @if($program->target_amount && $program->target_amount > 0)
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Raised: ₦{{ number_format($program->raised_amount ?? 0, 2) }}</span>
                            <span>Goal: ₦{{ number_format($program->target_amount, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            @php
                                $percentage = $program->target_amount > 0 
                                    ? min(100, ($program->raised_amount / $program->target_amount) * 100) 
                                    : 0;
                            @endphp
                            <div class="bg-gold-600 h-2 rounded-full transition-all duration-500" 
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ number_format($percentage, 1) }}% funded</p>
                    </div>
                    @endif

                    <!-- Stats -->
                    @if($program->beneficiaries_count || $program->location)
                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-4 pb-4 border-b">
                        @if($program->beneficiaries_count)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ number_format($program->beneficiaries_count) }} beneficiaries
                        </span>
                        @endif
                        @if($program->location)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $program->location }}
                        </span>
                        @endif
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('programs.show', $program->slug) }}" 
                           class="flex-1 text-center px-4 py-2 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($programs->hasPages())
        <div class="mt-12">
            {{ $programs->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <h3 class="mt-6 text-2xl font-semibold text-gray-900">No programs available</h3>
            <p class="mt-2 text-gray-600">Check back soon for upcoming programs and initiatives.</p>
        </div>
        @endif
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-gold-600 to-gold-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Want to Make a Difference?
        </h2>
        <p class="text-xl text-gold-100 mb-8 max-w-2xl mx-auto">
            Join us in transforming lives through education and empowerment
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('get-involved') }}" class="btn-primary bg-white text-gold-600 hover:bg-gold-50">
                Volunteer With Us
            </a>
        </div>
    </div>
</div>
@endsection
