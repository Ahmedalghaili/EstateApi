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
- Composer### Steps to Run Locally

### Steps to Run Locally

# 1. Clone the repository
git clone https://github.com/Ahmedalghaili/EstateApi.git

# 2. Navigate into the project directory
cd EstateApi

# 3. Install dependencies using Composer
composer install

# 4. Set up the .env file
# If the .env file does not exist, copy the .env.example to .env
cp .env.example .env

# 5. Generate the application key
php artisan key:generate

# 6. Configure your database connection
# Open the .env file and set the following database connection variables:
# DB_CONNECTION: Your database driver (e.g., mysql)
# DB_HOST: The host of your database server (e.g., 127.0.0.1)
# DB_PORT: The port of your database server (e.g., 3306 for MySQL)
# DB_DATABASE: The name of your database
# DB_USERNAME: Your database username
# DB_PASSWORD: Your database password

# 7. Run the database migrations
php artisan migrate

# 8. Serve the application locally
php artisan serve

# Now you can access the API at http://127.0.0.1:8000


# API Endpoints
POST /api/properties: Create a new property.
GET /api/properties: List all properties.
GET /api/properties/search: Search for properties by criteria (type, address, size, etc.).

# Future Improvements
Implement user authentication to manage properties.
Add validation for user inputs.
Implement rate limiting to protect the API from abuse.

I added the specific instruction to configure the database connection in the `.env` file. Let me know if you need anything else!

