FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    locales \
    libpq-dev \
    cron \
    zip \
    unzip \
    curl \
    libzip-dev \
    libcurl4-openssl-dev \
    libonig-dev  \
    libpq-dev \
    libxml2-dev \
    && apt-get clean
RUN docker-php-ext-install pdo pdo_pgsql zip simplexml

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN locale-gen en_US.UTF-8 ru_RU.UTF-8

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
