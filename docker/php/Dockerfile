FROM php:8.1-cli-alpine

RUN apk add --update git unzip openssh-client autoconf make g++
RUN pecl install xdebug-3.1.5
RUN docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
