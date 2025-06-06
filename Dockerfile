FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

COPY nginx.conf /etc/nginx/nginx.conf

CMD ["sh", "-c", "nginx && php-fpm"]

#CMD ["sh", "-c", "php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000"]
#CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]