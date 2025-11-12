@extends('admin.layouts.app')

@section('title', 'System Logs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
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
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('admin.logs.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- File Selector -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-file-alt mr-1"></i> Log File
                    </label>
                    <select name="file" id="file" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
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
                        <i class="fas fa-filter mr-1"></i> Log Level
                    </label>
                    <select name="level" id="level" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
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
                        <i class="fas fa-search mr-1"></i> Search
                    </label>
                    <input type="text" name="search" id="search" value="{{ $search }}"
                           placeholder="Search in messages..."
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                </div>

                <!-- Actions -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-cog mr-1"></i> Actions
                    </label>
                    <div class="flex space-x-2">
                        <button type="submit" 
                                class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('admin.logs.index') }}" 
                           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- File Actions -->
        <div class="mt-4 pt-4 border-t border-gray-200 flex flex-wrap gap-2">
            <a href="{{ route('admin.logs.download', $selectedFile) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                <i class="fas fa-download mr-1"></i> Download
            </a>
            <button onclick="confirmClear()" 
                    class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors text-sm">
                <i class="fas fa-eraser mr-1"></i> Clear
            </button>
            <button onclick="confirmDelete()" 
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
                <i class="fas fa-trash mr-1"></i> Delete
            </button>
            <button onclick="location.reload()" 
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                <i class="fas fa-sync mr-1"></i> Refresh
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Entries</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($total) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Showing</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ min(($currentPage - 1) * $perPage + 1, $total) }} - {{ min($currentPage * $perPage, $total) }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Current File</p>
                <p class="text-lg font-semibold text-gray-900">{{ $selectedFile }}</p>
            </div>
        </div>
    </div>

    <!-- Log Entries -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if(count($logs) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Timestamp
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Level
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Message
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($logs as $index => $log)
                            <tr class="hover:bg-gray-50 transition-colors cursor-pointer" 
                                onclick="toggleDetails({{ $index }})">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <i class="fas fa-clock mr-1 text-gray-400"></i>
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
                                        $levelIcons = [
                                            'emergency' => 'fa-skull-crossbones',
                                            'alert' => 'fa-exclamation-triangle',
                                            'critical' => 'fa-bomb',
                                            'error' => 'fa-times-circle',
                                            'warning' => 'fa-exclamation-circle',
                                            'notice' => 'fa-info-circle',
                                            'info' => 'fa-check-circle',
                                            'debug' => 'fa-bug',
                                        ];
                                        $colorClass = $levelColors[$log['level']] ?? 'bg-gray-500 text-white';
                                        $iconClass = $levelIcons[$log['level']] ?? 'fa-circle';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }}">
                                        <i class="fas {{ $iconClass }} mr-1"></i>
                                        {{ strtoupper($log['level']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="flex items-start">
                                        <div class="flex-1">
                                            <div class="font-medium line-clamp-2">
                                                {{ Str::limit(explode("\n", $log['message'])[0], 150) }}
                                            </div>
                                            <div id="details-{{ $index }}" class="hidden mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                                <pre class="text-xs whitespace-pre-wrap font-mono text-gray-800">{{ $log['message'] }}</pre>
                                            </div>
                                        </div>
                                        <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform" id="icon-{{ $index }}"></i>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

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
    function toggleDetails(index) {
        const details = document.getElementById('details-' + index);
        const icon = document.getElementById('icon-' + index);
        
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            details.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    function confirmClear() {
        if (confirm('Are you sure you want to clear this log file? This will remove all entries but keep the file.')) {
            document.getElementById('clearForm').submit();
        }
    }

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this log file? This action cannot be undone.')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Auto-refresh every 30 seconds if on first page with no filters
    @if($currentPage === 1 && $level === 'all' && empty($search))
        setTimeout(function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('page') || urlParams.get('page') === '1') {
                location.reload();
            }
        }, 30000);
    @endif
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .rotate-180 {
        transform: rotate(180deg);
    }

    .transition-transform {
        transition: transform 0.2s ease-in-out;
    }
</style>
@endsection
