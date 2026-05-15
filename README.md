# SyncDataBackend

Laravel-приложение для синхронизации торговых данных (доходы, заказы, продажи, склады) через внешний API.

---

## Стек

- PHP 8.5
- Laravel 13
- SQLite

---

## Установка

```bash
git clone https://github.com/nosmileface/SyncDataBackend.git
cd SyncDataBackend

composer install

cp .env.example .env
php artisan key:generate

Указать данные предоставленного сервера

API_URL=
API_PORT=
API_KEY=
```

В `.env` укажите:

```env
DB_CONNECTION=sqlite
```

Создайте файл базы данных и выполните миграции:

```bash
touch database/database.sqlite
php artisan migrate
```

---

## Запуск

```bash
php artisan serve
```

---

## Синхронизация данных

### Вручную (разовый запуск)

```bash
php artisan app:sync-incomes-command
php artisan app:sync-orders-command
php artisan app:sync-sales-command
php artisan app:sync-stocks-command
```

### По расписанию (ежедневно, автоматически)

Добавьте в crontab:

```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

Или запустите планировщик вручную для отладки:

```bash
php artisan schedule:run
```

---

## API

После запуска доступны эндпоинты для проверки данных:

| Метод | URL | Описание |
|-------|-----|----------|
| GET | `/api/v1/test/incomes` | Доходы |
| GET | `/api/v1/test/orders` | Заказы |
| GET | `/api/v1/test/sales` | Продажи |
| GET | `/api/v1/test/stocks` | Склады |

---

## Структура

```
app/
├── Console/Commands/     # Artisan-команды запуска синхронизации
├── Jobs/Order/           # Очередные задачи (SyncIncomeJob и др.)
├── Models/               # Eloquent-модели (Income, Order, Sale, Stock)
├── Repositories/         # Слой работы с БД
├── Services/             # Бизнес-логика синхронизации
└── Http/                 # API-контроллеры
```

---

## Логи

Каждый тип данных пишет в отдельный канал:

```
storage/logs/incomes.log
storage/logs/orders.log
storage/logs/sales.log
storage/logs/stocks.log
```