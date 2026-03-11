# CloudOps

A Laravel-based admin dashboard for managing product inventory, this version includes e-liquids, nicotine salts, and vape devices.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade templates
- **Database:** SQLite (default) / MySQL (recommended)

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm

## Installation

### Clone the repository and install PHP-packages

```bash
git clone https://github.com/LKotlinska/CloudOps.git
cd CloudOps
composer run setup
php artisan db:seed
```

`composer run setup` installs PHP and JS dependencies, copies `.env.example` to `.env`, generates an app key, runs migrations, and builds frontend assets. The seed step adds test data and the default admin user.

### Run the HTTP server

```bash
php artisan serve
```

Then open `http://localhost:8000` in your browser.

### Using MySQL instead of SQLite

By default the app uses SQLite (no database server required). To switch to MySQL, first create a database:

```bash
# Login to MySQL
mysql -u root
# OR with password
sudo mysql -u root -p

CREATE DATABASE CloudOps;
```

Then update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=CloudOps
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run `php artisan migrate --seed`.

## Default credentials (seeded)

| Field    | Value            |
| -------- | ---------------- |
| Email    | test@example.com |
| Password | 321              |

## Features

### Product catalog management

- Full CRUD for products, brands, categories, flavors, and colors
- Products belong to one of three categories: **Vape**, **E-Liquid**, or **Nicotine Salt**
- Products have fields for price, stock, nicotine strength (mg), and volume (ml)
- Many-to-many flavor assignments per product

### Vape-specific attributes

Vape products have additional attributes managed separately: **color**, **pod system support** (boolean), and **puff count**. The create/edit form dynamically shows or hides these fields based on the selected category.

### Dashboard with advanced filtering

The main overview page supports combining multiple filters simultaneously:

- Tab-based category filter (All / Vape / E-Liquid / Nicotine Salt)
- Text search by product name or brand
- Brand dropdown
- Price range (min / max)
- Stock status (In Stock / Low Stock / Out of Stock)
- Flavor filter
- Color filter (vapes only)

Stats cards at the top show the total product count broken down by category.

### Referential integrity on deletion

Brands, categories, flavors, and colors cannot be deleted while products are assigned to them. The app returns an error instead of cascading or silently failing.
