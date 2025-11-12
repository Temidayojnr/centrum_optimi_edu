# System Logs Viewer - Documentation

## Overview
Secure web-based log viewer for monitoring application logs, errors, and debugging issues in real-time. Accessible only to Super Admin users with comprehensive filtering, search, and management capabilities.

## Features

### 🔐 Security
- **Super Admin Only Access**: Protected by `super_admin` middleware
- **Authentication Required**: Must be logged into admin panel
- **No Public Access**: Routes secured behind authentication layer

### 📊 Log Management
- **Multiple Log Files**: View all log files in `storage/logs`
- **Real-time Updates**: Auto-refresh every 30 seconds on main page
- **File Information**: See file size and last modified date
- **Download Logs**: Export log files for external analysis
- **Clear Logs**: Empty log file contents while keeping the file
- **Delete Logs**: Remove old log files (protection for current logs)

### 🔍 Filtering & Search
- **Log Levels**: Filter by Emergency, Alert, Critical, Error, Warning, Notice, Info, Debug
- **Text Search**: Search within log messages
- **Pagination**: 50 entries per page with navigation
- **Expandable Entries**: Click to view full stack traces

### 🎨 User Interface
- **Color-Coded Badges**: Visual indicators for log levels
  - 🔴 Emergency/Alert/Critical/Error (Red variants)
  - 🟡 Warning (Yellow)
  - 🔵 Notice (Blue)
  - 🟢 Info (Green)
  - ⚫ Debug (Gray)
- **Responsive Design**: Works on desktop, tablet, and mobile
- **Clean Layout**: Easy to scan and read
- **Interactive**: Click rows to expand details

## Access

### URL
```
https://yourdomain.com/admin/logs
```

### Requirements
- Must be logged in to admin panel
- User role must be `super_admin`
- Other roles (admin, content_editor) cannot access

### Navigation
1. Login to admin panel
2. Look for "System Logs" in sidebar (bottom of menu)
3. Click to access log viewer

## Usage Guide

### Viewing Logs

1. **Select Log File**
   - Use the "Log File" dropdown to switch between files
   - Current date's log (`laravel.log`) shown by default
   - File size displayed next to name

2. **Filter by Level**
   - Select log level from dropdown
   - Options: All, Emergency, Alert, Critical, Error, Warning, Notice, Info, Debug
   - Instantly filters entries

3. **Search Messages**
   - Type search term in "Search" field
   - Click filter button or press enter
   - Searches within log messages

4. **View Details**
   - Click any log entry row
   - Expands to show full message and stack trace
   - Click again to collapse

### Managing Log Files

#### Download Log File
```
Purpose: Export log file for offline analysis or archiving
Action: Click "Download" button
Result: Browser downloads the selected log file
```

#### Clear Log File
```
Purpose: Empty log contents while keeping file structure
Action: Click "Clear" button → Confirm
Result: Log file contents removed, file remains
Warning: Cannot undo this action
```

#### Delete Log File
```
Purpose: Permanently remove old log files
Action: Click "Delete" button → Confirm
Result: Log file completely removed
Restrictions: Cannot delete current day's log file
Warning: Cannot undo this action
```

#### Refresh Logs
```
Purpose: Reload page to see latest entries
Action: Click "Refresh" button
Result: Page reloads with newest log entries
Note: Auto-refreshes every 30 seconds on main view
```

## Technical Details

### Controller
**File**: `app/Http/Controllers/Admin/LogViewerController.php`

**Methods**:
- `index()` - Main log viewer interface
- `getLogFiles()` - Retrieve all log files
- `parseLogFile()` - Parse and filter log entries
- `download()` - Download log file
- `clear()` - Clear log file contents
- `delete()` - Delete log file
- `formatBytes()` - Human-readable file sizes

### Routes
```php
// All routes protected by super_admin middleware
GET    /admin/logs                    - Main log viewer
GET    /admin/logs/download/{file}    - Download log file
POST   /admin/logs/clear/{file}       - Clear log file
DELETE /admin/logs/delete/{file}      - Delete log file
```

### View
**File**: `resources/views/admin/logs/index.blade.php`

**Features**:
- Responsive table layout
- Interactive row expansion
- Pagination controls
- Real-time statistics
- Auto-refresh functionality

### Middleware Stack
```
web → admin → super_admin
```

## Log Parsing

### Format Recognition
Laravel's default log format:
```
[2025-11-12 10:30:45] local.ERROR: Error message here
```

### Pattern Matching
```regex
/\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})\]\s(\w+)\.(\w+):\s(.*?)(?=\[\d{4}-\d{2}-\d{2}|$)/s
```

**Captures**:
1. Timestamp (YYYY-MM-DD HH:MM:SS)
2. Environment (local, production, staging)
3. Log Level (info, warning, error, etc.)
4. Message (full content including stack traces)

## Performance

### Optimization
- **Indexed Parsing**: Efficient regex pattern matching
- **Pagination**: Only loads 50 entries at a time
- **On-Demand Expansion**: Stack traces loaded but hidden until clicked
- **File Caching**: Browser caches static assets

### Considerations
- Large log files (>10MB) may take longer to parse
- Consider archiving old logs regularly
- Use log rotation for production environments

## Security Best Practices

### Access Control
✅ **Implemented**:
- Super Admin only access
- Authentication required
- CSRF protection on actions
- Secure file path handling

### Recommendations
1. **Regular Monitoring**: Check logs daily for errors
2. **Archive Old Logs**: Download and delete logs older than 30 days
3. **Sensitive Data**: Ensure no passwords/tokens in logs
4. **Production Logs**: Use log rotation (daily/weekly)

## Common Use Cases

