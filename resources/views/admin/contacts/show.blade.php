@extends('admin.layouts.app')

@section('title', 'Contact Message - ' . $contact->name)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.contacts.index') }}" class="text-gold-600 hover:text-gold-700 mb-2 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Messages
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Contact Message</h1>
            <p class="text-gray-600 mt-2">From: {{ $contact->name }}</p>
        </div>
        <div>
            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ 
                $contact->status === 'replied' ? 'bg-green-100 text-green-800' : 
                ($contact->status === 'read' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') 
            }}">
                {{ ucfirst($contact->status) }}
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Contact Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                    <p class="text-gray-900 font-medium">{{ $contact->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $contact->email }}" class="text-gold-600 hover:text-gold-700">
                            {{ $contact->email }}
                        </a>
                    </p>
                </div>
                @if($contact->phone)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $contact->phone }}" class="text-gold-600 hover:text-gold-700">
                            {{ $contact->phone }}
                        </a>
                    </p>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Subject</label>
                    <p class="text-gray-900 font-medium">{{ $contact->subject }}</p>
                </div>
            </div>
        </div>

        <!-- Message -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                Message
            </h2>
            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-gold-600">
                <p class="text-gray-900 whitespace-pre-line">{{ $contact->message }}</p>
            </div>
        </div>

        <!-- Admin Reply -->
        @if($contact->admin_reply)
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <h2 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
                Your Reply
            </h2>
            <p class="text-blue-900 whitespace-pre-line">{{ $contact->admin_reply }}</p>
            @if($contact->replied_at)
            <p class="text-xs text-blue-700 mt-4">Replied: {{ $contact->replied_at->format('M d, Y - h:i A') }}</p>
            @endif
        </div>
        @endif

        <!-- Reply Form -->
        @if($contact->status !== 'replied')
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
                Send Reply
            </h2>
            <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="admin_reply" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                    <textarea name="admin_reply" 
                              id="admin_reply" 
                              rows="6"
                              required
                              placeholder="Type your reply here..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('admin_reply') border-red-500 @enderror">{{ old('admin_reply') }}</textarea>
                    @error('admin_reply')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">This reply will be sent to {{ $contact->email }}</p>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Send Reply
                    </button>
                    <a href="{{ route('admin.contacts.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Message Info -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Message Info</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ 
                        $contact->status === 'replied' ? 'bg-green-100 text-green-800' : 
                        ($contact->status === 'read' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') 
                    }}">
                        {{ ucfirst($contact->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Received</label>
                    <p class="text-gray-900 text-sm">{{ $contact->created_at->format('M d, Y') }}</p>
                    <p class="text-gray-500 text-xs">{{ $contact->created_at->format('h:i A') }}</p>
                    <p class="text-gray-400 text-xs mt-1">{{ $contact->created_at->diffForHumans() }}</p>
                </div>
                @if($contact->replied_at)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Replied</label>
                    <p class="text-gray-900 text-sm">{{ $contact->replied_at->format('M d, Y') }}</p>
                    <p class="text-gray-500 text-xs">{{ $contact->replied_at->format('h:i A') }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="mailto:{{ $contact->email }}" 
                   class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Send Email
                </a>
                @if($contact->phone)
                <a href="tel:{{ $contact->phone }}" 
                   class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Contact
                </a>
                @endif
                <button onclick="window.print()" 
                        class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Message
                </button>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
