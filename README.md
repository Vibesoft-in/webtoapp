# Website-to-App Converter Platform

A professional, scalable PHP 8+ MVC platform designed to convert compatible WordPress, WooCommerce, and Shopify websites into native-ready mobile applications.

## Architecture Overview

- **Backend**: PHP 8+ MVC (Model-View-Controller) architecture
- **Database**: MySQL with PDO prepared statements and transactions
- **Authentication**: Native PHP sessions with role-based access control (User / Admin)
- **Payment Gateway**: Razorpay integration with order creation and signature verification
- **APIs**: RESTful internal endpoints for website analysis, live previews, and app building
- **Frontend Architecture**: Clean HTML5, CSS3, and Vanilla JavaScript / AJAX

## Directory Structure

```
website-to-app-converter/
├── public/                 # Web root (index.php, .htaccess, assets, uploads)
├── app/
│   ├── Controllers/        # MVC Controllers
│   ├── Models/             # PDO Data Models
│   ├── Services/           # Domain Logic (Analyzer, Integrations, Theme, Addons, Builder)
│   ├── Middleware/         # Request lifecycle guards (Auth, Admin, CSRF)
│   ├── Core/               # Framework Kernel (Router, Database, Request, Response, etc.)
│   ├── Helpers/            # Global utility helpers
│   └── Views/              # Layouts and view templates
├── config/                 # Application configuration arrays
├── routes/                 # Web, API, and Admin route definitions
├── database/               # Schema DDL, migrations, and seeders
├── storage/                # Runtime logs, cache, generated builds, and reports
└── app-engine/             # Mobile app builder templates, themes, features, and assets
```

## Getting Started

1. Place the project folder in your local web server (e.g., `C:/xampp/htdocs/website-to-app-converter`).
2. Configure `.env` with your database credentials and Razorpay keys.
3. Import `database/schema.sql` into MySQL.
4. Access the web application at `http://localhost/website-to-app-converter/public`.