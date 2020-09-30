FROM php:7.3-apache 

# Ajout de l'extension mysqli.so dans /usr/local/lib/php/extensions/...
RUN docker-php-ext-install mysqli

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
