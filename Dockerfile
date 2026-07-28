# Imagen que ya trae nginx + PHP-FPM + Composer preconfigurados para Laravel
FROM webdevops/php-nginx:8.3

ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=production

WORKDIR /app

# Copiamos todo el proyecto
COPY . /app

# Instalamos dependencias de producción (sin las de desarrollo)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permisos necesarios para que Laravel pueda escribir logs, cachés y sesiones
RUN chmod -R 775 storage bootstrap/cache

# Cachear configuración y rutas para que arranque más rápido
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 80
