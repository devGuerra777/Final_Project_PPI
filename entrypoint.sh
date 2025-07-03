#!/bin/bash

# Espera a que la base de datos MySQL esté lista
until nc -z -v -w30 $DB_HOST $DB_PORT
do
  echo "Esperando a que MySQL ($DB_HOST:$DB_PORT) esté disponible..."
  sleep 5
done

# Ejecuta las migraciones de Laravel automáticamente
php artisan migrate --force

# Limpia cache de configuración (opcional pero recomendado)
php artisan config:cache

# Ejecuta Apache en primer plano para mantener el contenedor activo
exec apache2-foreground
