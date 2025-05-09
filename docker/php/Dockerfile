FROM php:7.4-fpm

# Install MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Install other required extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

# Set working directory
WORKDIR /app

# Copy existing files
COPY . /app

# Permissions
RUN chown -R www-data:www-data /app
