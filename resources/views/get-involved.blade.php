@extends('layouts.app')

@section('title', 'Volunteer with Us - Centrum Optimi')
@section('description', 'Join Centrum Optimi Educational Foundation as a volunteer. Share your time, skills, and passion to make a direct impact in education.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gold-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">Volunteer with Us</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Share your time, skills, and passion to transform lives through education</p>
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

@endsection
