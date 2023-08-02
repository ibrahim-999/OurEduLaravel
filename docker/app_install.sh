cp .env.laravel ../laravel/.env
docker-compose up -d --build --force-recreate --always-recreate-deps 
docker-compose exec -T php /bin/sh -c "composer install && \
php artisan key:generate && \
php artisan storage:link && \
php artisan migrate:fresh --seed && \
php artisan optimize:clear"
docker-compose stop
