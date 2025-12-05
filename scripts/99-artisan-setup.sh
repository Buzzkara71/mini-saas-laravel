#!/usr/bin/env bash
set -e

cd /var/www/html

# config Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# migration 
php artisan migrate --force

# seeder
php artisan db:seed --force || true
