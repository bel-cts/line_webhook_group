FROM php:8.1-apache

COPY . /var/www/html/

RUN chmod 777 /var/www/html

EXPOSE 80
