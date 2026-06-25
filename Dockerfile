FROM php:8.2-apache

# PHP extensions ที่ WordPress ต้องการ
RUN apt-get update && apt-get install -y \
      libpng-dev libjpeg-dev libwebp-dev \
      libzip-dev libicu-dev libxml2-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install \
         gd mysqli pdo_mysql \
         mbstring xml zip intl exif opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# PHP config
COPY docker/php.ini $PHP_INI_DIR/conf.d/wordpress.ini

# Copy WordPress files (ยกเว้นไฟล์ใน .dockerignore)
COPY . /var/www/html/

# wp-config อ่านจาก environment variables
COPY docker/wp-config-docker.php /var/www/html/wp-config.php

# Apache: อนุญาต .htaccess + permalinks
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN mkdir -p /var/www/html/wp-content/uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/wp-content/uploads

EXPOSE 80
