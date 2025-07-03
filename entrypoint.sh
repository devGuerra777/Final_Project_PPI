#!/bin/bash

echo "Esperando 15 segundos para que la base de datos esté lista..."
sleep 15

# Artisan commands (una vez que el contenedor ya está listo)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan migrate --force
php artisan package:discover --ansi

# Inicia Apache
exec apache2-foreground
