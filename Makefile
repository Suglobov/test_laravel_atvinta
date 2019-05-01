dc-up:
	docker-compose up --build -d
dc-down:
	docker-compose down
dc-ps:
	docker-compose ps

dc-bash:
	docker-compose exec app bash
dc-bash-db:
	docker-compose exec database bash

dc-composer-install:
	docker-compose exec app bash -c "composer install"
dc-migrate:
	docker-compose exec app bash -c "php artisan migrate"
dc-seeding:
	docker-compose exec app bash -c "php artisan db:seed"
dc-tinker:
	docker-compose exec app php artisan tinker
dc-key-generate:
	docker-compose exec app bash -c "php artisan key:generate"
dc-cache-clear:
	docker-compose exec app bash -c "php artisan cache:clear"

dc-npm-i:
	docker-compose run --rm nodejs npm install
