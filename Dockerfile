FROM php:8.4-fpm-alpine

# 1. Argumentos para anonimizar al usuario 
ARG USER_NAME=developer
ARG USER_ID=1000
ARG GROUP_ID=1000

# 2. Dependencias del sistema 
RUN apk add --no-cache \
    libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev \
    icu-dev oniguruma-dev bash nodejs pnpm \
    autoconf automake libtool nasm build-base zlib-dev shadow

# 3. Extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli intl zip opcache

# 4. Creación del usuario limitado 
RUN groupadd -g $GROUP_ID $USER_NAME \
    && useradd -u $USER_ID -g $USER_NAME -m $USER_NAME

# 5. Configurar PNPM para que viva en el HOME del nuevo usuario
ENV PNPM_HOME="/home/$USER_NAME/.local/share/pnpm"
ENV PATH="${PATH}:${PNPM_HOME}"

# 6. Composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Configuración de desarrollo
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# 8. Directorio de trabajo y permisos
WORKDIR /var/www/html
RUN chown -R $USER_NAME:$USER_NAME /var/www/html

# 9. Cambiamos al usuario no-root
USER $USER_NAME

# Exponemos el puerto por defecto de PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]