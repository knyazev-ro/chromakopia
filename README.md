# Laravel + React JSX + Inertia

## Установка и настройка окружения

### 1. Установка Composer
Composer — это менеджер пакетов для PHP, аналог pip в Python. Убедись, что он установлен:

[Скачать Composer](https://getcomposer.org/download/)

### 2. Установка Laravel (при необходимости)
Проверить актуальность версии Laravel можно в официальной документации:

[Документация Laravel](https://laravel.com/docs/12.x/installation)

### 3. Клонирование репозитория
Склонируй репозиторий проекта с GitHub:
```sh
git clone <ссылка-на-репозиторий>
cd <папка-проекта>
```

### 4. Установка NVM
NVM (Node Version Manager) помогает управлять версиями Node.js. 
Скачай и установи его:

[NVM на GitHub](https://github.com/nvm-sh/nvm#installing-and-updating)

### 5. Установка Node.js нужной версии
После установки NVM установи и активируй Node.js версии 18.20.7:
```sh
nvm install 18.20.7
nvm use 18.20.7
```

### 6. Установка зависимостей проекта
В корневой директории проекта выполни:
```sh
composer install
npm install
```


```mysqlsh
CREATE DATABASE chromakopia CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

CREATE USER 'chromakopia_user'@'localhost' IDENTIFIED BY '123';

GRANT ALL PRIVILEGES ON chromakopia.* TO 'chromakopia_user'@'localhost';

FLUSH PRIVILEGES;
```

### 7. Инициализация проекта
После установки зависимостей выполни следующие команды:
```sh
php artisan key:generate
php artisan storage:link
php artisan migrate:refresh --seed
npm run dev
php artisan serve
```

### 8. Готово!
Ты молодец! 🎉

