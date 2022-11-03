cs: vendor ## run php-cs-fixer in a Docker container
	docker run --rm -v $(PWD):/var/www 047136756731.dkr.ecr.eu-central-1.amazonaws.com/kam-cs:5.1.0

test:
	docker-compose run --rm -w /var/www php vendor/bin/phpunit
