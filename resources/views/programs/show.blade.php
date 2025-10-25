@extends('layouts.app')

@section('title', $program->name . ' - Centrum Optimi Educational Foundation')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gray-900">
    <div class="absolute inset-0">
        @if($program->image)
        <img src="{{ asset('storage/' . $program->image) }}" 
             alt="{{ $program->name }}" 
             class="w-full h-full object-cover opacity-60">
        @else
        <div class="w-full h-full bg-gradient-to-br from-gold-600 to-gold-800 opacity-60"></div>
        @endif
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="max-w-4xl">
            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold mb-4 {{ $program->status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                {{ ucfirst($program->status) }}
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                {{ $program->name }}
            </h1>
            @if($program->short_description)
            <p class="text-xl text-gray-200 mb-8">
                {{ $program->short_description }}
            </p>
            @endif
            
            <div class="flex flex-wrap gap-6 text-white">
                @if($program->location)
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $program->location }}</span>
                </div>
                @endif
                @if($program->beneficiaries_count)
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>{{ number_format($program->beneficiaries_count) }} Beneficiaries</span>
                </div>
                @endif
                @if($program->start_date)
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Since {{ \Carbon\Carbon::parse($program->start_date)->format('M Y') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Content Column -->
            <div class="lg:col-span-2">
                <div class="prose prose-lg max-w-none mb-12">
                    {!! $program->description !!}
                </div>

                @if($program->objectives)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Program Objectives</h2>
                    <div class="prose prose-lg max-w-none">
                        {!! $program->objectives !!}
                    </div>
                </div>
                @endif

                <!-- Gallery Section -->
                @if($program->galleryItems && $program->galleryItems->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Program Gallery</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($program->galleryItems->take(6) as $item)
                        <div class="relative h-48 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                            @if($item->image_url)
                            <img src="{{ asset('storage/' . $item->image_url) }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-gold-200 to-gold-300"></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @if($program->galleryItems->count() > 6)
                    <a href="{{ route('gallery') }}" class="inline-block mt-6 text-gold-600 hover:text-gold-700 font-semibold">
                        View All Photos →
                    </a>
                    @endif
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Funding Progress -->
                @if($program->target_amount && $program->target_amount > 0)
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border-2 border-gold-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Funding Progress</h3>
                    
                    <div class="mb-6">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span class="font-semibold">Raised</span>
                            <span class="font-semibold">₦{{ number_format($program->raised_amount ?? 0, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            @php
                                $percentage = $program->target_amount > 0 
                                    ? min(100, ($program->raised_amount / $program->target_amount) * 100) 
                                    : 0;
                            @endphp
                            <div class="bg-gradient-to-r from-gold-500 to-gold-600 h-3 rounded-full transition-all duration-500" 
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-2">
                            <span>{{ number_format($percentage, 1) }}% funded</span>
                            <span>Goal: ₦{{ number_format($program->target_amount, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('donate', ['program' => $program->id]) }}" 
                       class="block w-full text-center px-6 py-4 bg-gradient-to-r from-gold-600 to-gold-700 text-white font-bold rounded-lg hover:from-gold-700 hover:to-gold-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Donate to This Program
                    </a>
                </div>
                @endif

                <!-- Quick Facts -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Quick Facts</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between border-b pb-2">
                            <dt class="text-gray-600">Status:</dt>
                            <dd class="font-semibold {{ $program->status === 'active' ? 'text-green-600' : 'text-gray-600' }}">
                                {{ ucfirst($program->status) }}
                            </dd>
                        </div>
                        @if($program->beneficiaries_count)
                        <div class="flex justify-between border-b pb-2">
                            <dt class="text-gray-600">Beneficiaries:</dt>
                            <dd class="font-semibold text-gray-900">{{ number_format($program->beneficiaries_count) }}</dd>
                        </div>
                        @endif
                        @if($program->location)
                        <div class="flex justify-between border-b pb-2">
                            <dt class="text-gray-600">Location:</dt>
                            <dd class="font-semibold text-gray-900">{{ $program->location }}</dd>
                        </div>
                        @endif
                        @if($program->start_date)
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Started:</dt>
                            <dd class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($program->start_date)->format('M d, Y') }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Share -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Share This Program</h3>
                    <div class="flex gap-3">
                        <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="flex-1 flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($program->name) }}" 
                           target="_blank"
                           class="flex-1 flex items-center justify-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Programs -->
@if($relatedPrograms && $relatedPrograms->count() > 0)
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Other Programs</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPrograms as $related)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48">
                    @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" 
                         alt="{{ $related->name }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gold-200 to-gold-400"></div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $related->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        {{ $related->short_description ?? Str::limit($related->description, 100) }}
                    </p>
                    <a href="{{ route('programs.show', $related->slug) }}" 
                       class="inline-flex items-center text-gold-600 hover:text-gold-700 font-semibold">
                        Learn More
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Call to Action -->
<div class="bg-gradient-to-r from-gold-600 to-gold-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Join Us in Making an Impact
        </h2>
        <p class="text-xl text-gold-100 mb-8 max-w-2xl mx-auto">
            Your support can transform lives and create lasting change in our communities
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate', ['program' => $program->id]) }}" class="btn-primary bg-white text-gold-600 hover:bg-gold-50">
                Support This Program
            </a>
            <a href="{{ route('get-involved') }}" class="btn-secondary bg-transparent text-white border-white hover:bg-white/10">
                Become a Volunteer
            </a>
        </div>
    </div>
</div>
@endsection
