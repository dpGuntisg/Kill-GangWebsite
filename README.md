# Kill Gang

## Steks

- Laravel
- Node.js
- Vue.js 
- MySQL

## Setaps

### Laravel Pēcpuses Setaps

Dodies Uz Laravel Pēcpuses direktoriju:      
es neesmu gulejis

```
cd laravel
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

### Vides faila konfigurācija
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="db_name"
DB_USERNAME="db_user"
DB_PASSWORD=
```

### Vū džei s setaps
```
cd frontend
npm i
```

### Adicionāla Laravel Pēcpuses Setaps
```
php artisan db:seed --class=DatabaseSeeder
php artisan storage:link
```

