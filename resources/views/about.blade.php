@extends('layouts.app')

@section('title', 'About Us - Centrum Optimi Educational Foundation')
@section('description', 'Learn about Centrum Optimi Educational Foundation, our mission to bridge educational gaps, and our vision for a society where excellence is shared by all.')

@php
    $introImage = $about['intro_image'];
    if (!\Illuminate\Support\Str::startsWith($introImage, ['http://', 'https://'])) {
        $introImage = asset('storage/' . $introImage);
    }
    $objectives = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $about['objectives']))));
    $valueIcons = [
        'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
        'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
        'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        'M13 10V3L4 14h7v7l9-11h-7z',
    ];
    $trusteePhotos = [1 => 'images/Mercy.jpeg', 2 => 'images/Olakitan.jpeg', 3 => 'images/Olatunji.jpeg'];
@endphp

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-gold-50 via-white to-gold-100 py-20 md:py-24">
    <div class="absolute -top-24 -right-24 w-72 h-72 bg-gold-200/40 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-gold-100/60 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="eyebrow">Who We Are</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-gray-900 mb-6">{{ $about['hero_title'] }}</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $about['hero_subtitle'] }}</p>
    </div>
</section>

<!-- What We Do -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-6">{{ $about['intro_title'] }}</h2>
                <div class="prose prose-lg max-w-none text-gray-600 prose-p:text-gray-600 prose-strong:text-gold-600 prose-a:text-gold-600 mb-6">
                    {!! $about['intro_body'] !!}
                </div>
                @if($about['quote_text'])
                <blockquote class="bg-gold-50 border-l-4 border-gold-600 p-6 rounded-r-xl">
                    <p class="text-gray-700 italic">"{{ $about['quote_text'] }}"</p>
                    @if($about['quote_author'])
                        <footer class="text-gray-600 text-sm mt-2 font-semibold">— {{ $about['quote_author'] }}</footer>
                    @endif
                </blockquote>
                @endif
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-gold-200 to-gold-50 rounded-3xl -rotate-2" aria-hidden="true"></div>
                <img src="{{ $introImage }}"
                     alt="Students learning"
                     class="relative w-full aspect-[4/3] object-cover rounded-2xl shadow-2xl"
                     width="800" height="600"
                     loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

<!-- Mission, Vision & Objectives -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Our Mission, Vision & Objectives</h2>
            <p class="section-subtitle">Guiding principles that drive our work</p>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Vision -->
                <div class="card p-8">
                    <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-gray-900 mb-3">Vision</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">{{ $about['vision'] }}</p>
                </div>

                <!-- Mission -->
                <div class="card p-8">
                    <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-gray-900 mb-3">Mission</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">{{ $about['mission'] }}</p>
                </div>
            </div>

            @if(count($objectives))
            <!-- Specific Objectives -->
            <div class="card p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-gray-900">Specific Objectives</h3>
                </div>
                <ol class="space-y-4">
                    @foreach($objectives as $objective)
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-7 h-7 bg-gold-600 text-white rounded-full flex items-center justify-center text-sm font-bold">{{ $loop->iteration }}</span>
                        <span class="text-lg text-gray-600 leading-relaxed">{{ $objective }}</span>
                    </li>
                    @endforeach
                </ol>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Our Core Values</h2>
            <p class="section-subtitle">The principles that guide our work</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($valueIcons as $index => $icon)
                @php $i = $index + 1; @endphp
                @if($about["value_{$i}_title"])
                <div class="text-center p-8 rounded-2xl border border-gray-100 bg-white hover:border-gold-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-gold-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-bold mb-3">{{ $about["value_{$i}_title"] }}</h3>
                    <p class="text-gray-600">{{ $about["value_{$i}_text"] }}</p>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Board of Trustees -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Board of Trustees</h2>
            <p class="section-subtitle">Meet the dedicated leaders guiding our mission</p>
        </div>

        <div class="space-y-8 max-w-5xl mx-auto">
            @foreach($trusteePhotos as $i => $photo)
                @if($about["trustee_{$i}_name"])
                <div class="card group">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <div class="relative overflow-hidden {{ $i % 2 === 0 ? 'md:order-2' : '' }}">
                            <img src="{{ asset($photo) }}"
                                 alt="{{ $about["trustee_{$i}_name"] }}"
                                 class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 min-h-[250px] md:min-h-[300px]"
                                 width="300" height="300"
                                 loading="lazy" decoding="async">
                            @if($i === 1)
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 bg-gold-600 text-white text-xs font-semibold rounded-full shadow-lg">Founder</span>
                            </div>
                            @endif
                        </div>
                        <div class="md:col-span-2 p-6 md:p-8 flex flex-col justify-center {{ $i % 2 === 0 ? 'md:order-1' : '' }}">
                            <h3 class="text-xl font-display font-bold text-gray-900 mb-1">{{ $about["trustee_{$i}_name"] }}</h3>
                            <p class="text-gold-600 font-semibold mb-3 text-sm">{{ $about["trustee_{$i}_role"] }}</p>
                            <p class="text-gray-600 leading-relaxed">{{ $about["trustee_{$i}_bio"] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        @if($about['board_quote'])
        <!-- Leadership Quote -->
        <div class="mt-16 max-w-5xl mx-auto bg-gradient-to-r from-gold-50 to-gold-100 rounded-2xl p-8 md:p-12 text-center">
            <svg class="w-12 h-12 text-gold-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
            </svg>
            <p class="text-xl md:text-2xl text-gray-800 font-medium italic mb-4">"{{ $about['board_quote'] }}"</p>
            <p class="text-gray-600 font-semibold">Board of Trustees</p>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-gold-600 to-gold-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold mb-6">{{ $about['cta_title'] }}</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">{{ $about['cta_text'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary bg-white text-gold-700 hover:bg-gray-100">
                Support Our Work
            </a>
            <a href="{{ route('partnership') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-semibold rounded-lg text-white bg-transparent hover:bg-white hover:text-gold-700 transition-all duration-200">
                Become a Partner
            </a>
        </div>
    </div>
</section>
@endsection
