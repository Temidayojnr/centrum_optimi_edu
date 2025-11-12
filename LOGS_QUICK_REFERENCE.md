# System Logs Viewer - Quick Reference

## 🚀 Quick Start

### Access
```
URL: https://yourdomain.com/admin/logs
Login: Super Admin account required
```

### Navigation
Admin Panel → Sidebar → System Logs (bottom section)

---

## 🎯 Common Tasks

### View Latest Errors
1. Open System Logs
2. Select "Error" from Log Level dropdown
3. Review red-colored entries

### Search for Specific Issue
1. Type search term in Search box
2. Click filter button
3. Click row to expand details

### Download Log File
1. Select log file from dropdown
2. Click "Download" button
3. File downloads to your computer

### Clear Old Logs
1. Select log file to clear
2. Click "Clear" button
3. Confirm action
4. File contents removed

---

## 🎨 Log Level Colors

| Level | Color | Icon | Severity |
|-------|-------|------|----------|
| Emergency | Dark Red | 💀 | Critical system failure |
| Alert | Red | ⚠️ | Immediate action required |
| Critical | Red | 💣 | Critical conditions |
| Error | Red | ❌ | Error conditions |
| Warning | Yellow | ⚠️ | Warning conditions |
| Notice | Blue | ℹ️ | Normal but significant |
| Info | Green | ✅ | Informational messages |
| Debug | Gray | 🐛 | Debug-level messages |

---

## 🔧 Quick Filters

### By Time
- Current: `laravel.log`
- Yesterday: `laravel-YYYY-MM-DD.log`

### By Severity
- Critical Issues: Filter "Emergency" + "Alert" + "Critical"
- Errors Only: Filter "Error"
- All Issues: Filter "Warning" + "Error"
- Everything: Select "All Levels"

---

## ⚡ Keyboard Shortcuts

| Action | Method |
|--------|--------|
| Refresh | Click refresh button or reload page |
| Search | Type in search box + Enter |
| Expand Entry | Click on row |
| Navigate Pages | Click page numbers at bottom |

---

## 🛡️ Security Features

✅ Super Admin access only
✅ Authentication required
✅ CSRF protected actions
✅ Secure file handling
✅ Cannot delete current logs

---

## 📊 Interface Features

### Top Controls
- **Log File Selector**: Switch between log files
- **Level Filter**: Filter by severity
- **Search Box**: Search in messages
- **Action Buttons**: Filter, Reset, Download, Clear, Delete, Refresh

### Statistics Bar
- Total entries found
- Current range showing
- Selected file name

### Log Table
- **Timestamp**: When logged
- **Level Badge**: Color-coded severity
- **Message**: Log content (click to expand)

### Bottom Pagination
- Shows: "X to Y of Z entries"
- Navigation: Previous, 1, 2, 3, Next

---

## 🚨 Warning Messages

### Clear Log
```
"Are you sure you want to clear this log file? 
This will remove all entries but keep the file."
```
→ Empties file, keeps structure

### Delete Log
```
"Are you sure you want to delete this log file? 
This action cannot be undone."
```
→ Permanently removes file

### Error: Cannot Delete
```
"Cannot delete current log file"
```
→ Protection for active logs

---

## 🔍 Search Tips

### Exact Match
```
Search: "User not found"
Result: Entries with exact phrase
```

### Partial Match
```
Search: "payment"
Result: All entries mentioning payment
```

### Case Insensitive
```
Search: "ERROR" or "error"
Result: Both return same results
```

---

## 📁 File Management

### Auto-Refresh
- Enabled on main page (no filters)
- Refreshes every 30 seconds
- Keeps you updated automatically

### File Sizes
- **Small**: < 1 MB (fast loading)
- **Medium**: 1-10 MB (moderate)
- **Large**: > 10 MB (may be slow)

**Tip**: Archive files over 5 MB

---

## 💡 Best Practices

### Daily
- [ ] Check for new errors (morning)
- [ ] Review critical/emergency logs
- [ ] Monitor error trends

### Weekly
- [ ] Download logs for archive
- [ ] Clear resolved error logs
- [ ] Check file sizes

### Monthly
- [ ] Delete old archived logs
- [ ] Review logging patterns
- [ ] Optimize if needed

---

## 🎓 Understanding Log Entries

### Standard Format
```
[2025-11-12 10:30:45] local.ERROR: Error message here
```

**Parts**:
- `[2025-11-12 10:30:45]` - Timestamp
- `local` - Environment (local/production)
- `ERROR` - Log level
- `Error message here` - Actual message

### With Context
```
[2025-11-12 10:30:45] local.ERROR: Database connection failed
Context: {"host":"localhost","port":3306,"user":"root"}
```

### With Stack Trace
```
[2025-11-12 10:30:45] local.ERROR: Class not found
Stack trace:
#0 /path/to/file.php(123): function()
#1 /path/to/another.php(456): another()
```

**Click row to expand and view full details**

---

## 🔧 Troubleshooting

### Problem: No logs showing
**Solution**: Check filters, file selection, refresh page

### Problem: Can't access
**Solution**: Verify Super Admin role, clear cache

### Problem: Page slow
**Solution**: Archive large logs, use filters

### Problem: Can't download
**Solution**: Check file permissions, try refresh

---

## 📞 Quick Commands (Terminal)

### Generate Test Logs
```bash
php artisan tinker --execute="Log::error('Test error');"
```

### Check Routes
```bash
php artisan route:list --name=admin.logs
```

### Clear Cache
```bash
php artisan cache:clear
```

### View Latest Logs (Terminal)
```bash
tail -f storage/logs/laravel.log
```

---

## 📌 Bookmarks

### Direct Links
- Main Viewer: `/admin/logs`
- With Errors: `/admin/logs?level=error`
- With Search: `/admin/logs?search=payment`

---

## ✨ Feature Highlights

🔒 **Secure** - Super Admin only
🔍 **Searchable** - Find issues fast
🎨 **Visual** - Color-coded levels
📊 **Stats** - Entry counts & ranges
🔄 **Live** - Auto-refresh
📥 **Export** - Download logs
🧹 **Clean** - Clear/delete files
📱 **Responsive** - Works on mobile
⚡ **Fast** - Pagination for speed
🎯 **Accurate** - Precise parsing

---

**Need detailed help?** See `SYSTEM_LOGS_DOCUMENTATION.md`
**Last Updated**: November 12, 2025
