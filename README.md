# CloudOps

A Laravel-based admin dashboard for managing product inventory, this version includes e-liquids, nicotine salts, and vape devices.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade templates
- **Database:** MySQL

## Requirements

- PHP 8.2+
- Composer
- Node.js 20.19.0+ & npm
- MySQL

## Installing the prerequisites

### PHP 8.2+

**Ubuntu / Debian**

```bash
sudo apt update
sudo apt install -y php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-sqlite3 php8.2-curl unzip
```

**macOS (Homebrew)**

```bash
brew install php
```

**Windows**
Download and run the installer from [windows.php.net/download](https://windows.php.net/download). Choose the **Thread Safe** x64 zip, extract it, and add the folder to your `PATH`.

---

### Composer

**Linux / macOS**

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Windows**
Download and run **Composer-Setup.exe** from [getcomposer.org/download](https://getcomposer.org/download).

---

### Node.js & npm

**Linux / macOS** (via [nvm](https://github.com/nvm-sh/nvm))

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
nvm install --lts
```

**Windows**
Download and run the LTS installer from [nodejs.org](https://nodejs.org).

---

### MySQL

**Ubuntu / Debian**

```bash
sudo apt update
sudo apt install -y mysql-server
sudo systemctl start mysql
sudo mysql_secure_installation
```

**macOS (Homebrew)**

```bash
brew install mysql
brew services start mysql
```

**Windows**
Download and run the installer from [dev.mysql.com/downloads/installer](https://dev.mysql.com/downloads/installer). Choose **MySQL Server** and follow the setup wizard.

---

## Installation

### Clone the repository and install dependencies

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

### Using MySQL

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

## Potential improvements

A list of things that could be added or improved. Great starting points if you want to contribute!

### Tests

- There are no real tests yet, only the default placeholder files Laravel ships with. Adding tests for things like logging in, creating a product, or deleting a brand would make the project more reliable.

### Code quality

- The create and edit product forms use almost identical validation rules. These could be moved into one shared place to avoid repeating the same code twice.
- The icons and badge colours for product categories are defined in multiple places. Keeping them in one place would make them easier to update.
- Small UI elements like buttons and form inputs are written out in full every time they appear. Turning them into reusable Blade components would make the code shorter and easier to maintain.

### Security

- The default login (`test@example.com` / `321`) is fine for local testing but should never be used on a live server.
- The `.env.example` file has `APP_DEBUG=true`, which shows detailed error messages. This should be set to `false` before deploying.
- Right now every logged-in user has full access to everything. It would be good to add basic user roles (e.g. admin vs. read-only).

### Features

- Filters reset whenever you navigating between pages of results. Keeping the active filters in the URL would fix both of these.
- There is no way to sort the product list by clicking a column header (e.g. sort by price or name).
- You can only delete or edit one product at a time. A "select multiple and delete" option would save time.
- Products have no photos. Adding image upload support would make the catalog more useful.
- There is no page for managing users,so you can only add the default one through the database seeder. A simple admin screen to create, edit, or deactivate users would be helpful.
- Dropdown fields (brand, flavor, color) use a plain `<select>` element. Replacing these with a searchable dropdown would make it much easier to find the right option when the list gets long.
