@extends('layouts.app')

@section('title', 'Gallery - Centrum Optimi Educational Foundation')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-gold-600 to-gold-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6">
                Our Gallery
            </h1>
            <p class="text-xl md:text-2xl text-gold-100 max-w-3xl mx-auto">
                Capturing moments of transformation and impact in our communities
            </p>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="bg-white shadow-sm border-b sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-wrap gap-3 justify-center">
            <button onclick="filterGallery('all')" class="filter-btn active px-6 py-2 rounded-full font-medium transition-all duration-200 bg-gold-600 text-white hover:bg-gold-700">
                All Photos
            </button>
            @foreach($programs as $program)
            <button onclick="filterGallery('{{ $program->slug }}')" class="filter-btn px-6 py-2 rounded-full font-medium transition-all duration-200 bg-gray-200 text-gray-700 hover:bg-gold-100 hover:text-gold-800">
                {{ $program->name }}
            </button>
            @endforeach
        </div>
    </div>
</div>

<!-- Gallery Grid -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleryItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleryItems as $item)
            <div class="gallery-item group" data-category="{{ $item->program ? $item->program->slug : 'all' }}">
                <div class="relative overflow-hidden rounded-xl shadow-lg bg-white transition-transform duration-300 hover:scale-105">
                    <div class="aspect-w-16 aspect-h-12 relative h-64">
                        @if($item->image_url)
                        <img src="{{ asset('storage/' . $item->image_url) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-gold-200 to-gold-300 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-xl font-bold mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                <p class="text-sm text-gray-200">{{ Str::limit($item->description, 80) }}</p>
                                @endif
                                @if($item->program)
                                <span class="inline-block mt-3 px-3 py-1 bg-gold-600 text-white text-xs rounded-full">
                                    {{ $item->program->name }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($galleryItems->hasPages())
        <div class="mt-12">
            {{ $galleryItems->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-6 text-2xl font-semibold text-gray-900">No photos yet</h3>
            <p class="mt-2 text-gray-600">Check back soon for photos from our programs and events.</p>
        </div>
        @endif
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-gold-600 to-gold-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Want to be part of our story?
        </h2>
        <p class="text-xl text-gold-100 mb-8 max-w-2xl mx-auto">
            Join us in transforming lives through education and empowerment
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-lg font-semibold rounded-lg text-white hover:bg-white hover:text-gold-600 transition-all duration-200">
                Support Our Work
            </a>
            <a href="{{ route('get-involved') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-lg font-semibold rounded-lg text-gold-600 hover:bg-gold-50 transition-all duration-200">
                Get Involved
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function filterGallery(category) {
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-gold-600', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    event.target.classList.add('active', 'bg-gold-600', 'text-white');
    event.target.classList.remove('bg-gray-200', 'text-gray-700');

    // Filter gallery items
    const items = document.querySelectorAll('.gallery-item');
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'scale(1)';
            }, 10);
        } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.9)';
            setTimeout(() => {
                item.style.display = 'none';
            }, 300);
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.style.transition = 'opacity 0.3s, transform 0.3s';
    });
});
</script>
@endpush
@endsection
