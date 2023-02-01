FROM php:8.2-fpm

RUN mkdir -p /www \
      && mkdir -p /www/var/log \
      && mkdir -p /www/var/cache \
      && mkdir -p /www/var/media

WORKDIR /www

# Download script to install PHP extensions and dependencies
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

RUN DEBIAN_FRONTEND=noninteractive apt-get update -q \
    && DEBIAN_FRONTEND=noninteractive apt-get install -qq -y \
      curl \
      git \
      zip unzip \
    && install-php-extensions \
      xdebug \
      bcmath \
      bz2 \
      calendar \
      exif \
      gd \
      intl \
      ldap \
      mysqli \
      opcache \
      pdo_mysql \
      pdo_pgsql \
      xsl \
      zip \
      sockets \
    && docker-php-ext-enable sockets
# already installed:
#      iconv \
#      mbstring \

# Install Composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN chmod -R 777 /www/var/log \
    && chmod -R 777 /www/var
