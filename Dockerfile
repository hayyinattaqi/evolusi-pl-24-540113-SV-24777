# ==========================================
# Stage 1: Build Dependencies
# ==========================================
FROM composer:2.8 AS builder

WORKDIR /var/www/html

# Salin file dependensi terlebih dahulu
COPY composer.json composer.lock ./

# Pasang dependensi aplikasi tanpa skrip dan autoloader
RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader --prefer-dist

# Salin seluruh kode aplikasi
COPY . .

# Buat autoloader yang dioptimalkan untuk produksi
RUN composer dump-autoload --optimize --no-dev

# ==========================================
# Stage 2: Runtime Production Image
# ==========================================
FROM php:8.3-alpine

WORKDIR /var/www/html

# Konfigurasi environment SQLite
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/html/database/database.sqlite

# Salin aplikasi beserta dependensi yang sudah dibangun dari builder stage
COPY --from=builder /var/www/html /var/www/html

# Salin entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Setup direktori, izin akses, dan kepemilikan file untuk www-data
RUN chmod +x /usr/local/bin/entrypoint.sh \
    && mkdir -p storage/framework/views \
                storage/framework/cache \
                storage/framework/sessions \
                storage/logs \
                bootstrap/cache \
                database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/html

# Ekspos port aplikasi
EXPOSE 8000

# Jalankan container sebagai user non-root (www-data)
USER www-data

# Healthcheck untuk memeriksa kesiapan aplikasi
HEALTHCHECK --interval=10s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://127.0.0.1:8000/ || exit 1

ENTRYPOINT ["entrypoint.sh"]