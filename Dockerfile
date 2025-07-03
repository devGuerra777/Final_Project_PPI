FROM php:8.2-apache

# Instala extensiones necesarias y la dependencia que te falta: libonig-dev
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev curl libcurl4-openssl-dev libssl-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring xml curl

# Habilita mod_rewrite
RUN a2enmod rewrite

# Configura Apache para servir desde /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Copia el código al contenedor
COPY . /var/www/html

# Establece permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Limpia cache
RUN php artisan config:clear

# Expone el puerto web
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
