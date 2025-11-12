<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogViewerController extends Controller
{
    protected $logPath;
    protected $logsPerPage = 50;

    public function __construct()
    {
        $this->logPath = storage_path('logs');
    }

    /**
     * Display the log viewer interface
     */
    public function index(Request $request)
    {
        $logFiles = $this->getLogFiles();
        $selectedFile = $request->get('file', 'laravel.log');
        $level = $request->get('level', 'all');
        $search = $request->get('search', '');

        // Get log entries
        $logs = $this->parseLogFile($selectedFile, $level, $search);

        // Pagination
        $perPage = $this->logsPerPage;
        $currentPage = $request->get('page', 1);
        $total = count($logs);
        $logs = array_slice($logs, ($currentPage - 1) * $perPage, $perPage);

        return view('admin.logs.index', compact(
            'logs',
            'logFiles',
            'selectedFile',
            'level',
            'search',
            'total',
            'currentPage',
            'perPage'
        ));
    }

    /**
     * Get all log files from storage/logs
     */
    protected function getLogFiles()
    {
        if (!File::exists($this->logPath)) {
            return [];
        }

        $files = File::files($this->logPath);
        $logFiles = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'log') {
                $logFiles[] = [
                    'name' => $file->getFilename(),
                    'size' => $this->formatBytes($file->getSize()),
                    'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                ];
            }
        }

        // Sort by modified time (newest first)
        usort($logFiles, function ($a, $b) {
            return strtotime($b['modified']) - strtotime($a['modified']);
        });

        return $logFiles;
    }

    /**
     * Parse log file and extract entries
     */
    protected function parseLogFile($filename, $level = 'all', $search = '')
    {
        $filePath = $this->logPath . '/' . $filename;

        if (!File::exists($filePath)) {
            return [];
        }

        $content = File::get($filePath);
        $logs = [];
        $pattern = '/\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})\]\s(\w+)\.(\w+):\s(.*?)(?=\[\d{4}-\d{2}-\d{2}|$)/s';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $logLevel = strtolower($match[3]);
            $message = trim($match[4]);

            // Filter by level
            if ($level !== 'all' && $logLevel !== strtolower($level)) {
                continue;
            }

            // Filter by search term
            if (!empty($search) && stripos($message, $search) === false) {
                continue;
            }

            $logs[] = [
                'timestamp' => $match[1],
                'environment' => $match[2],
                'level' => $logLevel,
                'message' => $message,
            ];
        }

        // Return newest first
        return array_reverse($logs);
    }

    /**
     * Download log file
     */
    public function download($filename)
    {
        $filePath = $this->logPath . '/' . $filename;

        if (!File::exists($filePath)) {
            abort(404, 'Log file not found');
        }

        return response()->download($filePath);
    }

    /**
     * Delete log file
     */
    public function delete($filename)
    {
        $filePath = $this->logPath . '/' . $filename;

        if (!File::exists($filePath)) {
            return redirect()->route('admin.logs.index')
                ->with('error', 'Log file not found');
        }

        // Don't delete current day's log
        if ($filename === 'laravel.log' || $filename === date('Y-m-d') . '.log') {
            return redirect()->route('admin.logs.index')
                ->with('error', 'Cannot delete current log file');
        }

        File::delete($filePath);

        return redirect()->route('admin.logs.index')
            ->with('success', 'Log file deleted successfully');
    }

    /**
     * Clear log file content
     */
    public function clear($filename)
    {
        $filePath = $this->logPath . '/' . $filename;

        if (!File::exists($filePath)) {
            return redirect()->route('admin.logs.index')
                ->with('error', 'Log file not found');
        }

        File::put($filePath, '');

        return redirect()->route('admin.logs.index')
            ->with('success', 'Log file cleared successfully');
    }

    /**
     * Format bytes to human readable size
     */
    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
