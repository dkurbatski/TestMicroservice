FROM php:8.3-fpm

WORKDIR /var/www/html
COPY .configuration/docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

RUN apt-get update && \
    apt-get install -y git && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get install -y default-mysql-client && \
    apt-get install -y git unzip libzip-dev && \
    apt-get install -y libcurl4-openssl-dev && \
    docker-php-ext-install pdo pdo_mysql curl zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

CMD ["sh", "-c", "php-fpm"]
