# NIBSS Service API

This is a Laravel-based API service that integrates with **NIBSS (Nigeria Inter-Bank Settlement System)** for:  
- ✅ BVN Verification  
- ✅ Direct Debit  
- ✅ NIBSS Pay (Funds Transfer)  

It includes:  
- Standardized JSON responses (via `ApiResponse` trait)  
- OpenAPI/Swagger documentation (`l5-swagger`)  
- API authentication support (Bearer token ready)  

---

## 📦 Requirements

- PHP 8.1+  
- Composer  
- Laravel 10+  
- MySQL/Postgres (or any DB supported by Laravel)  

---

## ⚙️ Installation

Clone the repo:

    git clone https://github.com/your-org/nibss-service.git
    cd nibss-service


Install dependencies:

    composer install


Copy environment file and set configs:

    cp .env.example .env
    php artisan key:generate


Update .env with your database and NIBSS credentials:

    APP_NAME="NIBSS Service"
    APP_URL=http://localhost:8000

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nibss_service
    DB_USERNAME=root
    DB_PASSWORD=

    # NIBSS Config
    NIBSS_BASE_URL=https://api.nibss-plc.com.ng
    NIBSS_API_KEY=your_api_key
    NIBSS_SECRET=your_api_secret


Run migrations:

    php artisan migrate

▶️ Running Locally

    composer run dev


API will be available at:

    http://127.0.0.1:8000

📖 API Documentation

Swagger UI is included via L5-Swagger

Generate docs:

    php artisan l5-swagger:generate


Access docs at:

    http://127.0.0.1:8000/api/documentation

🔐 Authentication

This project supports Bearer Token authentication.

In Swagger UI:

    Click Authorize 🔒

Enter your token in the format:

    Bearer <your-token>


    Example request with curl:

    curl -X POST http://127.0.0.1:8000/api/bvn/verify \
        -H "Authorization: Bearer your_token_here" \
        -H "Content-Type: application/json" \
        -d '{"bvn":"12345678901"}'

