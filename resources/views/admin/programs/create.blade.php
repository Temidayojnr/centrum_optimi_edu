@extends('admin.layouts.app')

@section('title', isset($program) ? 'Edit Program' : 'Create Program')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ isset($program) ? 'Edit Program' : 'Create New Program' }}</h1>
            <p class="text-gray-600 mt-2">{{ isset($program) ? 'Update program details' : 'Add a new educational program' }}</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Programs
        </a>
    </div>
</div>

<form action="{{ isset($program) ? route('admin.programs.update', $program) : route('admin.programs.store') }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @if(isset($program))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Basic Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Program Name *</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $program->name ?? '') }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                        <textarea name="short_description" 
                                  id="short_description" 
                                  rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('short_description') border-red-500 @enderror">{{ old('short_description', $program->short_description ?? '') }}</textarea>
                        @error('short_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Brief summary for cards and listings (max 200 characters)</p>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Full Description *</label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('description') border-red-500 @enderror">{{ old('description', $program->description ?? '') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="objectives" class="block text-sm font-medium text-gray-700 mb-2">Program Objectives</label>
                        <textarea name="objectives" 
                                  id="objectives" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('objectives') border-red-500 @enderror">{{ old('objectives', $program->objectives ?? '') }}</textarea>
                        @error('objectives')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Details -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Program Details</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" 
                               name="location" 
                               id="location" 
                               value="{{ old('location', $program->location ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="beneficiaries_count" class="block text-sm font-medium text-gray-700 mb-2">Number of Beneficiaries</label>
                        <input type="number" 
                               name="beneficiaries_count" 
                               id="beneficiaries_count" 
                               value="{{ old('beneficiaries_count', $program->beneficiaries_count ?? '') }}"
                               min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('beneficiaries_count') border-red-500 @enderror">
                        @error('beneficiaries_count')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" 
                               name="start_date" 
                               id="start_date" 
                               value="{{ old('start_date', $program->start_date ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('start_date') border-red-500 @enderror">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" 
                               name="end_date" 
                               id="end_date" 
                               value="{{ old('end_date', $program->end_date ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('end_date') border-red-500 @enderror">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Funding -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Funding Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="target_amount" class="block text-sm font-medium text-gray-700 mb-2">Target Amount (₦)</label>
                        <input type="number" 
                               name="target_amount" 
                               id="target_amount" 
                               value="{{ old('target_amount', $program->target_amount ?? '') }}"
                               min="0"
                               step="0.01"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('target_amount') border-red-500 @enderror">
                        @error('target_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="raised_amount" class="block text-sm font-medium text-gray-700 mb-2">Raised Amount (₦)</label>
                        <input type="number" 
                               name="raised_amount" 
                               id="raised_amount" 
                               value="{{ old('raised_amount', $program->raised_amount ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('raised_amount') border-red-500 @enderror">
                        @error('raised_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Featured Image -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Featured Image</h3>
                
                @if(isset($program) && $program->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $program->image) }}" 
                         alt="Current image" 
                         class="w-full h-48 object-cover rounded-lg">
                </div>
                @endif

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ isset($program) && $program->image ? 'Change Image' : 'Upload Image' }}
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF (Max 2MB)</p>
                </div>
            </div>

            <!-- Status & Settings -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Status & Settings</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" 
                                id="status" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status', $program->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="upcoming" {{ old('status', $program->status ?? '') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="completed" {{ old('status', $program->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_published" 
                               id="is_published" 
                               value="1"
                               {{ old('is_published', $program->is_published ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                        <label for="is_published" class="ml-2 text-sm font-medium text-gray-700">
                            Publish this program
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               id="is_featured" 
                               value="1"
                               {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }}
                               class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                        <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">
                            Feature on homepage
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="space-y-3">
                    <button type="submit" class="w-full px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ isset($program) ? 'Update Program' : 'Create Program' }}
                    </button>
                    
                    <a href="{{ route('admin.programs.index') }}" 
                       class="w-full block text-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote for Description field
        $('#description').summernote({
            height: 300,
            placeholder: 'Describe the program in detail...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ],
            styleTags: [
                'p',
                { title: 'Heading 2', tag: 'h2', value: 'h2' },
                { title: 'Heading 3', tag: 'h3', value: 'h3' }
            ]
        });

        // Initialize Summernote for Objectives field
        $('#objectives').summernote({
            height: 200,
            placeholder: 'List program objectives...',
            toolbar: [
                ['font', ['bold', 'italic']],
                ['para', ['ul', 'ol']],
                ['view', ['codeview']]
            ]
        });

        console.log('✅ Summernote initialized for Programs!');
    });
</script>
@endpush
