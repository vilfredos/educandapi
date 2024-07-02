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
    nginx \
    sqlite3 \
    libsqlite3-dev

# Configurar y instalar extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite zip gd

# Instalar Composer
COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# Configurar Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de composer y package.json
COPY composer.json composer.lock package.json package-lock.json ./

# Crear archivo .env
RUN touch .env && \
    echo "APP_NAME=Laravel" >> .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_KEY=" >> .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=http://localhost" >> .env && \
    echo "DB_CONNECTION=mysql" >> .env && \
    echo "DB_HOST=db4free.net" >> .env && \
    echo "DB_PORT=3306" >> .env && \
    echo "DB_DATABASE=bd_sedu" >> .env && \
    echo "DB_USERNAME=ageen_sedu" >> .env && \
    echo "DB_PASSWORD=ageen_sedu" >> .env && \
    echo "CACHE_DRIVER=file" >> .env

# Instalar dependencias de PHP
RUN composer install --no-scripts --no-autoloader

# Instalar dependencias de Node.js
RUN npm install

# Copiar el resto de los archivos de la aplicación
COPY . .

# Generar el autoloader de Composer
RUN composer dump-autoload --optimize

# Crear directorios necesarios y establecer permisos
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Generar key de la aplicación
RUN php artisan key:generate

# Limpiar y cachear configuración
RUN php artisan config:clear
RUN php artisan config:cache

# Limpiar y cachear rutas
RUN php artisan route:clear

# Compilar assets
RUN npm run build

# Exponer puerto
EXPOSE 80

# Iniciar Nginx y PHP-FPM
CMD service nginx start && php-fpm