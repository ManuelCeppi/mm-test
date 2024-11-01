FROM php:8.3-apache

RUN curl -sSLf -o /usr/local/bin/install-php-extensions https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions

RUN chmod +x /usr/local/bin/install-php-extensions

RUN apt-get update && apt-get install

RUN install-php-extensions @composer mysqli pdo_mysql gd