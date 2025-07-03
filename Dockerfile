FROM php:8.2-apache

# Instala extensiones necesarias y Node.js para Vite
RUN apt-get update && apt-get install -y \
    git unzip zip curl gnupg2 libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libcurl4-openssl-dev libssl-dev libonig-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring xml curl

# Habilita mod_rewrite
RUN a2enmod rewrite

# Configura Apache para servir desde /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Directorio de trabajo
WORKDIR /var/www/html

# Copia composer y package files
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader || true  # Evita que falle por artisan

# Instala dependencias Vite y build
RUN npm install && npm run build

# Copia el resto del código fuente
COPY . .

# Establece permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto
EXPOSE 80

# Copia entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
