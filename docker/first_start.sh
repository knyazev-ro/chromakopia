#!/bin/bash

composer install

chown -R www-data:www-data storage bootstrap/cache

php artisan key:generate
php artisan migrate --seed
