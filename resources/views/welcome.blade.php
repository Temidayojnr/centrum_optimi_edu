@extends('layouts.app')

@section('title', 'Centrum Optimi Educational Foundation - Unlocking Individual Excellence Through Education')
@section('description', 'Centrum Optimi Educational Foundation bridges the educational gap for underprivileged and rural communities through quality education, hands-on learning, and skill development.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gold-50 via-white to-gold-100 overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Unlocking Individual <span class="text-gold-600">Excellence</span> Through Education
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl">
                    We envision a world where individual excellence can be nurtured and expressed through access to quality education, hands-on learning, and skill development.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('get-involved') }}" class="btn-primary text-lg px-8 py-4">
                        Join Us
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80" 
                     alt="Children learning" 
                     class="rounded-2xl shadow-2xl w-full"
                     width="800"
                     height="533"
                     loading="eager">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Our Mission & Vision</h2>
            <p class="section-subtitle">Building a society where excellence is a shared reality for all</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card p-8">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    To bridge the educational gap that exists among the underprivileged and in rural communities by providing access to quality formal and non-formal education. We are committed to equipping individuals with both theoretical knowledge and practical skills that empower them to build better lives and contribute meaningfully to society.
                </p>
            </div>
            
            <div class="card p-8">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed">
                    We believe there is excellence in every individual, and this excellence can be nurtured and expressed through access to quality education, hands-on learning, and skill development, leading to a progressive and healthy society where everyone has the opportunity to reach their full potential.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Programs -->
@if($featured_programs && $featured_programs->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Our Programs</h2>
            <p class="section-subtitle">Making a difference through targeted educational initiatives</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featured_programs as $program)
            <div class="card group">
                @if($program->featured_image)
                    <img src="{{ asset('storage/' . $program->featured_image) }}" 
                         alt="{{ $program->title }}" 
                         class="w-full h-64 object-cover"
                         width="400"
                         height="256"
                         loading="lazy">
                @else
                    <div class="w-full h-64 bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-gold-100 text-gold-800 text-xs font-semibold rounded-full">
                            {{ ucfirst($program->status) }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-gold-600 transition-colors">{{ $program->title }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $program->description }}</p>
                    <a href="{{ route('programs.show', $program->slug) }}" class="text-gold-600 hover:text-gold-700 font-semibold inline-flex items-center">
                        Learn More 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('programs.index') }}" class="btn-secondary">View All Programs</a>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-gold-600 to-gold-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold mb-6">Make a Difference Today</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
            Your support helps us provide quality education to those who need it most. Every contribution counts.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('get-involved') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-lg font-medium rounded-lg text-gold-600 bg-white hover:bg-gray-100 transition-all duration-200">
                Become a Volunteer
            </a>
        </div>
    </div>
</section>

<!-- Latest Blog Posts -->
@if($recent_posts && $recent_posts->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Latest News & Updates</h2>
            <p class="section-subtitle">Stay informed about our activities and impact</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($recent_posts as $post)
            <article class="card group">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-48 object-cover"
                         width="400"
                         height="192"
                         loading="lazy">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300"></div>
                @endif
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-2">{{ $post->published_at->format('M d, Y') }}</p>
                    <h3 class="text-lg font-bold mb-3 group-hover:text-gold-600 transition-colors line-clamp-2">{{ $post->title }}</h3>
                    @if($post->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                    @endif
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-gold-600 hover:text-gold-700 font-semibold inline-flex items-center">
                        Read More 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('blog.index') }}" class="btn-secondary">View All Posts</a>
        </div>
    </div>
</section>
@endif

<!-- Gallery Preview -->
@if($gallery_items && $gallery_items->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Our Impact in Pictures</h2>
            <p class="section-subtitle">See the lives we're transforming</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($gallery_items as $item)
            <div class="relative overflow-hidden rounded-lg group cursor-pointer aspect-square">
                <img src="{{ asset('storage/' . $item->file_path) }}" 
                     alt="{{ $item->title }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                     width="400"
                     height="400"
                     loading="lazy">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                    <p class="text-white font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ $item->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('gallery') }}" class="btn-secondary">View Full Gallery</a>
        </div>
    </div>
</section>
@endif
@endsection
