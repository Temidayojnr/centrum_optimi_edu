# 🎯 PageSpeed Optimization - Quick Reference

## Deploy to Production

```bash
# 1. Build assets
npm run build

# 2. Deploy
git add .
git commit -m "Performance optimizations"
git push origin main

# 3. On server, run deployment script
./deploy-performance.sh
```

## Test Performance

```bash
# Open PageSpeed Insights
open https://pagespeed.web.dev/

# Enter URL
https://centrumoptimiedufoundation.org

# Target: 95-100 score
```

## Key Changes Made

✅ Browser caching (1 year) - Saves 293 KiB  
✅ Image lazy loading - Fixes CLS  
✅ Resource preconnect - Saves 280ms  
✅ Build optimization - Saves 210 KiB  
✅ Gzip compression - Reduces file sizes  

## Quick Fixes if Score is Low

```bash
# Clear caches
php artisan optimize:clear

# Rebuild assets
npm run build

# Verify .htaccess exists
ls -la public/.htaccess

# Check permissions
chmod -R 755 storage bootstrap/cache
```

## Performance Targets

| Metric | Target |
|--------|--------|
| Performance | 95+ |
| FCP | <1.0s |
| LCP | <2.0s |
| CLS | <0.1 |
| TBT | 0ms |

## Files to Watch

- `public/.htaccess` - Caching rules
- `vite.config.js` - Build optimization
- `resources/views/layouts/app.blade.php` - Resource hints
- `resources/views/welcome.blade.php` - Image optimization

## Next Level Optimizations

1. Convert images to WebP format
2. Implement CDN (Cloudflare)
3. Add Redis caching
4. Enable OPcache on server
5. Optimize database queries

## Support

📖 Full docs: `PERFORMANCE_OPTIMIZATION.md`  
📋 Summary: `OPTIMIZATION_SUMMARY.md`  
🚀 Deploy script: `./deploy-performance.sh`
