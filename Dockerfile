FROM php:8.1.8-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y zip unzip

RUN mkdir -p /app
WORKDIR /app
ADD composer.json /app
ADD tests /app/tests
ADD src /app/src

RUN /usr/local/bin/composer install

CMD [ "php", "./vendor/bin/phpunit", "tests"]
