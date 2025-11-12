@extends('layouts.app')

@section('title', 'Donation Successful - Centrum Optimi Educational Foundation')
@section('description', 'Thank you for your generous donation to Centrum Optimi Educational Foundation.')

@section('content')
<section class="min-h-screen bg-gradient-to-br from-green-50 to-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6 animate-bounce">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">
                Thank You for Your Donation!
            </h1>
            <p class="text-xl text-gray-600">
                Your generosity makes a real difference in our community
            </p>
        </div>

        <!-- Donation Details Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-gold-600 to-gold-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Donation Receipt</h2>
                <p class="text-gold-100">Transaction completed successfully</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Transaction Reference -->
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-sm text-gray-500 mb-1">Transaction Reference</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $donation->transaction_reference }}</p>
                    </div>

                    <!-- Amount -->
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-sm text-gray-500 mb-1">Amount Donated</p>
                        <p class="text-2xl font-bold text-green-600">₦{{ number_format($donation->amount, 2) }}</p>
                    </div>

                    <!-- Donor Name -->
                    @if(!$donation->is_anonymous)
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-sm text-gray-500 mb-1">Donor Name</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $donation->donor_name }}</p>
                    </div>

                    <!-- Email -->
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-sm text-gray-500 mb-1">Email Address</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $donation->donor_email }}</p>
                    </div>
                    @else
                    <div class="border-b border-gray-200 pb-4 md:col-span-2">
                        <p class="text-sm text-gray-500 mb-1">Donation Type</p>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                            <p class="text-lg font-semibold text-gray-900">Anonymous Donation</p>
                        </div>
                    </div>
                    @endif

                    <!-- Program -->
                    @if($donation->program)
                    <div class="border-b border-gray-200 pb-4 md:col-span-2">
                        <p class="text-sm text-gray-500 mb-1">Designated For</p>
                        <p class="text-lg font-semibold text-gold-600">{{ $donation->program->title }}</p>
                    </div>
                    @endif

                    <!-- Date -->
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-sm text-gray-500 mb-1">Date & Time</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $donation->paid_at ? $donation->paid_at->format('M d, Y h:i A') : now()->format('M d, Y h:i A') }}</p>
                    </div>

                    <!-- Payment Method -->
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-sm text-gray-500 mb-1">Payment Method</p>
                        <p class="text-lg font-semibold text-gray-900">{{ ucfirst($donation->payment_method) }}</p>
                    </div>
                </div>

                <!-- Message (if provided) -->
                @if($donation->message)
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <p class="text-sm text-gray-500 mb-2">Your Message</p>
                    <p class="text-gray-700 italic">"{{ $donation->message }}"</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Impact Message -->
        <div class="bg-gradient-to-r from-gold-50 to-gold-100 rounded-2xl p-8 mb-8 text-center">
            <svg class="w-16 h-16 text-gold-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Your Impact</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
                Your generous donation of <strong class="text-gold-600">₦{{ number_format($donation->amount, 2) }}</strong> will help us provide quality education to underprivileged children and bridge the educational gap in rural communities. Thank you for being a part of our mission to unlock individual excellence through education.
            </p>
        </div>

        <!-- Next Steps -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">What Happens Next?</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gold-100 rounded-full flex items-center justify-center">
                            <span class="text-gold-600 font-bold">1</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-900">Receipt Confirmation</h4>
                        <p class="text-gray-600">A receipt has been sent to your email address for your records.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gold-100 rounded-full flex items-center justify-center">
                            <span class="text-gold-600 font-bold">2</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-900">Fund Allocation</h4>
                        <p class="text-gray-600">Your donation will be allocated to the designated program or our general fund to support our mission.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gold-100 rounded-full flex items-center justify-center">
                            <span class="text-gold-600 font-bold">3</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-900">Stay Updated</h4>
                        <p class="text-gray-600">We'll keep you informed about the impact of your donation and our ongoing programs.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="btn-primary text-center">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Return to Homepage
            </a>
            <a href="{{ route('programs.index') }}" class="btn-secondary text-center">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                View Our Programs
            </a>
        </div>

        <!-- Social Share -->
        <div class="mt-12 text-center">
            <p class="text-gray-600 mb-4">Help us spread the word about our mission</p>
            <div class="flex justify-center space-x-4">
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(route('home')) }}" 
                   target="_blank"
                   class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode('I just donated to Centrum Optimi Educational Foundation!') }}&url={{ urlencode(route('home')) }}" 
                   target="_blank"
                   class="w-12 h-12 bg-sky-500 rounded-full flex items-center justify-center text-white hover:bg-sky-600 transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('home')) }}" 
                   target="_blank"
                   class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center text-white hover:bg-blue-800 transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
