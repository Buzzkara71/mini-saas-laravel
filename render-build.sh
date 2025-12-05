#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install JS dependencies
npm install
npm run build

# Cache optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
