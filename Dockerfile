# Imagen oficial PHP
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar proyecto
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Puerto que usa Cloud Run
EXPOSE 8080

# Apache debe escuchar en 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf \
    /etc/apache2/sites-available/000-default.conf

# Iniciar Apache
CMD ["apache2-foreground"]
