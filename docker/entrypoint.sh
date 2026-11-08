#!/bin/sh
set -e

# Port configuration (Render passes $PORT, default to 10000 or 80)
PORT=${PORT:-10000}
echo "Configuring Nginx to listen on port: $PORT"
sed -i "s/LISTEN_PORT/$PORT/g" /etc/nginx/http.d/default.conf

# Ensure .env file exists for Laravel
if [ ! -f /var/www/html/.env ]; then
    if [ -f /var/www/html/.env.example ]; then
        echo "Creating .env from .env.example..."
        cp /var/www/html/.env.example /var/www/html/.env
    else
        echo "Creating empty .env file..."
        touch /var/www/html/.env
    fi
fi

# Ensure APP_KEY is set
if [ -n "$APP_KEY" ]; then
    echo "Using APP_KEY provided via environment variable..."
    if grep -q "^APP_KEY=" /var/www/html/.env; then
        sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" /var/www/html/.env
    else
        echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
    fi
else
    echo "No APP_KEY environment variable detected. Generating fresh Application Key..."
    php artisan key:generate --force
fi

# Ensure storage symlink exists
php artisan storage:link --quiet || true

# Clear and cache configurations for production
echo "Caching Laravel configuration, routes, and views..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Auto-migrate database on start if enabled
if [ "$AUTO_MIGRATE" = "true" ] || [ "$AUTO_MIGRATE" = "1" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || echo "Migration notice: please verify database connection credentials."
    echo "Running database seeders..."
    php artisan db:seed --force || echo "Seeder notice: database already seeded or connection issue."
fi

echo "All systems ready. Starting Supervisor (Nginx + PHP-FPM)..."
exec supervisord -c /etc/supervisord.conf
