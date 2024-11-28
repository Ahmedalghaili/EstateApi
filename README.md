# EstateApi

EstateApi is a simple RESTful API for managing real estate properties, built using PHP and Laravel.

## Features
- Create properties with details like type (house/apartment), address, size, number of bedrooms, price, and geolocation (latitude/longitude).
- Search properties by type, address, size, number of bedrooms, and price.
- Perform geographical searches based on latitude, longitude, and a radius.

## Installation

### Requirements
- PHP >= 8.0
- Laravel >= 9.x
- Composer
### Steps to Run Locally

1. Clone the repository:
   ```bash
   git clone https://github.com/Ahmedalghaili/EstateApi.git
   
2. Navigate into the project directory:

```bash
cd EstateApi

3- Install dependencies using Composer:

```bash
composer install

4-Set up the .env file:

Generate the application key:

bash
Copy code
```bash
php artisan key:generate

Configure your database connection:

Open the .env file and set the following database connection variables:
DB_CONNECTION: Your database driver (e.g., mysql).
DB_HOST: The host of your database server (e.g., 127.0.0.1).
DB_PORT: The port of your database server (e.g., 3306 for MySQL).
DB_DATABASE: The name of your database.
DB_USERNAME: Your database username.
DB_PASSWORD: Your database password.
