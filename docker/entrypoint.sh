#!/bin/sh
set -e

# Port configuration (Render passes $PORT, default to 10000 or 80)
PORT=${PORT:-10000}
echo "Configuring Nginx to listen on port: $PORT"
sed -i "s/LISTEN_PORT/$PORT/g" /etc/nginx/http.d/default.conf

# Generate app key if missing
if [ -z "$APP_KEY" ]; then
    echo "Generating Application Key..."
    php artisan key:generate --force
fi

# Ensure storage link exists
php artisan storage:link || true

# Cache configurations for maximum production performance
echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Auto-migrate database on start if enabled
if [ "$AUTO_MIGRATE" = "true" ] || [ "$AUTO_MIGRATE" = "1" ]; then
    echo "Running database migrations and seeders..."
    php artisan migrate --force
    php artisan db:seed --force
fi

echo "Starting Supervisor (Nginx + PHP-FPM)..."
exec supervisord -c /etc/supervisord.conf
