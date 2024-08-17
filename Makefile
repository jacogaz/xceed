APP_CONTAINER_NAME = app

up:
	docker-compose up --build -d

install:
	docker-compose run --rm app composer install

test:
	docker-compose exec $(APP_CONTAINER_NAME) vendor/bin/phpunit

down:
	docker-compose down
