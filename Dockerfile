# Usa una imagen base de PHP con FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema y Nginx
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    nginx

# Configurar y instalar extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql zip gd

# Instalar Composer
COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# Configurar Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de composer y package.json
COPY composer.json composer.lock package.json package-lock.json ./

# Instalar dependencias de PHP
RUN composer install --no-scripts --no-autoloader

# Instalar dependencias de Node.js
RUN npm install

# Copiar el resto de los archivos de la aplicación
COPY . .

# Generar el autoloader de Composer
RUN composer dump-autoload --optimize

# Compilar assets
RUN npm run build

# Generar key de la aplicación
RUN php artisan key:generate

# Configurar permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto
EXPOSE 80

# Iniciar Nginx y PHP-FPM
CMD service nginx start && php-fpm