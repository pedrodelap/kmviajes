# Config Image PHP
FROM php:7.2.18-apache

#Install git
RUN apt-get update && apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN docker-php-ext-install curl
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/

COPY kmviajes/ /var/www/html/
EXPOSE 80

