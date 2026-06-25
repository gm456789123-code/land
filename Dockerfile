FROM wordpress:php8.2-apache

# PHP config
COPY docker/php.ini $PHP_INI_DIR/conf.d/wordpress.ini

# Apache: เปิด mod_rewrite + permalinks
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# wp-config อ่านจาก environment variables
COPY docker/wp-config-docker.php /var/www/html/wp-config.php

# Theme เราเท่านั้น (WP core มาจาก base image แล้ว)
COPY wp-content/themes/backup-theme /var/www/html/wp-content/themes/backup-theme
COPY wp-content/plugins /var/www/html/wp-content/plugins

RUN mkdir -p /var/www/html/wp-content/uploads \
    && chown -R www-data:www-data /var/www/html/wp-content \
    && chmod -R 775 /var/www/html/wp-content/uploads \
    && a2enmod rewrite

EXPOSE 80
