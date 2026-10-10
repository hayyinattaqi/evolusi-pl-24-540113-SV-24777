#!/bin/sh
set -e

if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache || true

touch database/database.sqlite
php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port=8000