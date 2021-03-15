#!/bin/sh

echo '
Flush the application cache
'

php artisan cache:clear

echo '
Create a cache file for faster configuration loading
'
php artisan config:cache

php artisan config:clear
