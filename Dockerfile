# Imagen base oficial de PHP con Apache
FROM php:7.4-apache

# Instala utilidades necesarias para Composer y dependencias externas
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    # debug conex a MySQL
    # iputils-ping \
    # debug conex a MySQL
    # default-mysql-client \
    libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql

# Instala extensiones de PHP para PDO (acceso a SQL con sentencias preparadas)
# y el driver para MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copia composer.json 
COPY composer.json ./
# Instala biblioteca composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
# Instala las dependencias de Composer (esto crea la carpeta vendor/)
RUN composer install --no-dev --optimize-autoloader

# Copia solo la carpeta pública al DocumentRoot de Apache
COPY ./web /var/www/html

# Copia dic y src también dentro del DocumentRoot 
COPY ./dic /var/www/html/dic
COPY ./src /var/www/html/src

# Copia archivos de configuración fuera del DocumentRoot por seguridad
COPY ./config-dev /var/www/config-dev

# Copia la configuración personalizada para Apache
COPY ./config-dev/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copia bootstrap.php y dependencias al DocumentRoot
COPY ./bootstrap.php /var/www/html/bootstrap.php
COPY ./autoloader.php /var/www/html/autoloader.php
COPY ./error_handler.php /var/www/html/error_handler.php

# Habilita mod_rewrite de Apache para permitir URLs amigables "/Luke"
RUN a2enmod rewrite

# Activa el VirtualHost personalizado, sino Apache no aplica las reglas de rewrite
RUN a2ensite 000-default.conf

# Establece permisos de escritura al grupo y usuario de Apache solo en la carpeta de logs
# que es donde escribe Apache de acuerdo a la app
RUN mkdir -p /var/www/html/logs && chown -R www-data:www-data /var/www/html/logs


# Expone el puerto 80
EXPOSE 80
