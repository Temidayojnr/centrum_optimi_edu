@extends('layouts.app')

@section('title', 'Partnership Opportunities - Centrum Optimi')
@section('description', 'Partner with Centrum Optimi Educational Foundation through corporate partnerships and program sponsorships to amplify your impact.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gold-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">Partner With Us</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Collaborate with Centrum Optimi to amplify your impact and create lasting change in education</p>
        </div>
    </div>
</section>

<!-- Partnership Overview -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Partner With Us?</h2>
                <p class="text-lg text-gray-600 mb-6">
                    By partnering with Centrum Optimi, you align your organization with a mission that transforms lives through education. Together, we can create sustainable impact in underserved communities.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <strong class="text-gray-900">Measurable Impact:</strong>
                            <span class="text-gray-600"> See the direct results of your partnership through transparent reporting</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <strong class="text-gray-900">Brand Alignment:</strong>
                            <span class="text-gray-600"> Associate your brand with positive social change and educational excellence</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <strong class="text-gray-900">Employee Engagement:</strong>
                            <span class="text-gray-600"> Provide meaningful volunteer opportunities for your team</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?w=800&q=80" 
                     alt="Partnership" 
                     class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Partnership Types -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="section-title">Partnership Opportunities</h2>
            <p class="section-subtitle">Choose the partnership model that aligns with your goals</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card p-8">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Corporate Partnerships</h3>
                <p class="text-gray-600 mb-6">
                    Partner with us through corporate social responsibility programs, employee volunteer initiatives, and matched giving programs.
                </p>
                <h4 class="font-semibold text-gray-900 mb-3">Benefits Include:</h4>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Brand visibility and recognition
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Employee engagement opportunities
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Impact reporting and recognition
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Logo placement on marketing materials
                    </li>
                </ul>
            </div>
            
            <div class="card p-8">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Program Sponsorship</h3>
                <p class="text-gray-600 mb-6">
                    Sponsor a specific program or project and see your contribution create direct, measurable impact in communities.
                </p>
                <h4 class="font-semibold text-gray-900 mb-3">Benefits Include:</h4>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Dedicated program naming rights
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Regular progress updates
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Direct beneficiary engagement
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-gold-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Exclusive impact stories and media
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-4">
                Let's Partner Together
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Ready to create lasting impact in education? Reach out to discuss partnership opportunities
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Partnership Contact Information -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h3>
                <p class="text-gray-600 mb-8">
                    We're excited to hear from potential partners who share our vision for transforming education. Contact us to explore partnership opportunities.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Email</h4>
                            <a href="mailto:centrumoptimieduf@gmail.com" class="text-gold-600 hover:text-gold-700 text-lg">
                                centrumoptimieduf@gmail.com
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Response Time</h4>
                            <p class="text-gray-600">We typically respond within 24-48 hours</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">What to Include</h4>
                            <ul class="text-gray-600 space-y-1 mt-2">
                                <li>• Your organization details</li>
                                <li>• Partnership interests</li>
                                <li>• Proposed collaboration areas</li>
                                <li>• Timeline and budget (if applicable)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 p-6 bg-gold-50 rounded-xl">
                    <h4 class="font-semibold text-gray-900 mb-2">Partnership Inquiry</h4>
                    <p class="text-gray-600 text-sm">
                        When reaching out, please mention you're interested in partnership opportunities. Include information about your organization and the type of collaboration you envision.
                    </p>
                </div>
            </div>
            
            <!-- Quick Contact Info -->
            <div class="bg-gradient-to-br from-gold-50 to-white p-8 rounded-2xl">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Why Partner With Centrum Optimi?</h3>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h5 class="font-semibold text-gray-900">Proven Impact</h5>
                            <p class="text-gray-600 text-sm">Track record of successful educational programs</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h5 class="font-semibold text-gray-900">Transparent Reporting</h5>
                            <p class="text-gray-600 text-sm">Regular updates and measurable outcomes</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h5 class="font-semibold text-gray-900">Flexible Partnerships</h5>
                            <p class="text-gray-600 text-sm">Customizable collaboration models</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h5 class="font-semibold text-gray-900">Community Connection</h5>
                            <p class="text-gray-600 text-sm">Direct engagement with beneficiaries</p>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gold-200 pt-6">
                    <a href="mailto:centrumoptimieduf@gmail.com" class="btn-primary w-full text-center block">
                        Send Partnership Inquiry
                    </a>
                    <a href="{{ route('about') }}" class="mt-4 inline-flex items-center justify-center w-full px-6 py-3 border-2 border-gold-600 text-gold-600 font-medium rounded-lg hover:bg-gold-50 transition-colors">
                        Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
