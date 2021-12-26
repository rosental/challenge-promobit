FROM phpdockerio/php74-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

RUN ln -fs /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && dpkg-reconfigure -f noninteractive tzdata

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php7.4-pgsql \
        php7.4-sqlite3 \
        php7.4-bcmath \
        php7.4-bz2 \
        php7.4-dba \
        php7.4-enchant \
        php7.4-gd \
        php7.4-gmp \
        php7.4-imap \
        php7.4-intl \
        php7.4-ldap \
        php7.4-odbc \
        php7.4-phpdbg \
        php7.4-soap \
        php7.4-xsl \
        php7.4-intl \
        php-memcached \
        php-redis \
        php-xdebug \
        php-gearman \
        php-igbinary \
        php-imagick \
        php-yaml \
        php-smbclient \
        smbclient \
        libsmbclient-dev \
        libgmp3-dev \
        zlibc \
        libjpeg-dev \
        libpng-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && phpenmod -v ALL smbclient

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
