#! /bin/bash

composer dumpautoload
php artisan cache:clear
php artisan optimize:clear
php artisan migrate:refresh --seed