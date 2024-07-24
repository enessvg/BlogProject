FROM php:8.2

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . /app

RUN composer install

EXPOSE 8080

CMD composer install && php artisan serve --host=0.0.0.0 --port=8080
