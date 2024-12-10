FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY ./src/ /var/www/html/

# Добавление ServerName в конфигурацию Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
