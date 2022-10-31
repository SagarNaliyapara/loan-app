# Loan App

## How to use

- Clone the repository with __git clone https://github.com/SagarNaliyapara/loan-app.git__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (Created one admin and one user through seeder)
- Admin credentials - admin@test.com, password
- User credentials - test@test.com, password

## Command list to install app
List of commands that can be copied and run in terminal inside the directory where you want to put this project and that will install whole app in one go
```
git clone https://github.com/SagarNaliyapara/loan-app.git
cd loan-app
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
```

## Project Technical Documentation
- Used sanctum for authentication as it is by default available in new laravel app and easy to use in SPA/RestfulAPI projects
- Passport could be another choice if laravel doesn't provide anything by default as passport is also very secure and popular for authentication
- I've used invokable controller (single action controller) to keep controller tidy and clean
- Used simple independent service classes to reuse the logic in future
- Service class are injected in controller and when app grows in can be used in commands, jobs, events etc. for reuse purpose.
- Added interfaces for each models to improve developer experience and avoid typo for fields
- Added multiple features tests for each actions
- Installed package in dev environment to see api documentation, and it can be accessed at http://loan-app.test/request-docs
- Postman collection is attached at root directory - ./Loan-api.postman_collection.json
