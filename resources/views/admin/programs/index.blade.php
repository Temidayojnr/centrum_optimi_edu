@extends('admin.layouts.app')

@section('title', 'Programs')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Programs</h1>
        <p class="text-gray-600 mt-2">Manage educational programs and initiatives</p>
    </div>
    <a href="{{ route('admin.programs.create') }}" class="btn-primary">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add New Program
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-md p-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-[200px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search programs..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500">
        </div>
        <div>
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            </select>
        </div>
        <button type="submit" class="px-6 py-2 bg-gold-600 text-white rounded-lg hover:bg-gold-700 transition-colors">
            Filter
        </button>
        @if(request()->anyFilled(['search', 'status']))
        <a href="{{ route('admin.programs.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
            Clear
        </a>
        @endif
    </form>
</div>

<!-- Programs Table -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    @if($programs->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Funding</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beneficiaries</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($programs as $program)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($program->featured_image)
                            <img src="{{ asset('storage/' . $program->featured_image) }}" alt="{{ $program->title }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                            @else
                            <div class="w-12 h-12 rounded-lg bg-gold-100 flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $program->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($program->short_description ?? $program->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ 
                            $program->status === 'active' ? 'bg-green-100 text-green-800' : 
                            ($program->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') 
                        }}">
                            {{ ucfirst($program->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $program->location ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($program->target_amount)
                        <div class="space-y-1">
                            <div class="text-gray-900 font-medium">₦{{ number_format($program->raised_amount ?? 0, 0) }}</div>
                            <div class="text-gray-500 text-xs">of ₦{{ number_format($program->target_amount, 0) }}</div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                @php
                                    $percentage = $program->target_amount > 0 ? min(100, ($program->raised_amount / $program->target_amount) * 100) : 0;
                                @endphp
                                <div class="bg-gold-600 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        @else
                        <span class="text-gray-400">Not set</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $program->beneficiaries_count ? number_format($program->beneficiaries_count) : 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ 
                            $program->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' 
                        }}">
                            {{ $program->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                        <a href="{{ route('programs.show', $program->slug) }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-900" title="View">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('admin.programs.edit', $program) }}" 
                           class="text-gold-600 hover:text-gold-900" title="Edit">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <button onclick="deleteProgram('{{ $program->slug }}')" 
                                class="text-red-600 hover:text-red-900" title="Delete">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t">
        {{ $programs->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No programs found</h3>
        <p class="mt-2 text-gray-500">Get started by creating a new program.</p>
        <a href="{{ route('admin.programs.create') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-gold-600 text-white rounded-lg hover:bg-gold-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add First Program
        </a>
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Delete Program?</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this program? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Cancel
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deleteProgram(slug) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    
    modal.classList.remove('hidden');
    form.action = `/admin/programs/${slug}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endpush
@endsection
