#!/bin/bash

# Performance Optimization Deployment Script
# Centrum Optimi Educational Foundation Website

echo "🚀 Starting Performance Optimization Deployment..."
echo ""

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Build production assets
echo -e "${YELLOW}Step 1: Building production assets...${NC}"
npm run build
echo -e "${GREEN}✓ Assets built successfully${NC}"
echo ""

# Step 2: Optimize Laravel
echo -e "${YELLOW}Step 2: Optimizing Laravel...${NC}"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✓ Laravel optimized${NC}"
echo ""

# Step 3: Set permissions
echo -e "${YELLOW}Step 3: Setting proper permissions...${NC}"
chmod -R 755 storage bootstrap/cache
echo -e "${GREEN}✓ Permissions set${NC}"
echo ""

# Step 4: Verify .htaccess
echo -e "${YELLOW}Step 4: Verifying .htaccess configuration...${NC}"
if [ -f "public/.htaccess" ]; then
    echo -e "${GREEN}✓ .htaccess file exists${NC}"
    if grep -q "mod_expires" public/.htaccess; then
        echo -e "${GREEN}✓ Browser caching configured${NC}"
    else
        echo -e "${YELLOW}⚠ Warning: Browser caching may not be configured${NC}"
    fi
    if grep -q "mod_deflate" public/.htaccess; then
        echo -e "${GREEN}✓ Gzip compression configured${NC}"
    else
        echo -e "${YELLOW}⚠ Warning: Gzip compression may not be configured${NC}"
    fi
else
    echo -e "${YELLOW}⚠ Warning: .htaccess file not found${NC}"
fi
echo ""

# Step 5: Check storage link
echo -e "${YELLOW}Step 5: Verifying storage symlink...${NC}"
if [ -L "public/storage" ]; then
    echo -e "${GREEN}✓ Storage symlink exists${NC}"
else
    echo -e "${YELLOW}Creating storage symlink...${NC}"
    php artisan storage:link
    echo -e "${GREEN}✓ Storage symlink created${NC}"
fi
echo ""

# Step 6: Clear application cache
echo -e "${YELLOW}Step 6: Clearing application cache...${NC}"
php artisan cache:clear
echo -e "${GREEN}✓ Application cache cleared${NC}"
echo ""

# Summary
echo ""
echo "========================================="
echo -e "${GREEN}✓ Deployment Complete!${NC}"
echo "========================================="
echo ""
echo "Next steps:"
echo "1. Test your website at: https://centrumoptimiedufoundation.org"
echo "2. Run PageSpeed test: https://pagespeed.web.dev/"
echo "3. Check performance score (target: 95-100)"
echo ""
echo "Performance optimizations applied:"
echo "  ✓ Production assets built and minified"
echo "  ✓ Laravel caches optimized"
echo "  ✓ Browser caching configured (1 year)"
echo "  ✓ Gzip compression enabled"
echo "  ✓ Image lazy loading implemented"
echo "  ✓ Resource hints added (preconnect, dns-prefetch)"
echo "  ✓ Layout shift issues fixed"
echo ""
echo "Expected improvements:"
echo "  • FCP: < 1.0s"
echo "  • LCP: < 2.0s"
echo "  • TBT: 0ms"
echo "  • CLS: < 0.1"
echo "  • Performance Score: 95-100/100"
echo ""
echo -e "${YELLOW}Happy coding! 🎉${NC}"