### 1. Debugging Application Errors
```
1. Navigate to System Logs
2. Filter by "Error" level
3. Search for specific error message
4. Click row to view stack trace
5. Identify file and line number
6. Fix issue in code
```

### 2. Monitoring User Actions
```
1. Filter by "Info" level
2. Search for specific user email or action
3. Review timestamp and details
4. Track user behavior patterns
```

### 3. Security Audit
```
1. Filter by "Warning" or "Critical"
2. Look for suspicious activities
3. Check authentication failures
4. Review unauthorized access attempts
```

### 4. Performance Issues
```
1. Search for "slow" or "timeout"
2. Filter by "Warning" level
3. Identify bottlenecks
4. Review database query logs
```

## Troubleshooting

### No Logs Showing
**Problem**: Log viewer shows "No log entries found"

**Solutions**:
- Check if log file exists in `storage/logs`
- Verify file permissions (should be writable)
- Ensure logging is enabled in `config/logging.php`
- Check if filters are too restrictive

### Cannot Access Log Viewer
**Problem**: 403 Forbidden or route not found

**Solutions**:
- Verify you're logged in as Super Admin
- Check user role in database (should be `super_admin`)
- Run `php artisan route:clear`
- Check middleware is properly configured

### File Too Large
**Problem**: Page loads slowly or times out

**Solutions**:
- Download and archive old logs
- Clear log file contents
- Implement log rotation
- Increase PHP memory limit temporarily

### Logs Not Updating
**Problem**: New logs not appearing

**Solutions**:
- Click "Refresh" button
- Check file write permissions
- Verify logging configuration
- Clear application cache: `php artisan cache:clear`

## Configuration

### Log Rotation (Recommended for Production)

**File**: `config/logging.php`

```php
'daily' => [
    'driver' => 'daily',
    'path' => storage_path('logs/laravel.log'),
    'level' => 'debug',
    'days' => 14, // Keep logs for 14 days
],
```

### Entries Per Page

**File**: `app/Http/Controllers/Admin/LogViewerController.php`

```php
protected $logsPerPage = 50; // Change to desired number
```

### Auto-Refresh Interval

**File**: `resources/views/admin/logs/index.blade.php`

```javascript
// Change 30000 (30 seconds) to desired interval in milliseconds
setTimeout(function() {
    location.reload();
}, 30000);
```

## Testing

### Generate Test Logs
```bash
php artisan tinker
```

```php
// In Tinker
Log::info('Test information message');
Log::warning('Test warning message');
Log::error('Test error message', ['user_id' => 123]);
Log::critical('Critical system failure', ['component' => 'database']);
```

### Test Cases
- [ ] Access as Super Admin - Should work
- [ ] Access as Admin - Should get 403
- [ ] Access as Content Editor - Should get 403
- [ ] Access without login - Should redirect to login
- [ ] Filter by error level - Should show only errors
- [ ] Search for specific text - Should find matching entries
- [ ] Download log file - Should download successfully
- [ ] Clear log file - Should empty contents
- [ ] Delete old log file - Should remove file
- [ ] Delete current log file - Should show error
- [ ] Pagination - Should navigate correctly
- [ ] Expand log entry - Should show full details
- [ ] Auto-refresh - Should reload after 30 seconds

## Maintenance

### Daily Tasks
- Review error logs for critical issues
- Check for unusual patterns or spikes

### Weekly Tasks
- Archive logs older than 7 days
- Clear resolved error logs
- Monitor log file sizes

### Monthly Tasks
- Delete archived logs older than 30 days
- Review and optimize logging configuration
- Audit log access for security

## API Reference

### GET /admin/logs
Display log viewer interface

**Parameters**:
- `file` (optional) - Log file name (default: laravel.log)
- `level` (optional) - Log level filter (default: all)
- `search` (optional) - Search term (default: empty)
- `page` (optional) - Page number (default: 1)

**Response**: HTML view with log entries

### GET /admin/logs/download/{file}
Download specific log file

**Parameters**:
- `file` (required) - Log file name

**Response**: File download

### POST /admin/logs/clear/{file}
Clear log file contents

**Parameters**:
- `file` (required) - Log file name

**Response**: Redirect with success/error message

### DELETE /admin/logs/delete/{file}
Delete log file

**Parameters**:
- `file` (required) - Log file name

**Response**: Redirect with success/error message

**Restrictions**: Cannot delete current day's log

## Support

### Need Help?
If you encounter issues with the log viewer:

1. **Check Documentation**: Review this document
2. **View Laravel Logs**: Check logs for error messages
3. **Test Permissions**: Ensure proper file permissions
4. **Clear Cache**: Run `php artisan cache:clear`
5. **Check Middleware**: Verify super_admin middleware is working

### Common Questions

**Q: Can I give access to regular admins?**
A: Yes, remove `super_admin` middleware from routes and add `admin` middleware instead

**Q: How do I export logs programmatically?**
A: Use the download route: `/admin/logs/download/{filename}`

**Q: Can I customize log levels?**
A: Yes, modify the level dropdown in `resources/views/admin/logs/index.blade.php`

**Q: How do I change the log format?**
A: Modify logging configuration in `config/logging.php`

**Q: Can I view logs from external sources?**
A: Currently only `storage/logs` directory. Extend controller for other sources.

## Files Modified/Created

### Created Files
1. `app/Http/Controllers/Admin/LogViewerController.php` - Main controller
2. `resources/views/admin/logs/index.blade.php` - Log viewer interface
3. `SYSTEM_LOGS_DOCUMENTATION.md` - This documentation

### Modified Files
1. `routes/web.php` - Added log viewer routes
2. `resources/views/admin/layouts/app.blade.php` - Added "System Logs" navigation link

---

**Version**: 1.0
**Created**: November 12, 2025
**Status**: ✅ Production Ready
**Access Level**: Super Admin Only
