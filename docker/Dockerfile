FROM php:5.6-apache-stretch

# Install Extensions
RUN docker-php-ext-install mysqli pdo_mysql

# Enable Rewrite
RUN a2enmod headers

RUN if command -v a2enmod; then \
    a2enmod rewrite; \
    fi;