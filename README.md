# Zoo Click API

REST API на Laravel 11 для управления оборудованием и его типами.  
Документация автоматически отображается через Swagger UI.

---

## Быстрый запуск

###  Установка зависимостей

```bash
composer install
```

### Копирование `.env` и создание базы

```bash
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
```

### Настройте `.env`

Убедитесь, что у вас указано:

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### Запуск миграций и сидов

```bash
php artisan migrate --seed
```

---

##  Запуск сервера

Запустите Laravel на порте `8081`:

```bash
php artisan serve --port=8081
```

Теперь API будет доступен по адресу:

```
http://localhost:8081
```

---

## Документация API (Swagger UI)

Открыть документацию:

```
http://localhost:8081/api/documentation
```

Если не открывается — проверьте, что файл `storage/api-docs/api-docs.json` существует.

---

## Авторизация через токен

1. Выполните запрос:

```
POST http://localhost:8081/api/user/login
```

Пример тела запроса:

```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

2. В ответе получите токен:

```json
{
  "status": "success",
  "data": {
    "token": "1|abcdef123456...",
    "user": {
      "id": 1,
      "email": "admin@example.com",
      "name": "Admin"
    }
  }
}
```

3. В Swagger UI нажмите **Authorize** (в правом верхнем углу)  
   и вставьте токен в формате:

```
1|abcdef123456...
```

После этого можете вызывать все защищённые методы API прямо из браузера.

---

## Фильтрация

В списке оборудования и типов оборудования можно использовать параметры фильтрации:

- `GET /api/equipment?serial_number=ABC`
- `GET /api/equipment-type?name=Маршрутизатор`

---

## Прочее

- Все операции CRUD работают через стандартные REST-методы
- Серийный номер валидируется по маске из `EquipmentType`

---
