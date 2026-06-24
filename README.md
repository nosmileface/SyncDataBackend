# SyncDataBackend

Laravel-приложение для синхронизации торговых данных (доходы, заказы, продажи, склады) через внешний API.

---

## Стек

- PHP 8.5
- Laravel 13
- MySQL 8.0
- Docker

---

## Установка и запуск через Docker

```bash
git clone https://github.com/nosmileface/SyncDataBackend.git
cd SyncDataBackend
cp .env.example .env
```

В `.env` укажите:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_EXTERNAL_PORT=3307
DB_DATABASE=sync_db
DB_USERNAME=sync_user
DB_PASSWORD=sync_password
DB_ROOT_PASSWORD=root

API_URL=
API_PORT=
API_KEY=
```

Запустите контейнеры:

```bash
docker-compose up -d --build
```

Выполните миграции и сидеры:

```bash
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed
```

Приложение доступно на `http://localhost:8080`

---

## Установка без Docker

```bash
git clone https://github.com/nosmileface/SyncDataBackend.git
cd SyncDataBackend
composer install
cp .env.example .env
php artisan key:generate
```

В `.env` укажите:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sync_db
DB_USERNAME=sync_user
DB_PASSWORD=sync_password

API_URL=
API_PORT=
API_KEY=
```

```bash
php artisan migrate
php artisan serve
```

---

## Управление сущностями

Создание компании, аккаунтов, API-сервисов и токенов через консоль:

```bash
php artisan app:create-company
php artisan app:create-account
php artisan app:create-api-service
php artisan app:create-token-type
php artisan app:create-account-token
```

---

## Синхронизация данных

### Вручную

```bash
php artisan app:sync-incomes
php artisan app:sync-orders
php artisan app:sync-sales
php artisan app:sync-stocks
```

### По расписанию (ежедневно дважды в день — 6:00 и 18:00)

Добавьте в crontab:

```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

---

## API

| Метод | URL             | Описание |
|-------|-----------------|----------|
| GET | `/api/v1/incomes` | Доходы |
| GET | `/api/v1/orders` | Заказы |
| GET | `/api/v1/sales` | Продажи |
| GET | `/api/v1/stocks` | Склады |

```bash
perPage - кол - во записей на странице.
page - переключить страницу.
```

---

---

## Логи

Каждый тип данных пишет в отдельный канал:

```
storage/logs/incomes.log
storage/logs/orders.log
storage/logs/sales.log
storage/logs/stocks.log
```
