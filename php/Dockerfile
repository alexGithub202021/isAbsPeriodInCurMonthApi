FROM php:7.4-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip vim \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && pecl install xdebug && docker-php-ext-enable xdebug

# Configure xDebug
RUN echo "\n\
    xdebug.mode=debug\n\
    xdebug.discover_client_host=1\n\
    xdebug.client_port=9003\n\
    xdebug.XDEBUG_SESSION=VSCODE \n\
    xdebug.log=/var/www/sf/xdebug.log\n\
    ">> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini    

WORKDIR /var/www/sf

#composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#sf
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony