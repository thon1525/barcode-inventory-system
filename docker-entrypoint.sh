#!/bin/bash

# Run any necessary commands for Laravel
php artisan migrate --force  # This will run migrations, if necessary

# Start the PHP-FPM server
php-fpm
