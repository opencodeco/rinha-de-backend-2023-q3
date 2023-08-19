IMAGE_NAME=opencodeco/rinha-de-backend:2023-q3

default: build push

vendor/autoload.php:
	docker compose exec app composer install

.env: vendor/autoload.php
	cp .env.example .env

.PHONY: setup
setup:
	sh setup.sh

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
	docker compose exec app1 composer test

.PHONY: stress
stress: vendor/autoload.php
	sh ./stress-test/run-test.sh
