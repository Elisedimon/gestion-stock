FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev \
    libxml2-dev libzip-dev libfreetype6-dev \
    libjpeg62-turbo-dev && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p public/build && echo '{"version":"1","entrypoints":[]}' > public/build/manifest.json

RUN cp .env.example .env && php artisan key:generate

RUN php artisan migrate --seed --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -i 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80