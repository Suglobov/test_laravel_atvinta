dc-up:
	docker-compose up --build -d

dc-down:
	docker-compose down

dc-ps:
	docker-compose ps

dc-bash:
	docker-compose exec app bash

dc-ci:
	docker-compose exec app bash -c "composer install"

dc-akg:
	docker-compose exec app bash -c "php artisan key:generate"

dc-acc:
	docker-compose exec app php artisan config:cache

dc-migrate:
	docker-compose exec app bash -c "php artisan migrate -v"

dc-seeding:
	docker-compose exec app bash -c "php artisan db:seed"

dc-cache-clear:
	docker-compose exec app bash -c "php artisan cache:clear"
