@extends('layouts.app')

@section('title', 'Donate - Support Quality Education | Centrum Optimi')
@section('description', 'Support Centrum Optimi Educational Foundation. Your donation helps provide quality education to underprivileged communities.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gold-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">Make a Difference Today</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Your generous donation helps us provide quality education to those who need it most</p>
        </div>
    </div>
</section>

<!-- Donation Form -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card p-8 md:p-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Support Our Mission</h2>
            
            <form action="{{ route('donation.initiate') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Donor Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Your Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="donor_name" name="donor_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('donor_name') }}">
                            @error('donor_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="donor_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="donor_email" name="donor_email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('donor_email') }}">
                            @error('donor_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="donor_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="donor_phone" name="donor_phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                   value="{{ old('donor_phone') }}">
                        </div>
                    </div>
                </div>
                
                <!-- Donation Details -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Donation Details</h3>
                    
                    <div class="mb-6">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Donation Amount (₦) *</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">₦</span>
                            <input type="number" id="amount" name="amount" min="100" step="100" required 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent text-lg"
                                   value="{{ old('amount') }}"
                                   placeholder="5000">
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Quick Amount Buttons -->
                        <div class="grid grid-cols-4 gap-3 mt-4">
                            <button type="button" onclick="document.getElementById('amount').value = 1000" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gold-50 hover:border-gold-500 transition-colors">
                                ₦1,000
                            </button>
                            <button type="button" onclick="document.getElementById('amount').value = 5000" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gold-50 hover:border-gold-500 transition-colors">
                                ₦5,000
                            </button>
                            <button type="button" onclick="document.getElementById('amount').value = 10000" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gold-50 hover:border-gold-500 transition-colors">
                                ₦10,000
                            </button>
                            <button type="button" onclick="document.getElementById('amount').value = 50000" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gold-50 hover:border-gold-500 transition-colors">
                                ₦50,000
                            </button>
                        </div>
                    </div>
                    
                    @if($programs && $programs->count() > 0)
                    <div class="mb-6">
                        <label for="program_id" class="block text-sm font-medium text-gray-700 mb-2">Support a Specific Program (Optional)</label>
                        <select id="program_id" name="program_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                            <option value="">General Donation</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                        <textarea id="message" name="message" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent"
                                  placeholder="Leave a message of encouragement...">{{ old('message') }}</textarea>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" 
                               class="h-4 w-4 text-gold-600 focus:ring-gold-500 border-gray-300 rounded"
                               {{ old('is_anonymous') ? 'checked' : '' }}>
                        <label for="is_anonymous" class="ml-2 block text-sm text-gray-700">
                            Make my donation anonymous
                        </label>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Payment Method</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-gold-500 transition-colors">
                            <input type="radio" name="payment_method" value="paystack" checked 
                                   class="h-4 w-4 text-gold-600 focus:ring-gold-500">
                            <span class="ml-3 text-gray-700 font-medium">Paystack (Card, Bank Transfer)</span>
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary w-full text-lg py-4 mt-6">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Proceed to Secure Payment
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
