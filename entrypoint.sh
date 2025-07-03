#!/bin/bash

echo "Esperando 15 segundos para que la base de datos esté lista..."
sleep 15

php artisan migrate --force
php artisan config:cache

exec apache2-foreground
