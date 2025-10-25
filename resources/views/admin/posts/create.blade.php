@extends('admin.layouts.app')

@section('title', isset($post) ? 'Edit Post' : 'Create Post')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h1>
            <p class="text-gray-600 mt-2">{{ isset($post) ? 'Update blog post' : 'Write a new blog post' }}</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Posts
        </a>
    </div>
</div>

<form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $post->title ?? '') }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea name="excerpt" 
                                  id="excerpt" 
                                  rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Brief summary for listings (max 500 characters)</p>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                        <textarea name="content" 
                                  id="content" 
                                  rows="15"
                                  required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('content') border-red-500 @enderror">{{ old('content', $post->content ?? '') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Publish Settings -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Publish</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" 
                                id="status" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('status') border-red-500 @enderror">
                            <option value="draft" {{ old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Publish Date</label>
                        <input type="datetime-local" 
                               name="published_at" 
                               id="published_at" 
                               value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('published_at') border-red-500 @enderror">
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Leave empty to publish immediately</p>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               id="is_featured" 
                               value="1"
                               {{ old('is_featured', $post->is_featured ?? false) ? 'checked' : '' }}
                               class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                        <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">
                            Feature this post
                        </label>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Featured Image</h3>
                
                @if(isset($post) && $post->featured_image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         alt="Current image" 
                         class="w-full h-48 object-cover rounded-lg">
                </div>
                @endif

                <div>
                    <input type="file" 
                           name="featured_image" 
                           id="featured_image" 
                           accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 @error('featured_image') border-red-500 @enderror">
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF (Max 2MB)</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="space-y-3">
                    <button type="submit" class="w-full px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ isset($post) ? 'Update Post' : 'Create Post' }}
                    </button>
                    
                    <a href="{{ route('admin.posts.index') }}" 
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
        $('#content').summernote({
            height: 400,
            placeholder: 'Write your blog post content here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: [
                'p',
                { title: 'Heading 2', tag: 'h2', className: '', value: 'h2' },
                { title: 'Heading 3', tag: 'h3', className: '', value: 'h3' },
                { title: 'Heading 4', tag: 'h4', className: '', value: 'h4' },
                { title: 'Blockquote', tag: 'blockquote', className: '', value: 'blockquote' }
            ],
            fontNames: ['Arial', 'Comic Sans MS', 'Courier New', 'Georgia', 'Helvetica', 'Times New Roman', 'Verdana'],
            fontSizes: ['8', '10', '12', '14', '16', '18', '20', '24', '28', '32', '36', '48'],
            callbacks: {
                onInit: function() {
                    console.log('✅ Summernote initialized successfully!');
                }
            }
        });
    });
</script>
@endpush
