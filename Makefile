# Variables
SF = bin/console --ansi

##
## Tests/Qualityis not supported by platform.
##---------------------------------------------------------------------------

phpunit:
	$(SF) doctrine:database:create -e test
	$(SF) doctrine:migrations:migrate --no-interaction -e test
	bin/phpunit
