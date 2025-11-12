@extends('layouts.app')

@section('title', 'About Us - Centrum Optimi Educational Foundation')
@section('description', 'Learn about Centrum Optimi Educational Foundation, our mission to bridge educational gaps, and our vision for a society where excellence is shared by all.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gold-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-6">About Centrum Optimi</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Centre of Excellence - Unlocking potential through education</p>
        </div>
    </div>
</section>

<!-- What We Do -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-6">What We Do</h2>
                <p class="text-lg text-gray-600 mb-6">
                    <strong class="text-gold-600">Centrum Optimi</strong> is a Latin term meaning "Centre of Excellence". We are an educational foundation dedicated to helping individuals achieve their highest potential through both formal and non-formal education.
                </p>
                <p class="text-lg text-gray-600 mb-6">
                    By offering resources and opportunities for quality education, we promote personal excellence, allowing individuals to shine as stars in their worlds. We believe that education is the key to unlocking the inherent excellence within every person.
                </p>
                <div class="bg-gold-50 border-l-4 border-gold-600 p-6 rounded-r-lg">
                    <p class="text-gray-700 italic">
                        "There is excellence in every individual, and this excellence can be nurtured and expressed through access to quality education, hands-on learning, and skill development."
                    </p>
                </div>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800&q=80" 
                     alt="Students learning" 
                     class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card p-10">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                <p class="text-gray-600 text-lg leading-relaxed">
                    To bridge the educational gap that exists among the underprivileged and in rural communities by providing access to quality formal and non-formal education.
                </p>
            </div>
            
            <div class="card p-10">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                <p class="text-gray-600 text-lg leading-relaxed">
                    We believe there is excellence in every individual, and this excellence can be nurtured and expressed through access to quality education, hands-on learning, and skill development, leading to a progressive and healthy society.
                </p>
            </div>
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Excellence</h3>
                <p class="text-gray-600">Striving for the highest quality in everything we do</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Compassion</h3>
                <p class="text-gray-600">Caring deeply about the communities we serve</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Inclusivity</h3>
                <p class="text-gray-600">Ensuring education is accessible to all</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Impact</h3>
                <p class="text-gray-600">Creating lasting change in communities</p>
            </div>
        </div>
    </div>
</section>

<!-- Board of Trustees -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Board of Trustees</h2>
            <p class="section-subtitle">Meet the dedicated leaders guiding our mission</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Mercy Oladele - Founder -->
            <div class="card group">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('images/Mercy.jpeg') }}" 
                         alt="Mercy Oladele" 
                         class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300"
                         width="400"
                         height="320"
                         loading="lazy">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-gold-600 text-white text-xs font-semibold rounded-full shadow-lg">
                            Founder
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Mercy Oladele</h3>
                    <p class="text-gold-600 font-semibold mb-4">Founder & Trustee</p>
                    <p class="text-gray-600 leading-relaxed">
                        Mercy Oladele is a knowledge enthusiast with over a decade of experience in the fashion industry. She has since transitioned into global education and development, where she focuses on empowering individuals to realize their full potential. Mercy believes that everyone is unique and deserves the opportunity to express themselves fully without limitations. She is committed to helping others learn, grow, and thrive.
                    </p>
                </div>
            </div>

            <!-- Olakitan Oladimeji -->
            <div class="card group">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('images/Olakitan.jpeg') }}" 
                         alt="Olakitan Oladimeji" 
                         class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300"
                         width="400"
                         height="320"
                         loading="lazy">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Olakitan Oladimeji</h3>
                    <p class="text-gold-600 font-semibold mb-4">Trustee</p>
                    <p class="text-gray-600 leading-relaxed">
                        Olakitan Oladimeji is a land surveyor with over fifteen years of experience in mapping and measuring land. His expertise includes establishing property boundaries, determining elevations, and preparing sites for construction. Olakitan uses his extensive knowledge to support and guide the overall vision of the foundation.
                    </p>
                </div>
            </div>

            <!-- Olatunji Amowoyagi -->
            <div class="card group">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('images/Olatunji.jpeg') }}" 
                         alt="Olatunji Amowoyagi" 
                         class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300"
                         width="400"
                         height="320"
                         loading="lazy">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Olatunji Amowoyagi</h3>
                    <p class="text-gold-600 font-semibold mb-4">Trustee</p>
                    <p class="text-gray-600 leading-relaxed">
                        Olatunji Amowoyagi has more than nine years of experience in downstream operations, which includes sales, marketing, and depot management. He is proficient in numerical analysis, data interpretation, and the application of machine learning techniques. In addition to his professional experience, Olatunji is a skilled mathematics instructor with a proven track record of teaching both in traditional classroom settings and through e-learning platforms.
                    </p>
                </div>
            </div>
        </div>

        <!-- Leadership Quote -->
        <div class="mt-16 bg-gradient-to-r from-gold-50 to-gold-100 rounded-2xl p-8 md:p-12 text-center">
            <svg class="w-12 h-12 text-gold-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
            </svg>
            <p class="text-xl md:text-2xl text-gray-800 font-medium italic mb-4">
                "Our diverse expertise and shared commitment enable us to guide Centrum Optimi toward achieving excellence in education and community development."
            </p>
            <p class="text-gray-600 font-semibold">Board of Trustees</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-gold-600 to-gold-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold mb-6">Join Us in Our Mission</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
            Together, we can unlock the potential of every individual and build a society where excellence thrives.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary bg-white text-gold-600 hover:bg-gray-100">
                Support Our Work
            </a>
            <a href="{{ route('get-involved') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-lg font-medium rounded-lg text-white bg-transparent hover:bg-white hover:text-gold-600 transition-all duration-200">
                Become a Partner
            </a>
        </div>
    </div>
</section>
@endsection
