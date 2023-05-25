FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    curl \
    libzip-dev \
    unzip

# Installez les dépendances PHP nécessaires
#RUN docker-php-ext-install

# INSTALL COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définissez la variable d'environnement COMPOSER_ALLOW_SUPERUSER
ENV COMPOSER_ALLOW_SUPERUSER 1

# Copiez les fichiers de l'application dans le conteneur
COPY . /var/www/html

# Activez le module Apache mod_rewrite pour le fichier .htaccess
RUN a2enmod rewrite

# Définissez le répertoire de travail
WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader
RUN composer dump-autoload

# Exposez le port 80 pour accéder à l'application
EXPOSE 80

