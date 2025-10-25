@extends('layouts.app')

@section('title', $post->title . ' - Centrum Optimi Educational Foundation')

@section('content')
<!-- Hero Section with Post Image -->
<div class="relative bg-gray-900">
    <div class="absolute inset-0">
        @if($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover opacity-50">
        @else
        <div class="w-full h-full bg-gradient-to-br from-gold-600 to-gold-800 opacity-50"></div>
        @endif
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <div class="flex items-center justify-center gap-4 text-sm text-gold-200 mb-6">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $post->published_at->format('F d, Y') }}
                </span>
                @if($post->author)
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $post->author->name }}
                </span>
                @endif
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ $post->views ?? 0 }} views
                </span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                {{ $post->title }}
            </h1>
            @if($post->excerpt)
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                {{ $post->excerpt }}
            </p>
            @endif
        </div>
    </div>
</div>

<!-- Post Content -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="prose prose-lg max-w-none">
            {!! $post->content !!}
        </article>

        <!-- Share Buttons -->
        <div class="mt-12 pt-8 border-t">
            <p class="text-sm font-semibold text-gray-600 mb-4">Share this article:</p>
            <div class="flex gap-3">
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                    Twitter
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    LinkedIn
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Related Posts -->
@if($related_posts->count() > 0)
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Stories</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($related_posts as $related)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="relative h-48 overflow-hidden">
                    @if($related->featured_image)
                    <img src="{{ asset('storage/' . $related->featured_image) }}" 
                         alt="{{ $related->title }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gold-100 to-gold-300"></div>
                    @endif
                </div>
                
                <div class="p-6">
                    <p class="text-xs text-gray-500 mb-2">
                        {{ $related->published_at->format('M d, Y') }}
                    </p>
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $related->title }}
                    </h3>
                    <a href="{{ route('blog.show', $related->slug) }}" 
                       class="inline-flex items-center text-gold-600 hover:text-gold-700 font-semibold">
                        Read More
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Call to Action -->
<div class="bg-gradient-to-r from-gold-600 to-gold-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Support Our Mission
        </h2>
        <p class="text-xl text-gold-100 mb-8 max-w-2xl mx-auto">
            Help us continue making a difference in the lives of young people
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary bg-white text-gold-600 hover:bg-gold-50">
                Donate Now
            </a>
            <a href="{{ route('blog.index') }}" class="btn-secondary bg-transparent text-white border-white hover:bg-white/10">
                Read More Stories
            </a>
        </div>
    </div>
</div>
@endsection
