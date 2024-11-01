#!/bin/bash

# set exit if 
set -e

# aenmod rewrite to enable url rewriting
a2enmod rewrite

echo "Composer install - Api"
# installing all the required packages through composer
composer install -d /var/www/html
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap

php artisan route:cache
php artisan config:clear
php artisan view:clear

# start the apache server and keep it running as a foreground service
apache2-foreground

