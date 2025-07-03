# Usa imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev curl libcurl4-openssl-dev libssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring xml curl

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el código al contenedor
COPY . /var/www/html

# Establece directorio de trabajo
WORKDIR /var/www/html

# Establece permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instala dependencias de Laravel
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Genera el key de Laravel si no existe
RUN php artisan config:clear

# Puerto expuesto por Apache
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
