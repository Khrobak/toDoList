

## Deploy

1. Установить и настроить сервер, СУБД, PHP скачать composer (если не установлены)
2. Склонировать проект git clone <ссылка> 
3. Скопировать содержимое .env.example в .env cp .env.example .env 
4. Отредактировать .env
5. composer install
6. npm install
7. php artisan key:generate 
8. php artisan migrate --seed
9. php artisan storage:link

