ARG PHP_VERSION=8.0
ARG ALPINE_VERSION=3.13
ARG APCU_VERSION=5.1.19
ARG XDEBUG_VERSION=3.0.4

FROM php:${PHP_VERSION}-fpm-alpine${ALPINE_VERSION}

RUN apk add --update openssh-client git wget curl libzip-dev libpng-dev icu-dev &&\
    mkdir -p /usr/src/php/ext/apcu; \
	curl -fsSL https://pecl.php.net/get/apcu --ipv4 | tar xvz -C "/usr/src/php/ext/apcu" --strip 1; \
    mkdir -p /usr/src/php/ext/redis; \
	curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
    mkdir -p /usr/src/php/ext/xdebug; \
	curl -fsSL https://pecl.php.net/get/xdebug --ipv4 | tar xvz -C "/usr/src/php/ext/xdebug" --strip 1; \
	docker-php-ext-install apcu pdo pdo_mysql gd intl opcache redis xdebug zip bcmath sockets pcntl&&\
    apk del gcc g++ &&\
    rm -rf /var/cache/apk/*;


ADD php.ini /etc/php/conf.d/
ADD php.ini /etc/php/cli/conf.d/
ADD php.ini /usr/local/etc/php
ADD php-fpm.conf /etc/php/php-fpm.d/
ADD xdebug.ini /usr/local/etc/php/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer