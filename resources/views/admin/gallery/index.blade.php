@extends('admin.layouts.app')

@section('title', 'Manage Gallery')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Gallery Management</h1>
            <p class="text-gray-600 mt-2">Upload and manage photos and videos</p>
        </div>
        <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" 
                class="px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Upload Media
        </button>
    </div>
</div>

<!-- Gallery Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($galleryItems as $item)
    <div class="bg-white rounded-xl shadow-md overflow-hidden group">
        <div class="relative aspect-square">
            @if($item->type === 'image')
                <img src="{{ asset('storage/' . $item->file_path) }}" 
                     alt="{{ $item->title }}" 
                     class="w-full h-full object-cover">
            @else
                <video src="{{ asset('storage/' . $item->file_path) }}" 
                       class="w-full h-full object-cover"></video>
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                    </svg>
                </div>
            @endif
            
            <!-- Overlay on hover -->
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                <div class="flex space-x-2">
                    <button onclick="editItem({{ $item->id }})" 
                            class="p-2 bg-white rounded-full text-gold-600 hover:bg-gold-600 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="deleteItem({{ $item->id }})" 
                            class="p-2 bg-white rounded-full text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            @if($item->is_featured)
            <div class="absolute top-2 right-2">
                <span class="px-2 py-1 bg-gold-500 text-white text-xs font-semibold rounded-full">
                    Featured
                </span>
            </div>
            @endif
        </div>
        
        <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-1">{{ $item->title }}</h3>
            @if($item->program)
                <p class="text-xs text-gray-500 mb-2">{{ $item->program->name }}</p>
            @endif
            @if($item->description)
                <p class="text-sm text-gray-600">{{ Str::limit($item->description, 60) }}</p>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full">
        <div class="text-center py-12 bg-white rounded-xl shadow-md">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="mt-4 text-lg font-medium text-gray-900">No gallery items yet</p>
            <p class="mt-2 text-sm text-gray-500">Upload your first photo or video.</p>
            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" 
                    class="mt-4 px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700">
                Upload Media
            </button>
        </div>
    </div>
    @endforelse
</div>

@if($galleryItems->hasPages())
<div class="mt-6">
    {{ $galleryItems->links() }}
</div>
@endif

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Upload Media</h2>
                <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500"></textarea>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Upload File *</label>
                <input type="file" name="file" id="file" required accept="image/*,video/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500">
                <p class="mt-1 text-xs text-gray-500">Images or videos (Max 10MB)</p>
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select name="type" id="type" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500">
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                </select>
            </div>

            <div>
                <label for="program_id" class="block text-sm font-medium text-gray-700 mb-2">Associated Program</label>
                <select name="program_id" id="program_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500">
                    <option value="">None</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <input type="text" name="category" id="category"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                       class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">
                    Feature this item
                </label>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors font-semibold">
                    Upload
                </button>
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')"
                        class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/gallery/${id}`;
        form.submit();
    }
}

function editItem(id) {
    alert('Edit functionality coming soon!');
}
</script>
@endpush
