# About
This is an example of how to unit test an entity depends on the connected user, please read [this article](https://medium.com/@youssefbenhssaien/how-to-connect-a-user-in-unit-test-within-symfony-in-an-example-bcbf5ab4a86a) for more explanations

# Installation
## 1. Download
Download the package with git zip or by `git clone git@github.com:ybenhssaien/sf-unittest-login.git`
## 2. Install dependencies
Don't forget to launch `composer install` or `make install` to install required dependencies
## 3. Install database
> If you have `make` already installed just skip this step

> For windows fans, you can download `Make` [here](http://gnuwin32.sourceforge.net/packages/make.htm)

If you don't have `make` installed you need to create manually the database and run migrations, executes the following commands from the app root :
```shell
bin/console doctrine:database:create -e test
bin/console doctrine:migrations:migrate --no-interaction -e test
```

## 4. Run tests
If you prefer `make` commands or have it already installed just run this command (which create database & execute migrations) :

```shell
make phpunit
```

If you don't have make installed, run :

```shell
bin/phpunit
```