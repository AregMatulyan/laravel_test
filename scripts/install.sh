#!/bin/sh

echo '

Starting installation of the Laravel Test App...
'

cp .env.example .env
composer install
./scripts/up.sh
docker-compose exec laravel.test bash -c "php artisan migrate; ./scripts/ant.sh; php artisan storage:link; php artisan key:generate; php artisan queue:work"
