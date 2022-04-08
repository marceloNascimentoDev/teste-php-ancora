FROM wyveo/nginx-php-fpm:php81

RUN apt-get update && apt-get install curl -y

WORKDIR /usr/share/nginx/

RUN rm -rf /usr/share/nginx/html

COPY . /usr/share/nginx

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY .docker/script.sh /usr/local/bin/script.sh

# RUN chmod u+x /usr/local/bin/script.sh && /usr/local/bin/script.sh $CONTAINER_ROLE