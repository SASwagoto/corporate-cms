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

# Ensure PHP-FPM does NOT clear environment variables
echo "Configuring PHP-FPM to retain environment variables (clear_env = no)..."
echo "clear_env = no" >> /usr/local/etc/php-fpm.d/zz-docker.conf 2>/dev/null || true

# Robust APP_KEY Resolution
if [ -n "$APP_KEY" ]; then
    echo "Using APP_KEY provided via environment variable..."
    if grep -q "^APP_KEY=" /var/www/html/.env; then
        sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" /var/www/html/.env
    else
        echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
    fi
else
    EXISTING_KEY=$(grep -E "^APP_KEY=" /var/www/html/.env 2>/dev/null | cut -d '=' -f2-)
    if [ -z "$EXISTING_KEY" ] || [ "$EXISTING_KEY" = "" ]; then
        echo "Generating fresh Application Key..."
        php artisan key:generate --force
        EXISTING_KEY=$(grep -E "^APP_KEY=" /var/www/html/.env | cut -d '=' -f2-)
    fi
    export APP_KEY="$EXISTING_KEY"
    echo "Resolved Application Key for runtime."
fi

# Ensure storage symlink exists & clean any dev artifacts
rm -f /var/www/html/public/hot
chmod -R 755 /var/www/html/public
php artisan storage:link --quiet || true
php artisan livewire:publish --assets --quiet || true

# Clear previous cache and re-cache with verified APP_KEY
echo "Caching Laravel configuration, routes, and views..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Auto-migrate database on start if enabled
if [ "$AUTO_MIGRATE" = "true" ] || [ "$AUTO_MIGRATE" = "1" ]; then
    echo "Running database migrations..."
    php artisan migrate --force --isolated || echo "Migration notice: skipped or connection busy."
fi

echo "All systems ready. Starting Supervisor (Nginx + PHP-FPM)..."
exec supervisord -c /etc/supervisord.conf
