FROM php:8.1-fpm

# Install composer
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install useful tools
RUN apt-get update && apt-get -y install apt-utils iputils-ping nano wget dialog vim

# Install important libraries
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev

# Install important docker extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    exif \
    pcntl \
    bcmath \
    ctype \
    curl \
    iconv \
    xml \
    soap \
    mbstring \
    bz2 \
    zip \
    intl
