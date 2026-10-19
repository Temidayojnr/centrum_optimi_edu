@extends('admin.layouts.app')

@section('title', 'About Page')

@php
    $input = 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500';
    $label = 'block text-sm font-medium text-gray-700 mb-2';
    $introImage = $about['intro_image'] ?? null;
    $introImageUrl = $introImage && !\Illuminate\Support\Str::startsWith($introImage, ['http://', 'https://'])
        ? asset('storage/' . $introImage)
        : $introImage;
@endphp

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">About Page</h1>
            <p class="text-gray-600 mt-2">Edit the text shown on the public About Us page. Leave a field empty to restore its default text.</p>
        </div>
        <a href="{{ route('about') }}" target="_blank" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            View Page
        </a>
    </div>
</div>

@if($errors->any())
<div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
    <p class="text-red-700 font-medium mb-1">Please fix the following:</p>
    <ul class="list-disc list-inside text-sm text-red-600">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- Page Header -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Page Header</h3>
                <div class="space-y-4">
                    <div>
                        <label for="hero_title" class="{{ $label }}">Title</label>
                        <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $about['hero_title']) }}" class="{{ $input }}">
                    </div>
                    <div>
                        <label for="hero_subtitle" class="{{ $label }}">Subtitle</label>
                        <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ old('hero_subtitle', $about['hero_subtitle']) }}" class="{{ $input }}">
                    </div>
                </div>
            </div>

            <!-- What We Do -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Introduction ("What We Do")</h3>
                <div class="space-y-4">
                    <div>
                        <label for="intro_title" class="{{ $label }}">Heading</label>
                        <input type="text" name="intro_title" id="intro_title" value="{{ old('intro_title', $about['intro_title']) }}" class="{{ $input }}">
                    </div>
                    <div>
                        <label for="intro_body" class="{{ $label }}">Text</label>
                        <textarea name="intro_body" id="intro_body" rows="8" class="{{ $input }}">{{ old('intro_body', $about['intro_body']) }}</textarea>
                    </div>
                    <div>
                        <label for="quote_text" class="{{ $label }}">Highlighted Quote</label>
                        <textarea name="quote_text" id="quote_text" rows="3" class="{{ $input }}">{{ old('quote_text', $about['quote_text']) }}</textarea>
                    </div>
                    <div>
                        <label for="quote_author" class="{{ $label }}">Quote Author</label>
                        <input type="text" name="quote_author" id="quote_author" value="{{ old('quote_author', $about['quote_author']) }}" class="{{ $input }}">
                    </div>
                </div>
            </div>

            <!-- Vision, Mission, Objectives -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Mission, Vision & Objectives</h3>
                <div class="space-y-4">
                    <div>
                        <label for="vision" class="{{ $label }}">Vision</label>
                        <textarea name="vision" id="vision" rows="2" class="{{ $input }}">{{ old('vision', $about['vision']) }}</textarea>
                    </div>
                    <div>
                        <label for="mission" class="{{ $label }}">Mission</label>
                        <textarea name="mission" id="mission" rows="2" class="{{ $input }}">{{ old('mission', $about['mission']) }}</textarea>
                    </div>
                    <div>
                        <label for="objectives" class="{{ $label }}">Specific Objectives</label>
                        <textarea name="objectives" id="objectives" rows="5" class="{{ $input }}">{{ old('objectives', $about['objectives']) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">One objective per line. Each line becomes a numbered item.</p>
                    </div>
                </div>
            </div>

            <!-- Core Values -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Core Values</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(range(1, 4) as $i)
                    <div class="space-y-3 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label for="value_{{ $i }}_title" class="{{ $label }}">Value {{ $i }} Title</label>
                            <input type="text" name="value_{{ $i }}_title" id="value_{{ $i }}_title" value="{{ old("value_{$i}_title", $about["value_{$i}_title"]) }}" class="{{ $input }}">
                        </div>
                        <div>
                            <label for="value_{{ $i }}_text" class="{{ $label }}">Description</label>
                            <textarea name="value_{{ $i }}_text" id="value_{{ $i }}_text" rows="2" class="{{ $input }}">{{ old("value_{$i}_text", $about["value_{$i}_text"]) }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Board of Trustees -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Board of Trustees</h3>
                <div class="space-y-6">
                    @foreach(range(1, 3) as $i)
                    <div class="p-4 bg-gray-50 rounded-lg space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label for="trustee_{{ $i }}_name" class="{{ $label }}">Trustee {{ $i }} Name</label>
                                <input type="text" name="trustee_{{ $i }}_name" id="trustee_{{ $i }}_name" value="{{ old("trustee_{$i}_name", $about["trustee_{$i}_name"]) }}" class="{{ $input }}">
                            </div>
                            <div>
                                <label for="trustee_{{ $i }}_role" class="{{ $label }}">Role</label>
                                <input type="text" name="trustee_{{ $i }}_role" id="trustee_{{ $i }}_role" value="{{ old("trustee_{$i}_role", $about["trustee_{$i}_role"]) }}" class="{{ $input }}">
                            </div>
                        </div>
                        <div>
                            <label for="trustee_{{ $i }}_bio" class="{{ $label }}">Biography</label>
                            <textarea name="trustee_{{ $i }}_bio" id="trustee_{{ $i }}_bio" rows="4" class="{{ $input }}">{{ old("trustee_{$i}_bio", $about["trustee_{$i}_bio"]) }}</textarea>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        <label for="board_quote" class="{{ $label }}">Board Quote</label>
                        <textarea name="board_quote" id="board_quote" rows="3" class="{{ $input }}">{{ old('board_quote', $about['board_quote']) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Call to Action (bottom of page)</h3>
                <div class="space-y-4">
                    <div>
                        <label for="cta_title" class="{{ $label }}">Heading</label>
                        <input type="text" name="cta_title" id="cta_title" value="{{ old('cta_title', $about['cta_title']) }}" class="{{ $input }}">
                    </div>
                    <div>
                        <label for="cta_text" class="{{ $label }}">Text</label>
                        <textarea name="cta_text" id="cta_text" rows="2" class="{{ $input }}">{{ old('cta_text', $about['cta_text']) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6 lg:sticky lg:top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Introduction Image</h3>
                @if($introImageUrl)
                    <img src="{{ $introImageUrl }}" alt="Current about image" class="w-full h-48 object-cover rounded-lg mb-4">
                @endif
                <input type="file" name="intro_image_file" id="intro_image_file" accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100">
                <p class="mt-1 text-xs text-gray-500">JPG, PNG or WebP, max 2MB.</p>
                @if($introImage && !\Illuminate\Support\Str::startsWith($introImage, ['http://', 'https://']))
                    <label class="flex items-center mt-3 text-sm text-gray-700">
                        <input type="checkbox" name="remove_intro_image" value="1" class="rounded border-gray-300 text-gold-600 focus:ring-gold-500 mr-2">
                        Remove uploaded image (use default)
                    </label>
                @endif

                <button type="submit" class="mt-6 w-full px-6 py-3 bg-gold-600 text-white font-semibold rounded-lg hover:bg-gold-700 transition-colors">
                    Save Changes
                </button>
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
        $('#intro_body').summernote({
            height: 250,
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        });
    });
</script>
@endpush
