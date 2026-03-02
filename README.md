# Install application
1. Clone the repository: 
```https://github.com/LKotlinska/CloudOps.git```

2. Then start with composer install to get the vendor folder and all the PHP-packages.
```composer install```

3. Copy the content from the .env.example file and paste it in your .env file. Then update the .env file with your credentials.

4. Next you need to generate an APP-KEY. KEY:generate puts APP_KEY in .env which is necessary for Laravel encryption.
```php artisan key:generate```

5. Create a new MySQL database.
```
# Login to MySQL on macOS
mysql -u root

# Login to MySQL on Windows in WSL
sudo mysql -u root -p

# Create a new database in MySQL
CREATE DATABASE CloudOps;

# Select a database to work with in MySQL
USE CloudOps;
```

6. Then run the migrations and seed the database. The migration script adds the tables in your database, and the seeders adds testdata.
```php artisan migrate --seed```

7. Start the development server:
```php artisan serve``` 

# Test credentials
Admin user:
E-mail:
Password:


## Security Vulnerabilities (Laravel)

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License (Laravel)

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
