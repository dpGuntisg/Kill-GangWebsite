

# DP3-2 Guntis Gūtmanis

# Officiālā Kill Gang vietne

Orģināli bija domāts uztaisīt vietni, kur visu var rediģēt bez programmēšanas, pagaidām ir tikai 0.01 versija tam, šī vietne ir uztaisīta lai parādītu, kā varētu izskatīties gala rezultāts, ja izdotos uztaisīt plānoto.

Funkcijas:

Lietotāji, var reģistrēties, skatīt vietni, pievienot produktus grozā.
Administratori, var mainīt home page youtube video url, un pārējas lapās pievienot, rediģēt vai dzēst ierakstus.
Administratoram pieejama statistika un panelis ar visiem lietotājiem.

### Stack

- Laravel
- Node.js
- Vue.js 
- MySQL

## Setup

### Laravel Backend Setup

Dodies Uz Laravel Backend direktoriju:      

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

### FrontEnd Setup
```
cd frontend
npm i
```

### Adicionāla Laravel Backend Setup
```
php artisan db:seed --class=DatabaseSeeder

```

### Lai palaistu FrontEnd
```
cd FrontEnd
npm run dev
```
### Lai palaistu Backend
```
cd laravel
php artisan serve
```
