@extends('admin.layouts.app')

@section('title', 'View Program - ' . $program->title)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $program->title }}</h1>
            <p class="text-gray-600 mt-2">Program Details</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.programs.edit', $program) }}" 
               class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Program
            </a>
            <a href="{{ route('admin.programs.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Programs
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Featured Image -->
        @if($program->featured_image)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $program->featured_image) }}" 
                 alt="{{ $program->title }}" 
                 class="w-full h-96 object-cover">
        </div>
        @endif

        <!-- Description -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Description</h3>
            <div class="prose max-w-none">
                {!! $program->description !!}
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Program Content</h3>
            <div class="prose max-w-none">
                {!! $program->content !!}
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Status & Details -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Program Information</h3>
            
            <div class="space-y-4">
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    @php
                        $statusColors = [
                            'active' => 'bg-green-100 text-green-800',
                            'completed' => 'bg-blue-100 text-blue-800',
                            'upcoming' => 'bg-yellow-100 text-yellow-800',
                        ];
                        $statusIcons = [
                            'active' => '●',
                            'completed' => '✓',
                            'upcoming' => '◷',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$program->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $statusIcons[$program->status] ?? '' }} {{ ucfirst($program->status) }}
                    </span>
                </div>

                <!-- Location -->
                @if($program->location)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <p class="text-gray-900">
                        <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $program->location }}
                    </p>
                </div>
                @endif

                <!-- Dates -->
                @if($program->start_date || $program->end_date)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                    <p class="text-gray-900">
                        <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        @if($program->start_date)
                            {{ $program->start_date->format('M d, Y') }}
                        @endif
                        @if($program->start_date && $program->end_date)
                            -
                        @endif
                        @if($program->end_date)
                            {{ $program->end_date->format('M d, Y') }}
                        @endif
                    </p>
                </div>
                @endif

                <!-- Beneficiaries -->
                @if($program->beneficiaries > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Beneficiaries</label>
                    <p class="text-gray-900">
                        <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ number_format($program->beneficiaries) }} people
                    </p>
                </div>
                @endif

                <!-- Budget -->
                @if($program->budget)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Budget</label>
                    <p class="text-gray-900 font-semibold">
                        <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        ₦{{ number_format($program->budget, 2) }}
                    </p>
                </div>
                @endif

                <!-- Featured -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $program->is_featured ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $program->is_featured ? '⭐ Featured' : 'Not Featured' }}
                    </span>
                </div>

                <!-- Published -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Published</label>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $program->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $program->is_published ? '✓ Published' : '✗ Draft' }}
                    </span>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL Slug</label>
                    <p class="text-gray-600 text-sm font-mono bg-gray-50 px-2 py-1 rounded">
                        {{ $program->slug }}
                    </p>
                </div>

                <!-- Timestamps -->
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        Created: {{ $program->created_at->format('M d, Y \a\t h:i A') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Updated: {{ $program->updated_at->format('M d, Y \a\t h:i A') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
            
            <div class="space-y-3">
                <a href="{{ route('programs.show', $program->slug) }}" 
                   target="_blank"
                   class="w-full block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View on Website
                </a>

                <a href="{{ route('admin.programs.edit', $program) }}" 
                   class="w-full block text-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Program
                </a>

                <button type="button" 
                        onclick="confirmDelete()"
                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Program
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" action="{{ route('admin.programs.destroy', $program) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this program? This action cannot be undone.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endpush
