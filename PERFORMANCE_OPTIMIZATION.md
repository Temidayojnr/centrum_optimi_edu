# Performance Optimization Guide - Centrum Optimi Website

## Current Status
- **PageSpeed Score:** 87/100 (Desktop)
- **Target:** 95-100/100
- **Date:** October 28, 2025

## ✅ Optimizations Implemented

### 1. Image Optimization
- ✅ Added `loading="lazy"` to all non-critical images (programs, posts, gallery)
- ✅ Added `loading="eager"` to critical above-the-fold images (hero, logo)
- ✅ Added explicit `width` and `height` attributes to all images
- ✅ Fixed Cumulative Layout Shift (CLS) issues

**Files Modified:**
- `resources/views/layouts/app.blade.php` - Logo with dimensions
- `resources/views/welcome.blade.php` - All images optimized

### 2. Browser Caching (293 KiB savings)
- ✅ Added comprehensive caching headers in `.htaccess`
- ✅ Set 1-year cache for images (jpg, png, webp, svg, ico)
- ✅ Set 1-year cache for CSS and JavaScript
- ✅ Set 1-year cache for fonts (woff, woff2, ttf, otf)
- ✅ Added `immutable` flag for static assets

**File Modified:**
- `public/.htaccess` - Full browser caching configuration

### 3. Compression & Minification
- ✅ Enabled Gzip compression for all text-based assets
- ✅ Configured Vite for production optimization
- ✅ Enabled Terser minification with console removal
- ✅ Enabled CSS code splitting

**File Modified:**
- `public/.htaccess` - Gzip compression
- `vite.config.js` - Build optimizations

### 4. Render-Blocking Resources (280ms savings)
- ✅ Added `preconnect` to external domains (fonts.googleapis.com, fonts.gstatic.com, images.unsplash.com)
- ✅ Added `dns-prefetch` for CDN resources
- ✅ Google Fonts already using `display=swap` for optimal loading

**File Modified:**
- `resources/views/layouts/app.blade.php` - Resource hints

### 5. JavaScript Optimization
- ✅ Code splitting configured (Alpine.js in separate chunk)
- ✅ Source maps disabled for production
- ✅ Console statements removed in production builds
- ✅ Tailwind CSS properly configured for tree-shaking

**Files Modified:**
- `vite.config.js` - Build optimization
- `tailwind.config.js` - Already optimized

## 🔄 Additional Recommendations for 100/100

### 1. Image Conversion to WebP Format
Convert all uploaded images to WebP format for better compression:

```bash
# Install image optimization package
composer require intervention/image

# Create a command to convert existing images
php artisan make:command OptimizeImages
```

Add to your upload logic:
```php
use Intervention\Image\Facades\Image;

// Convert to WebP
$image = Image::make($request->file('image'));
$image->encode('webp', 80)->save(storage_path('app/public/images/filename.webp'));
```

### 2. Implement CDN for Static Assets
- Use Cloudflare or AWS CloudFront
- Offload images, CSS, and JS to CDN
- Reduces server load and improves global delivery speed

### 3. Database Query Optimization
```php
// In your controllers, eager load relationships
$programs = Program::with('category')->where('status', 'active')->get();
$posts = Post::with('author')->latest()->take(3)->get();
```

### 4. Enable OPcache on Production Server
Add to your `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
opcache.revalidate_freq=0
```

### 5. Implement Redis/Memcached Caching
```bash
# Install Redis
composer require predis/predis

# Configure in .env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

Cache expensive queries:
```php
use Illuminate\Support\Facades\Cache;

$programs = Cache::remember('featured_programs', 3600, function () {
    return Program::where('featured', true)->get();
});
```

### 6. Optimize Unsplash Images
Replace Unsplash URLs with locally hosted, optimized versions:
```
Current: https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80
Better: asset('images/hero-optimized.webp')
```

Download and optimize:
```bash
# Download image
wget "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80" -O hero.jpg

# Convert to WebP
cwebp -q 80 hero.jpg -o hero.webp

# Move to public folder
mv hero.webp public/images/
```

### 7. Preload Critical Resources
Add to `<head>` in `layouts/app.blade.php`:
```html
<link rel="preload" as="image" href="{{ asset('logos/centrum..1.jpg') }}">
<link rel="preload" as="style" href="{{ asset('build/assets/app-[hash].css') }}">
<link rel="preload" as="script" href="{{ asset('build/assets/app-[hash].js') }}">
```

### 8. Lazy Load Alpine.js Components
Defer Alpine.js for non-critical interactivity:
```javascript
// In resources/js/app.js
import Alpine from 'alpinejs';

// Defer Alpine start
document.addEventListener('DOMContentLoaded', () => {
    window.Alpine = Alpine;
    Alpine.start();
});
```

## 📊 Performance Checklist

### Before Deployment
- [ ] Run `npm run build` for production-optimized assets
- [ ] Clear all Laravel caches: `php artisan optimize:clear`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache views: `php artisan view:cache`
- [ ] Verify .htaccess is uploaded to production
- [ ] Test on PageSpeed Insights
- [ ] Test on GTmetrix
- [ ] Test on WebPageTest

### Production Server Configuration
```bash
# Build assets for production
npm run build

# Optimize Laravel
php artisan optimize
php artisan route:cache
php artisan config:cache
php artisan view:cache

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🎯 Expected Results

After implementing all optimizations:
- **Performance Score:** 95-100/100
- **First Contentful Paint (FCP):** < 1.0s
- **Largest Contentful Paint (LCP):** < 2.0s
- **Total Blocking Time (TBT):** 0ms
- **Cumulative Layout Shift (CLS):** < 0.1
- **Speed Index:** < 1.0s

## 📝 Monitoring

### Tools to Use
1. **Google PageSpeed Insights:** https://pagespeed.web.dev/
2. **GTmetrix:** https://gtmetrix.com/
3. **WebPageTest:** https://www.webpagetest.org/
4. **Chrome DevTools Lighthouse:** Built into Chrome

### Regular Testing
- Test after every major deployment
- Monitor Core Web Vitals in Google Search Console
- Set up performance budgets in CI/CD pipeline

## 🚀 Deployment Commands

When deploying to production, run:

```bash
# On local machine - build assets
npm run build
git add .
git commit -m "Performance optimizations"
git push origin main

# On production server
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan optimize
php artisan storage:link

# Restart services
sudo systemctl restart php-fpm
sudo systemctl restart nginx
```

## 📞 Support

If you need help with any optimization:
1. Check Laravel documentation: https://laravel.com/docs/optimization
2. Check Vite documentation: https://vitejs.dev/guide/build.html
3. Check Tailwind optimization: https://tailwindcss.com/docs/optimizing-for-production

---

**Last Updated:** October 28, 2025
**Maintained By:** Development Team
