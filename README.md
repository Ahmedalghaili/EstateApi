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
Navigate into the project directory:

bash
Copy code
cd EstateApi
Install dependencies using Composer:

bash
Copy code
composer install
Set up the .env file: Copy .env.example to .env:

bash
Copy code
cp .env.example .env
Generate the application key:

bash
Copy code
php artisan key:generate
Set up the database:

Configure your database connection in the .env file.
Run the migrations:
bash
Copy code
php artisan migrate
Serve the application:

bash
Copy code
php artisan serve
API Endpoints
POST /api/properties: Create a new property.
GET /api/properties: List all properties.
GET /api/properties/search: Search for properties by criteria (type, address, size, etc.).
Future Improvements
Implement user authentication to manage properties.
Add validation for user inputs.
Implement rate limiting to protect the API from abuse.
sql
Copy code

This is the full content for the `README.md`. You can copy and paste it directly into your proje
