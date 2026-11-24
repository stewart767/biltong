#!/usr/bin/env bash
# ==============================================================================
# INAS Premium Beef Biltong - Production Deployment Script
# ==============================================================================

set -e

echo "🚀 Starting INAS Biltong deployment..."

# Put application into maintenance mode if already live
if [ -f artisan ]; then
    php artisan down || true
fi

# 1. Pull latest code from GitHub
echo "📦 Pulling latest code from origin/main..."
git pull origin main

# 2. Install Composer dependencies for production
echo "🐘 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# 3. Check frontend assets
if [ -f public/build/manifest.json ]; then
    echo "🎨 Pre-compiled production assets found in public/build, ready to serve!"
elif command -v npm &> /dev/null; then
    echo "🎨 Compiling frontend assets with Vite..."
    npm ci || npm install
    npm run build || true
fi

# 4. Run database migrations safely
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 5. Optimize Laravel caches
echo "⚡ Caching configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 6. Storage link and directory permissions
echo "🔒 Setting storage and cache permissions..."
php artisan storage:link || true
chmod -R 775 storage bootstrap/cache || true

# Bring application back up
echo "✅ Bringing application live..."
php artisan up || true

echo "🎉 Deployment completed successfully!"
