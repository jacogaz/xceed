FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer --version

COPY . /var/www/html/

WORKDIR /var/www/html/

RUN composer install --no-dev --optimize-autoloader --no-scripts

EXPOSE 80
