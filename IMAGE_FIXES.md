# Image Display Fixes

## Problem
Images were not displaying after upload because:
1. Storage symlink was missing (`public/storage` → `storage/app/public`)
2. Inconsistent field names in views (`image`, `image_url` vs database column names)
3. Mixed use of `Storage::url()` and `asset('storage/')` helpers

## Solutions Applied

### 1. Created Storage Symlink
```bash
php artisan storage:link
```
This creates a symbolic link from `public/storage` to `storage/app/public`, making uploaded files accessible via the web.

### 2. Fixed Field Name Inconsistencies

#### Posts (Correct: `featured_image`)
- ✅ `resources/views/admin/posts/index.blade.php` - Already correct
- ✅ `resources/views/admin/posts/create.blade.php` - Already correct
- ✅ `resources/views/blog/index.blade.php` - Already correct
- ✅ `resources/views/blog/show.blade.php` - Already correct

#### Programs (Fixed: `image` → `featured_image`)
- ✅ `resources/views/admin/programs/index.blade.php` - Changed `$program->image` to `$program->featured_image`
- ✅ `resources/views/admin/programs/create.blade.php` - Changed field name from `image` to `featured_image`
- ✅ `resources/views/programs/index.blade.php` - Changed `$program->image` to `$program->featured_image`
- ✅ `resources/views/programs/show.blade.php` - Changed `$program->image` to `$program->featured_image`

#### Gallery Items (Fixed: `image_url` → `file_path`)
- ✅ `resources/views/gallery.blade.php` - Changed `$item->image_url` to `$item->file_path`
- ✅ `resources/views/programs/show.blade.php` - Changed `$item->image_url` to `$item->file_path`
- ✅ `resources/views/admin/gallery/index.blade.php` - Already using `file_path` correctly

### 3. Standardized Image URL Helper

Changed from mixed usage to consistent `asset('storage/' . $path)` syntax:
- ✅ `resources/views/welcome.blade.php` - Changed 3 instances from `Storage::url()` to `asset('storage/')`

## Database Schema Reference

### Programs Table
```php
$table->string('featured_image')->nullable();
```

### Posts Table
```php
$table->string('featured_image')->nullable();
```

### Gallery Items Table
```php
$table->string('file_path');
```

## How Images Work Now

1. **Upload**: Images are stored in `storage/app/public/[folder]/`
2. **Symlink**: `public/storage` → `storage/app/public`
3. **Display**: `asset('storage/[folder]/[filename]')` generates URL: `http://localhost:8000/storage/[folder]/[filename]`

## Testing Checklist

- [x] Blog posts show featured images in admin list
- [x] Blog posts show featured images on public blog pages
- [x] Programs show featured images in admin list
- [x] Programs show featured images on programs pages
- [x] Gallery items display correctly on gallery page
- [x] Gallery items display correctly in program detail pages
- [x] Image uploads work for posts
- [x] Image uploads work for programs
- [x] Image uploads work for gallery items

## Files Modified

1. `resources/views/welcome.blade.php` - 3 changes
2. `resources/views/admin/programs/index.blade.php` - 1 change
3. `resources/views/admin/programs/create.blade.php` - 2 changes
4. `resources/views/programs/index.blade.php` - 1 change
5. `resources/views/programs/show.blade.php` - 2 changes
6. `resources/views/gallery.blade.php` - 1 change

**Total: 6 files, 10 changes**

## Prevention

To prevent this issue in the future:
1. Always run `php artisan storage:link` after fresh installation
2. Use consistent field naming across migrations and views
3. Stick to one image URL helper method (preferably `asset('storage/')`)
4. Reference database migrations when displaying model attributes
