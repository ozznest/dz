FROM php:7.4-fpm-alpine

LABEL stage=dz_backend


ENV LANG en_US.utf8
ENV TZ Europe/Kiev
ENV COMPOSER_ALLOW_SUPERUSER 1
ARG HTTP_PROXY=""

# add composer to image
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN \
    # extract sources
    docker-php-source extract \
    # install build tools and dependencies
    && apk add --update ${PHPIZE_DEPS} tzdata freetype-dev git libpng-dev libjpeg-turbo-dev libxml2-dev autoconf g++ libtool automake make nginx \
    imagemagick-dev libmemcached-libs zlib libmemcached-dev zlib-dev libzip-dev cyrus-sasl-dev openldap-dev imagemagick \
    # set timezone
    && cp /usr/share/zoneinfo/Europe/Kiev /etc/localtime && echo ${TZ} > /etc/timezone \
    # install PHP modules
#    && pear config-set http_proxy ${HTTP_PROXY} \
    && if [ "x${HTTP_PROXY}" != "x" ] ; then  pear config-set http_proxy "${HTTP_PROXY}"; fi \
    && pecl channel-update pecl.php.net \
    # delete source
    && docker-php-source delete \
    # remove build tools
    && apk del --no-cache zlib-dev cyrus-sasl-dev autoconf g++ libtool make \
    # clean cache
    && rm -rf /tmp/* /var/cache/apk/*

RUN apk add --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/community gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php


COPY docker/config/*.ini /usr/local/etc/php/conf.d/
#COPY back/* /var/www/html/back/
WORKDIR /var/www/html/back

#RUN composer global require "phpunit/phpunit"
#RUN ln -s /root/.composer/vendor/bin/phpunit /usr/bin/phpunit
#RUN composer install --no-scripts --no-autoloader
#RUN ln -s /var/www/html/back/vendor/phpunit/phpunit/phpunit /usr/bin/phpunit
#RUN ln -s ./vendor/phpunit/phpunit/phpunit /usr/bin/phpunit