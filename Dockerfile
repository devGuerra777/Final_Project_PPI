# Usa imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev curl libcurl4-openssl-dev libssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring xml curl

# Habilita mod_rewrite
RUN a2enmod rewrite

# Establece el document root de Apache a /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Apunta Apache al document root correcto (public/)
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Copia el proyecto Laravel al contenedor
COPY . /var/www/html

# Establece permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependencias de Laravel
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Limpia cache
RUN php artisan config:clear

# Puerto expuesto
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
