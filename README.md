# Website-to-App Converter Platform

A professional, scalable PHP 8+ MVC platform designed to convert compatible WordPress, WooCommerce, and Shopify websites into native-ready mobile applications.

## Architecture Overview

- **Backend**: PHP 8+ MVC (Model-View-Controller) architecture
- **Database**: MySQL with PDO prepared statements and transactions
- **Authentication**: Native PHP sessions with role-based access control (User / Admin)
- **Payment Gateway**: Razorpay integration with order creation and signature verification
- **APIs**: RESTful internal endpoints for website analysis, live previews, and app building
- **Frontend Architecture**: Modern HTML5, CSS3, and Vanilla JavaScript / AJAX

## Directory Structure

```
webintoapp/
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
├── database/               # Complete SQL dump (database.sql), schema (schema.sql), seeders
├── storage/                # Runtime logs, cache, generated builds, and reports
└── app-engine/             # Mobile app builder templates, themes, features, and assets
```

## Hostinger Git Deployment Guide

### 1. Database Setup
1. Log in to **Hostinger hPanel** > **Databases** > **MySQL Databases**.
2. Create a new MySQL Database (take note of DB Name, Username, and Password).
3. Open **phpMyAdmin** for your new database.
4. Click **Import** > Choose file: `database/database.sql` from this repository > Click **Go**.
   *(All 16 tables, default pricing plans, themes, and admin user will be set up).*

### 2. Connect GitHub Repository to Hostinger
1. In Hostinger hPanel, go to **Advanced** > **GIT**.
2. Set repository details:
   - **Repository URL**: `https://github.com/Vibesoft-in/webtoapp.git`
   - **Branch**: `main`
   - **Install Path**: `/public_html` (or your subdomain folder)
3. Click **Create** or **Deploy**.
4. Enable **Auto Deployment / Webhook**:
   - Copy the Webhook URL provided by Hostinger.
   - In GitHub repository > **Settings** > **Webhooks** > **Add webhook**.
   - Paste the Hostinger webhook URL, set Content type to `application/json`, and save.
   - Now, every `git push` to `main` will automatically deploy live to Hostinger!

### 3. Configure Environment (.env) on Hostinger
1. In Hostinger **File Manager**, navigate to the project root (`public_html`).
2. Create or edit `.env` (using `.env.example` as a template):
   ```env
   APP_NAME="Website to App Converter"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=u123456789_dbname
   DB_USER=u123456789_dbuser
   DB_PASS=your_db_password
   DB_CHARSET=utf8mb4
   ```

### 4. Admin Credentials
- **Email**: `admin@converter.local`
- **Password**: `Admin@123456`