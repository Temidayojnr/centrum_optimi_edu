@extends('layouts.app')

@section('title', 'Blog - Centrum Optimi Educational Foundation')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-gold-600 to-gold-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6">
                Our Blog
            </h1>
            <p class="text-xl md:text-2xl text-gold-100 max-w-3xl mx-auto">
                Stories of impact, insights, and updates from our community
            </p>
        </div>
    </div>
</div>

<!-- Featured Post -->
@if($featured_post ?? null)
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <span class="inline-block px-4 py-2 bg-gold-100 text-gold-800 rounded-full text-sm font-semibold mb-4">
                Featured Story
            </span>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="relative h-96 rounded-xl overflow-hidden shadow-2xl">
                @if($featured_post->featured_image)
                <img src="{{ asset('storage/' . $featured_post->featured_image) }}" 
                     alt="{{ $featured_post->title }}" 
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-br from-gold-200 to-gold-400 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                @endif
            </div>
            <div>
                <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $featured_post->published_at ? $featured_post->published_at->format('M d, Y') : 'No date' }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ $featured_post->author_name ?? 'Admin' }}
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $featured_post->title }}
                </h2>
                <p class="text-lg text-gray-600 mb-6">
                    {{ $featured_post->excerpt ?? Str::limit(strip_tags($featured_post->content), 200) }}
                </p>
                <a href="{{ route('blog.show', $featured_post->slug) }}" class="btn-primary">
                    Read More
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- All Posts Grid -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Latest Stories</h2>
        
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="relative h-48 overflow-hidden">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gold-100 to-gold-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                        <span class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : 'No date' }}
                        </span>
                        @if($post->author_name)
                        <span class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $post->author_name }}
                        </span>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $post->title }}
                    </h3>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    
                    <a href="{{ route('blog.show', $post->slug) }}" 
                       class="inline-flex items-center text-gold-600 hover:text-gold-700 font-semibold transition-colors">
                        Read More
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <h3 class="mt-6 text-2xl font-semibold text-gray-900">No blog posts yet</h3>
            <p class="mt-2 text-gray-600">Check back soon for stories and updates from our community.</p>
        </div>
        @endif
    </div>
</div>

<!-- Newsletter Subscription -->
<div class="bg-gradient-to-r from-gold-600 to-gold-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Stay Updated
            </h2>
            <p class="text-xl text-gold-100 mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter for the latest stories and updates
            </p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="max-w-md mx-auto">
                @csrf
                <div class="flex gap-3">
                    <input type="email" 
                           name="email" 
                           required
                           placeholder="Enter your email" 
                           class="flex-1 px-6 py-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                    <button type="submit" 
                            class="px-8 py-4 bg-white text-gold-600 font-semibold rounded-lg hover:bg-gold-50 transition-colors">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
