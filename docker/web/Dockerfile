FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y g++ git libzip-dev zip libicu-dev zlib1g-dev

RUN docker-php-ext-install zip intl opcache pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');"

COPY app.conf /etc/apache2/sites-enabled/000-default.conf
#COPY . /var/www



CMD ["apache2-foreground"]