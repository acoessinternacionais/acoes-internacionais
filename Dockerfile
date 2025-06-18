FROM php:8.2-apache

# Instalações básicas e extensões
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Proteções básicas no Apache
RUN a2enmod rewrite headers  && echo 'ServerTokens Prod\nServerSignature Off\nHeader always unset X-Powered-By' >> /etc/apache2/conf-available/security.conf

# Diretório de trabalho
WORKDIR /var/www/html

# Copia arquivos
COPY . /var/www/html/
