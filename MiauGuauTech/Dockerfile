FROM php:8.2-apache

# RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

# Apache apunta a /public solo public es accesible
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# cambiamos apache para que este por defecto en /var/www/html/public en vez de en /var/www/html
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Permisos (evita 403)
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

WORKDIR /var/www/html
