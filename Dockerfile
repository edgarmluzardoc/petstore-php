FROM php:7.3-fpm

COPY code /var/www/html

# Installing Composer dependencies
RUN buildDeps=" \
        wget \
        git \
        ssh \
        less \
        unzip \
        zip \
        curl \
    "; \
    set -x \
    && apt-get update && apt-get install -y $buildDeps --no-install-recommends && rm -rf /var/lib/apt/lists/*

# Installing Composer
RUN wget https://getcomposer.org/installer -O - -q | php -- --quiet && \
    mv composer.phar /usr/local/bin/composer

# Installing MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && /usr/local/bin/composer self-update

WORKDIR /var/www/html

RUN /usr/local/bin/composer install
