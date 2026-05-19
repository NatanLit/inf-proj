FROM php:8.2-fpm-alpine
RUN docker-php-ext-install mysqli
RUN apk add --no-cache nginx
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY . /var/www/html/
COPY nginx.conf /etc/nginx/nginx.conf.template
RUN chmod -R 755 /var/www/html
CMD sh -c "php-fpm -D && sed s/PORT_PLACEHOLDER/\$PORT/ /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf && nginx -g 'daemon off;'"
