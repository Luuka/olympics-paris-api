FROM dunglas/frankenphp:1.1.0-php8.3.3-bookworm
WORKDIR /app/public

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

RUN apt update && apt install -y \
    git

RUN install-php-extensions opcache

COPY docker/prod/caddy/Caddyfile /etc/caddy/Caddyfile
COPY docker/prod/php/php.ini /usr/local/etc/php/php.ini
COPY symfony /app/public

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=prod
ENV APP_DEBUG=0
RUN composer install --no-dev --optimize-autoloader
RUN composer dump-env prod

