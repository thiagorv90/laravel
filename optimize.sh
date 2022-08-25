#!/bin/bash
cd /home/thiago.valente/prjsgr1
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:cache
php artisan optimize
