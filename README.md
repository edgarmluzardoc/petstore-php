# Petstore PHP

Petstore API with PHP following these standards: https://petstore.swagger.io/

## Pre-Requisites

1. Docker
1. Add `127.0.0.1 petstore.local` to your `/etc/hosts`

## How to run

1. Clone project and go into its root directory.
1. Run `docker-compose up -d && docker exec -it petstore-web bash`
1. Run database migration: `php bin/console doctrine:migrations:migrate`
1. Load database fixtures: `php bin/console doctrine:fixtures:load`
1. Go to http://petstore.local:8083/ (you should see a Symfony Welcome page)
1. All set!

## Database

These are the default variables for the DB (update them in `code/.env` if needed)

1. DB name: `petstoredb`
1. User name: `petstoreuser`
1. User pass: `petstorepass`

 ## Unit testing

- Go into the `petstore-web` container: `docker-compose exec petstore-web bash`
- Then run: `bin/phpunit tests/`
- You should see an OK message with the number of tests and assertions.
