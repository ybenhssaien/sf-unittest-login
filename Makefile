# Variables
SF = bin/console --ansi

##
## Unit test
##---------------------------------------------------------------------------

phpunit:
	$(SF) doctrine:database:create -e test
	$(SF) doctrine:migrations:migrate --no-interaction -e test
	bin/phpunit

##
## App
##---------------------------------------------------------------------------

install:
	composer install