FROM composer:latest AS symfony-web-application

RUN apk add --no-cache bash && \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli postgresql-dev jq && \
    docker-php-ext-install pdo pdo_pgsql

CMD ["symfony", "server:start", "--no-tls"]
