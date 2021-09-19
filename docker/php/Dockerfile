FROM php:8.0.7-fpm as app-php

RUN apt-get update

RUN apt-get install libyaml-dev -y \
  && pecl install yaml \
  && docker-php-ext-install pdo pdo_mysql

COPY php.ini /usr/local/etc/php/conf.d/php.ini

COPY --from=composer:2.1.3 /usr/bin/composer /usr/bin/composer

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /var/www/