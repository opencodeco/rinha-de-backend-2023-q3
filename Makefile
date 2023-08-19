IMAGE_NAME=opencodeco/rinha-de-backend:2023-q3

default: build push

.env:
	cp .env.example .env

vendor/autoload.php:
	docker compose exec api1 composer install

.PHONY: build
build:
	docker build -t $(IMAGE_NAME) .

.PHONY: push
push:
	docker push $(IMAGE_NAME)

.PHONY: up
up: .env
	docker compose up -d

.PHONY: test
test: vendor/autoload.php
	docker compose exec api1 composer test
