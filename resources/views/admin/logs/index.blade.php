@extends('admin.layouts.app')

@section('title', 'System Logs')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">System Logs</h1>
        <p class="text-gray-600">Monitor application logs and errors for debugging</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Controls -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('admin.logs.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- File Selector -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Log File
                    </label>
                    <select name="file" id="file" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            onchange="this.form.submit()">
                        @foreach($logFiles as $logFile)
                            <option value="{{ $logFile['name'] }}" {{ $selectedFile === $logFile['name'] ? 'selected' : '' }}>
                                {{ $logFile['name'] }} ({{ $logFile['size'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Level Filter -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-2">
                        Log Level
                    </label>
                    <select name="level" id="level" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            onchange="this.form.submit()">
                        <option value="all" {{ $level === 'all' ? 'selected' : '' }}>All Levels</option>
                        <option value="emergency" {{ $level === 'emergency' ? 'selected' : '' }}>Emergency</option>
                        <option value="alert" {{ $level === 'alert' ? 'selected' : '' }}>Alert</option>
                        <option value="critical" {{ $level === 'critical' ? 'selected' : '' }}>Critical</option>
                        <option value="error" {{ $level === 'error' ? 'selected' : '' }}>Error</option>
                        <option value="warning" {{ $level === 'warning' ? 'selected' : '' }}>Warning</option>
                        <option value="notice" {{ $level === 'notice' ? 'selected' : '' }}>Notice</option>
                        <option value="info" {{ $level === 'info' ? 'selected' : '' }}>Info</option>
                        <option value="debug" {{ $level === 'debug' ? 'selected' : '' }}>Debug</option>
                    </select>
                </div>

                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        Search
                    </label>
                    <input type="text" name="search" id="search" value="{{ $search }}"
                           placeholder="Search logs..."
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <!-- Actions -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Actions
                    </label>
                    <div class="flex space-x-2">
                        <button type="submit" 
                                class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                            Filter
                        </button>
                        <a href="{{ route('admin.logs.index') }}" 
                           class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- File Actions -->
        <div class="mt-4 pt-4 border-t flex flex-wrap gap-2">
            <a href="{{ route('admin.logs.download', $selectedFile) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Download
            </a>
            <button onclick="confirmClear()" 
                    class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                Clear
            </button>
            <button onclick="confirmDelete()" 
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Delete
            </button>
            <button onclick="location.reload()" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Refresh
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Entries</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($total) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Showing</p>
                <p class="text-3xl font-bold text-gray-900">
                    {{ min(($currentPage - 1) * $perPage + 1, $total) }} - {{ min($currentPage * $perPage, $total) }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Current File</p>
                <p class="text-xl font-semibold text-gray-900">{{ $selectedFile }}</p>
            </div>
        </div>
    </div>

    <!-- Log Entries -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if(count($logs) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">
                            Timestamp
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">
                            Level
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">
                            Message
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($logs as $index => $log)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $log['timestamp'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $levelColors = [
                                        'emergency' => 'bg-red-900 text-white',
                                        'alert' => 'bg-red-700 text-white',
                                        'critical' => 'bg-red-600 text-white',
                                        'error' => 'bg-red-500 text-white',
                                        'warning' => 'bg-yellow-500 text-white',
                                        'notice' => 'bg-blue-500 text-white',
                                        'info' => 'bg-green-500 text-white',
                                        'debug' => 'bg-gray-500 text-white',
                                    ];
                                    $colorClass = $levelColors[$log['level']] ?? 'bg-gray-500 text-white';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full {{ $colorClass }}">
                                    {{ strtoupper($log['level']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-3">
                                    <div class="text-sm text-gray-900">
                                        {{ Str::limit(explode("\n", $log['message'])[0], 200) }}
                                    </div>
                                    
                                    <button 
                                        type="button"
                                        onclick="openModal({{ $index }})" 
                                        class="px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded hover:bg-yellow-700">
                                        View Full Details
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if($total > $perPage)
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing {{ min(($currentPage - 1) * $perPage + 1, $total) }} to {{ min($currentPage * $perPage, $total) }} of {{ number_format($total) }} entries
                        </div>
                        <div class="flex space-x-2">
                            @php
                                $totalPages = ceil($total / $perPage);
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                            @endphp

                            @if($currentPage > 1)
                                <a href="{{ route('admin.logs.index', array_merge(request()->query(), ['page' => $currentPage - 1])) }}" 
                                   class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            @for($i = $startPage; $i <= $endPage; $i++)
                                <a href="{{ route('admin.logs.index', array_merge(request()->query(), ['page' => $i])) }}" 
                                   class="px-3 py-2 border rounded-lg text-sm {{ $i === (int)$currentPage ? 'bg-yellow-600 text-white border-yellow-600' : 'bg-white border-gray-300 hover:bg-gray-50' }}">
                                    {{ $i }}
                                </a>
                            @endfor

                            @if($currentPage < $totalPages)
                                <a href="{{ route('admin.logs.index', array_merge(request()->query(), ['page' => $currentPage + 1])) }}" 
                                   class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-600 text-lg">No log entries found</p>
                <p class="text-gray-500 text-sm mt-2">Try adjusting your filters or search criteria</p>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="logModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-yellow-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Full Log Details</h3>
                        <p class="text-xs text-gray-500">
                            <span id="modalTimestamp"></span> | <span id="modalLevel"></span>
                        </p>
                    </div>
                </div>
                <button 
                    onclick="closeModal()" 
                    class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-200 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4 overflow-y-auto max-h-[calc(90vh-140px)]">
                <pre id="modalContent" class="text-sm font-mono text-gray-800 whitespace-pre-wrap leading-relaxed bg-gray-50 p-4 rounded border border-gray-200"></pre>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex items-center justify-between px-6 py-4 border-t bg-gray-50">
                <button 
                    onclick="copyToClipboard()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors">
                    <i class="fas fa-copy mr-2"></i>Copy to Clipboard
                </button>
                <button 
                    onclick="closeModal()" 
                    class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded hover:bg-gray-700 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden forms for actions -->
<form id="clearForm" method="POST" action="{{ route('admin.logs.clear', $selectedFile) }}" style="display: none;">
    @csrf
    @method('POST')
</form>

<form id="deleteForm" method="POST" action="{{ route('admin.logs.delete', $selectedFile) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    // Store log data
    const logData = [
        @foreach($logs as $index => $log)
        {
            timestamp: "{{ $log['timestamp'] }}",
            level: "{{ strtoupper($log['level']) }}",
            message: {!! json_encode($log['message']) !!}
        },
        @endforeach
    ];

    function openModal(index) {
        const log = logData[index];
        const modal = document.getElementById('logModal');
        const modalTimestamp = document.getElementById('modalTimestamp');
        const modalLevel = document.getElementById('modalLevel');
        const modalContent = document.getElementById('modalContent');
        
        // Set modal content
        modalTimestamp.textContent = log.timestamp;
        modalLevel.textContent = log.level;
        modalContent.textContent = log.message;
        
        // Show modal with animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('animate-fade-in');
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('logModal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-fade-in');
        
        // Restore body scroll
        document.body.style.overflow = 'auto';
    }

    function copyToClipboard() {
        const content = document.getElementById('modalContent').textContent;
        navigator.clipboard.writeText(content).then(() => {
            // Show success message
            const btn = event.target.closest('button');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
            btn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            btn.classList.add('bg-green-600', 'hover:bg-green-700');
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                btn.classList.add('bg-blue-600', 'hover:bg-blue-700');
            }, 2000);
        }).catch(err => {
            alert('Failed to copy to clipboard');
        });
    }

    // Close modal on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('logModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'logModal') {
            closeModal();
        }
    });

    function confirmClear() {
        if (confirm('Are you sure you want to clear this log file?')) {
            document.getElementById('clearForm').submit();
        }
    }

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this log file?')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.2s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    /* Custom scrollbar for modal */
    #modalContent {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 #f7fafc;
    }
    
    #modalContent::-webkit-scrollbar {
        width: 8px;
    }
    
    #modalContent::-webkit-scrollbar-track {
        background: #f7fafc;
        border-radius: 4px;
    }
    
    #modalContent::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }
    
    #modalContent::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
</style>

@endsection
