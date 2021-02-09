FROM php:7.1.27-cli-alpine

RUN apk add --update git unzip openssh-client autoconf make g++
RUN pecl install xdebug-2.9.6
RUN docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
