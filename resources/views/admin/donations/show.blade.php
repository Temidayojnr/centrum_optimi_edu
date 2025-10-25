@extends('admin.layouts.app')

@section('title', 'Donation Details - ' . $donation->transaction_reference)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.donations.index') }}" class="text-gold-600 hover:text-gold-700 mb-2 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Donations
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Donation Details</h1>
            <p class="text-gray-600 mt-2">Transaction: {{ $donation->transaction_reference }}</p>
        </div>
        <div>
            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ 
                $donation->status === 'successful' ? 'bg-green-100 text-green-800' : 
                ($donation->status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
            }}">
                {{ ucfirst($donation->status) }}
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Donor Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Donor Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                    <p class="text-gray-900 font-medium">
                        @if($donation->is_anonymous)
                            <span class="text-gray-400 italic">Anonymous Donor</span>
                        @else
                            {{ $donation->donor_name }}
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $donation->donor_email }}" class="text-gold-600 hover:text-gold-700">
                            {{ $donation->donor_email }}
                        </a>
                    </p>
                </div>
                @if($donation->donor_phone)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $donation->donor_phone }}" class="text-gold-600 hover:text-gold-700">
                            {{ $donation->donor_phone }}
                        </a>
                    </p>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Anonymous Donation</label>
                    <p class="text-gray-900">
                        <span class="px-3 py-1 {{ $donation->is_anonymous ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} rounded-full text-sm font-medium">
                            {{ $donation->is_anonymous ? 'Yes' : 'No' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Payment Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Amount</label>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $donation->currency }} {{ number_format($donation->amount, 2) }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Payment Method</label>
                    <p class="text-gray-900">
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            {{ ucfirst($donation->payment_method) }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Transaction Reference</label>
                    <p class="text-gray-900 font-mono text-sm">{{ $donation->transaction_reference }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                    <p class="text-gray-900">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ 
                            $donation->status === 'successful' ? 'bg-green-100 text-green-800' : 
                            ($donation->status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                        }}">
                            {{ ucfirst($donation->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Program Information -->
        @if($donation->program)
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Designated Program
            </h2>
            <div class="flex items-start space-x-4">
                @if($donation->program->featured_image)
                <img src="{{ asset('storage/' . $donation->program->featured_image) }}" 
                     alt="{{ $donation->program->title }}" 
                     class="w-24 h-24 object-cover rounded-lg">
                @else
                <div class="w-24 h-24 bg-gold-100 rounded-lg flex items-center justify-center">
                    <svg class="w-12 h-12 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                @endif
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $donation->program->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($donation->program->description, 150) }}</p>
                    <a href="{{ route('admin.programs.edit', $donation->program) }}" 
                       class="inline-flex items-center mt-3 text-gold-600 hover:text-gold-700 text-sm font-medium">
                        View Program
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-blue-900 font-medium">This is a general donation not designated to a specific program.</p>
            </div>
        </div>
        @endif

        <!-- Donor Message -->
        @if($donation->message)
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                Donor Message
            </h2>
            <p class="text-gray-900 whitespace-pre-line bg-gray-50 p-4 rounded-lg">{{ $donation->message }}</p>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Transaction Timeline -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Transaction Timeline</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">Initiated</p>
                        <p class="text-xs text-gray-500">{{ $donation->created_at->format('M d, Y - h:i A') }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $donation->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                @if($donation->paid_at)
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">Payment Completed</p>
                        <p class="text-xs text-gray-500">{{ $donation->paid_at->format('M d, Y - h:i A') }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $donation->paid_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endif

                @if($donation->updated_at != $donation->created_at && !$donation->paid_at)
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">Last Updated</p>
                        <p class="text-xs text-gray-500">{{ $donation->updated_at->format('M d, Y - h:i A') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-gradient-to-br from-gold-500 to-gold-600 rounded-xl shadow-md p-6 text-white">
            <h3 class="text-lg font-bold mb-4">Donation Amount</h3>
            <p class="text-4xl font-bold">{{ $donation->currency }} {{ number_format($donation->amount, 2) }}</p>
            @if($donation->status === 'successful')
            <p class="text-gold-100 text-sm mt-2">Successfully processed</p>
            @elseif($donation->status === 'pending')
            <p class="text-gold-100 text-sm mt-2">Payment pending</p>
            @else
            <p class="text-gold-100 text-sm mt-2">Payment failed</p>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="mailto:{{ $donation->donor_email }}" 
                   class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Send Thank You Email
                </a>
                @if($donation->donor_phone)
                <a href="tel:{{ $donation->donor_phone }}" 
                   class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Donor
                </a>
                @endif
                <button onclick="window.print()" 
                        class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Receipt
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
