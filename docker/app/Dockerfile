FROM php:7.4.4-fpm-alpine3.11

RUN apk update && \
    apk add --no-cache bash \
                       shadow

RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 501 www-data && \
    groupmod -g 501 www-data
