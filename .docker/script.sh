#!/bin/bash

set -e

APP_CONTAINER_ID=$(docker ps -aqf "name=app")

echo "[-] Setup environment variables [-]"
docker exec $APP_CONTAINER_ID cp .env.example .env
printf "\n"

echo "[-] Setup Database [-]"
docker exec $APP_CONTAINER_ID composer install
docker exec $APP_CONTAINER_ID php artisan migrate --seed --force
printf "\n"

echo "[-] Change permissions [-]"
docker exec $APP_CONTAINER_ID chmod -R 777 storage bootstrap/cache
printf "\n"

echo "[-] Health Check APP [-]"
CURL_OUTPUT=$(docker exec $APP_CONTAINER_ID curl localhost:80/api \
                     --request GET \
                     --header "Content-Type: application/json" -s)

printf "\n"

if [[ $CURL_OUTPUT == '"API Ancora V1.0.0"' ]]
then
    echo "[+] Application ready. [+]"
else
    echo "[!] Setup Application error [!]"
fi