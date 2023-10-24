FROM php:8.2.11-cli-alpine

RUN apk add --update git unzip openssh-client autoconf make g++
RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug \
    && pecl install pcov \
    && docker-php-ext-enable pcov

COPY --from=composer:2.3.9 /usr/bin/composer /bin/composer

WORKDIR /var/www
