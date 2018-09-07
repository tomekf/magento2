FROM php:7.1-fpm

RUN apt-get update

RUN apt-get update && apt-get install -y \
    cron \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libxslt1-dev \
    mysql-client \
    zip \
    git

RUN apt-get install -y zlib1g-dev libpq-dev git libicu-dev libxml2-dev libc6 \
    && docker-php-ext-configure intl

RUN docker-php-ext-install \
    bcmath \
    gd \
    intl \
    mbstring \
    mcrypt \
    opcache \
    pdo_mysql \
    soap \
    xsl \
    zip

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

ENV ACCEPT_EULA=Y

# Microsoft SQL Server Prerequisites

#RUN docker-php-ext-install mysqli mbstring pdo pdo_mysql \
#    && pecl install sqlsrv pdo_sqlsrv xdebug \
#    && docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug


ENV PHP_MEMORY_LIMIT 2G

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Warsaw /etc/localtime
RUN printf '[PHP]\ndate.timezone = "Europe/Warsaw"\n' > /usr/local/etc/php/conf.d/tzone.ini

WORKDIR /var/www/magento2
