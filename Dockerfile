# ==========================================
# Stage 1: Build Frontend Assets (Vite + Tailwind)
# ==========================================
FROM node:20-alpine AS frontend-builder
WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# ==========================================
# Stage 2: Production PHP-FPM + Nginx
# ==========================================
FROM php:8.3-fpm-alpine

# Install system dependencies & PHP build tools
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    postgresql-dev

# Install and configure PHP extensions (MySQL + PostgreSQL + GD + OpCache)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        gd \
        zip \
        bcmath \
        opcache

# Install latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Ensure base .env file exists from .env.example
RUN cp .env.example .env 2>/dev/null || touch .env

# Copy compiled frontend assets from Stage 1
COPY --from=frontend-builder /app/public/build ./public/build

# Install production PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set appropriate permissions for storage, cache, and public static assets
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/public \
    && rm -f /var/www/html/public/hot

# Copy Nginx, Supervisor, and Entrypoint configurations
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Configure PHP-FPM to retain Docker & Render environment variables
RUN echo "clear_env = no" >> /usr/local/etc/php-fpm.d/zz-docker.conf

# Expose Render standard ports
EXPOSE 80 10000

# Start via custom entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
