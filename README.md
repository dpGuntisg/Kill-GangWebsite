# Kill Gang

## Stack

- Laravel
- Node.js
- Vue.js + TypeScript
- MySQL

## Setup

### Laravel Backend Setup

Navigate to the Laravel backend directory:

```
cd laravelBackend
cp .env.example .env
composer install
php artisan key:generate
php artisan passport:keys
php artisan migrate
php artisan passport:client --personal
php artisan storage:link
composer require laravel/telescope --dev
php artisan telescope:install
```

###.env file configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="db_name"
DB_USERNAME="db_user"
DB_PASSWORD=

###Vue.js setup
```
cd frontend
npm i
```

###Additional Laravel Backend Setup
php artisan db:seed --class=DatabaseSeeder
php artisan storage:link

