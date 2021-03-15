#!/bin/sh

echo '

Starting installation of the Laravel Test App...
'
./up.sh

docker-compose exec tms bash -c 'php artisan migrate && ./scripts/ant.sh && php artisan storage:link && php artisan queue:work'
