# Base Project

Petstore API with PHP


## Pre-Requisites

1. Docker
1. Add `127.0.0.1 petstore.local` to your `/etc/hosts`

## How to run

1. Clone project and go into its root directory.
1. Run `docker-compose up -d`
1. Go to http://petstore.local:8083/ (you should see a Symfony Welcome page)
1. All set!

## Database

These are the default variables for the DB (update them in `code/.env` if needed)

1. DB name: `petstoredb`
1. User name: `petstoreuser`
1. User pass: `petstorepass`
