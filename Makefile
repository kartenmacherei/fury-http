.DEFAULT_GOAL := help

.PHONY: cs
cs: vendor ## run PHP CS Fixer
	docker run --rm -v $(PWD):/var/www 047136756731.dkr.ecr.eu-central-1.amazonaws.com/kam-cs:5.1.0

.PHONY: vendor
test: vendor ## run all tests
	docker compose run --rm -w /var/www php vendor/bin/phpunit

vendor: composer.json composer.lock ## install dependencies
	docker compose run --rm -w /var/www php composer install

.PHONY: shell
shell: ## open a shell in a fresh container
	docker compose run --rm -w /var/www php ash

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'