FROM php:8.3-cli

# Install ekstensi sistem yang dibutuhkan PHP & Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Install Composer (disalin dari image resmi Composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 1) Salin HANYA file dependensi dulu
COPY composer.json composer.lock ./

# 2) Pasang dependensi SEBELUM kode aplikasi disalin
#    --no-scripts karena artisan belum ada di sini,
#    --no-autoloader karena folder app/ belum ada untuk di-generate autoload-nya
RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader --prefer-dist

# 3) Baru sekarang salin seluruh kode aplikasi
COPY . .

# 4) Selesaikan proses composer yang tadi ditunda (butuh kode app/ sudah ada)
RUN composer dump-autoload --optimize

# Konfigurasi supaya container selalu pakai SQLite, tidak bergantung .env bawaan
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/html/database/database.sqlite

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["entrypoint.sh"]