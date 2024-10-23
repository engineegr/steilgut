#! /bin/bash

composer dumpautoload
composer install --optimize-autoloader --no-dev
php artisan cache:clear
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
