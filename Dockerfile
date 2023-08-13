FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev nginx nodejs npm unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql   \
    && apt-get clean \
    && pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /var/www/html

COPY . .
COPY nginx-fpm.conf /etc/nginx/sites-available/default

RUN chmod o+w ./storage/ -R && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader \
    && npm i

EXPOSE 80

CMD ["bash", "-c", "php-fpm & nginx -g 'daemon off;'"]
