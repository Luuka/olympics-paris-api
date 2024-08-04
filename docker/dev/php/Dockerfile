FROM dunglas/frankenphp:1.1.0-php8.3.3-bookworm

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

RUN apt update && apt install -y \
    git

# add additional extensions here:
RUN install-php-extensions \
    opcache \
    pdo_mysql \
    gd \
    intl \
    zip

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /app/public