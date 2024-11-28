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

```bash
git clone https://github.com/Ahmedalghaili/EstateApi.git
cd EstateApi
composer install
php artisan key:generate
# Configure your .env file with your database connection. 
# Set the DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD variables in the .env file
php artisan migrate
php artisan serve
