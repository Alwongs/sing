# Установка нового проекта в текущую папку на ларавел 11
composer create-project laravel/laravel:11.* . --prefer-dist

# Установка пакета аутентификации
composer require laravel/breeze --dev
php artisan breeze:install blade

# Установка зависимостей
npm install

# Сборка и запуск проекта
npm run build && npm run dev 

# Выполнить миграции
php artisan migrate

# Установка SCSS в Laravel:
npm install -D sass

# Установка библиотеки для работы с изображениями
composer require intervention/image


# Чистка кеша:
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear