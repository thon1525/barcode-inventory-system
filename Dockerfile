# # Use the official PHP image
# FROM php:8.1-fpm

# # Set working directory
# WORKDIR /var/www/html

# # Install dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     zip \
#     unzip \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libzip-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd pdo_mysql zip

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# # Install Node.js 20.x (latest) and verify installation
# RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
#     && apt-get install -y nodejs \
#     && node -v \
#     && npm -v

# # Copy application files
# COPY . .

# # Install dependencies
# RUN composer install

# # Install Node.js dependencies (ensure npm is used)
# RUN npm install

# # Set permissions
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# # Expose port 8000
# EXPOSE 8000

# # Start Laravel server
# CMD php artisan serve --host=0.0.0.0 --port=8000






# Use the official PHP image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/html

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip

# Install Node.js 20.x (latest) and verify installation
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && node -v \
    && npm -v

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Install PHP dependencies with Composer
RUN composer install

# Install Node.js dependencies (ensure npm is used)
RUN npm install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
