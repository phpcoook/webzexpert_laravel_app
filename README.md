# 🏡 Real Estate Property API (Laravel 12 + Docker)

A RESTful API to manage real estate properties, built with Laravel 12 and Docker.

---

## 🚀 Getting Started (Local Setup with Docker)

### 1. Clone the Repository

```bash
git clone https://github.com/phpcoook/webzexpert_laravel_app.git
cd webzexpert_laravel_app
```

### 2. Start Docker Containers

```bash
docker-compose up -d
```

### 3. Set up environment

```
cp .env.example .env
```

### 3. Install Dependencies, Database migration and Serve

```bash
docker exec -it laravel_app bash
```
#### inside container

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=8000
```

### 4. Access the laravel app
Visit: http://localhost:8000

### 5. API Routes

| Method | Endpoint                 | Description            | Sample Request Body |
| ------ | ------------------------ | ---------------------- | ------------------- |
| GET    | `/api/real-estates`      | List all properties    | —                   |
| GET    | `/api/real-estates/{id}` | Show a single property | —                   |
| POST   | `/api/real-estates`      | Create a property      | ✅ Yes (see below)   |
| PUT    | `/api/real-estates/{id}` | Update a property      | ✅ Yes (see below)   |
| DELETE | `/api/real-estates/{id}` | Soft delete a property | —                   |

### 6. Sample Request Body

```
{
  "name": "City Center Office",
  "real_estate_type": "commercial_ground",
  "street": "Main Avenue",
  "external_number": "A-505",
  "internal_number": "Unit 12B",
  "neighborhood": "Downtown District",
  "city": "New York",
  "country": "US",
  "rooms": 0,
  "bathrooms": 0,
  "comments": "Perfect for business and retail use."
}

```

### 7. Run Tests

```bash
php artisan test
```
