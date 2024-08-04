FROM dunglas/frankenphp:1.1.0-php8.3.3-bookworm
WORKDIR /app/public

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

RUN apt update && apt install -y \
    git

RUN install-php-extensions opcache

COPY caddy/data /data
COPY caddy/config /config
COPY symfony /app/public

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

