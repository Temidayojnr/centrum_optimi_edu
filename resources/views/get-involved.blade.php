@extends('layouts.app')

@section('title', 'Get Involved - Volunteer & Partner | Centrum Optimi')
@section('description', 'Join Centrum Optimi Educational Foundation as a volunteer or partner. Together we can create lasting change in education.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gold-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">Get Involved</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Join us in transforming lives through education</p>
        </div>
    </div>
</section>

<!-- Ways to Get Involved -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="card p-8 text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Volunteer</h3>
                <p class="text-gray-600 mb-4">Share your time, skills, and passion to make a direct impact</p>
            </div>
            
            <div class="card p-8 text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Partner</h3>
                <p class="text-gray-600 mb-4">Collaborate with us through corporate partnerships and sponsorships</p>
            </div>
            
            <div class="card p-8 text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Advocate</h3>
                <p class="text-gray-600 mb-4">Spread the word about our mission and impact in your community</p>
            </div>
        </div>
    </div>
</section>

<!-- Volunteer Application Form -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card p-8 md:p-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">Volunteer Application</h2>
            <p class="text-gray-600 text-center mb-8">Join our team of dedicated volunteers making a difference</p>
            
            <form action="{{ route('volunteer.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Personal Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('first_name') }}">
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('last_name') }}">
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                            <input type="text" id="city" name="city" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('city') }}">
                        </div>
                        
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State</label>
                            <input type="text" id="state" name="state" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('state') }}">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Occupation/Profession</label>
                            <input type="text" id="occupation" name="occupation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('occupation') }}">
                        </div>
                    </div>
                </div>
                
                <!-- Volunteer Details -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Volunteer Information</h3>
                    
                    <div class="mb-6">
                        <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills & Expertise</label>
                        <textarea id="skills" name="skills" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                  placeholder="e.g., Teaching, IT, Administration, Event Planning...">{{ old('skills') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">List your skills that could benefit our programs</p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="why_volunteer" class="block text-sm font-medium text-gray-700 mb-2">Why do you want to volunteer with us? *</label>
                        <textarea id="why_volunteer" name="why_volunteer" rows="4" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent">{{ old('why_volunteer') }}</textarea>
                        @error('why_volunteer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Availability *</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="availability" value="weekdays" required 
                                       class="h-4 w-4 text-gold-600 focus:ring-gold-500"
                                       {{ old('availability') == 'weekdays' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">Weekdays</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="availability" value="weekends" 
                                       class="h-4 w-4 text-gold-600 focus:ring-gold-500"
                                       {{ old('availability') == 'weekends' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">Weekends</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="availability" value="both" 
                                       class="h-4 w-4 text-gold-600 focus:ring-gold-500"
                                       {{ old('availability') == 'both' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">Both Weekdays & Weekends</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="availability" value="flexible" 
                                       class="h-4 w-4 text-gold-600 focus:ring-gold-500"
                                       {{ old('availability') == 'flexible' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">Flexible Schedule</span>
                            </label>
                        </div>
                        @error('availability')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn-primary w-full text-lg py-4">
                    Submit Application
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Partnership Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="section-title">Partner With Us</h2>
            <p class="section-subtitle">Collaborate with Centrum Optimi to amplify your impact</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 rounded-xl p-8">
                <h3 class="text-2xl font-bold mb-4">Corporate Partnerships</h3>
                <p class="text-gray-600 mb-6">
                    Partner with us through corporate social responsibility programs, employee volunteer initiatives, and matched giving programs.
                </p>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Brand visibility and recognition
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Employee engagement opportunities
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Impact reporting and recognition
                    </li>
                </ul>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-8">
                <h3 class="text-2xl font-bold mb-4">Program Sponsorship</h3>
                <p class="text-gray-600 mb-6">
                    Sponsor a specific program or project and see your contribution create direct, measurable impact in communities.
                </p>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Dedicated program naming rights
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Regular progress updates
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-gold-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Direct beneficiary engagement
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('contact') }}" class="btn-primary text-lg px-8 py-4">
                Discuss Partnership Opportunities
            </a>
        </div>
    </div>
</section>
@endsection
