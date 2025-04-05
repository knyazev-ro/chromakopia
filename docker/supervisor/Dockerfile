FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    gnupg2

RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-enable opcache

COPY ./docker/app/backend/php.ini /usr/local/etc/php/conf.d/php.ini

RUN apt-get install -y supervisor

RUN mkdir -p "/etc/supervisor/logs"

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]
