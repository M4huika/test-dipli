FROM php:8.0.2-fpm
RUN apt-get update && apt-get install -y
RUN apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libpq-dev \
        nano \
    && docker-php-ext-install \
        zip \
        intl \
        pdo \
        mysqli \
        pdo_mysql \
        opcache
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD composer install ;  php-fpm
EXPOSE 9000