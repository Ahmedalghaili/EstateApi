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
   `git clone https://github.com/Ahmedalghaili/EstateApi.git`
2. Navigate into the project directory:  
   `cd EstateApi`
3. Install dependencies using Composer:  
   `composer install`
4. Set up the `.env` file:  
   Copy `.env.example` to `.env`:  
   `cp .env.example .env`
5. Generate the application key:  
   `php artisan key:generate`
6. Set up the database:  
   - Configure your database connection in the `.env` file.  
   - Run the migrations:  
     `php artisan migrate`
7. Serve the application:  
   `php artisan serve`

## API Endpoints
- **POST /api/properties**: Create a new property.
- **GET /api/properties**: List all properties.
- **GET /api/properties/search**: Search for properties by criteria (type, address, size, etc.).

## Future Improvements
- Implement user authentication to manage properties.
- Add validation for user inputs.
- Implement rate limiting to protect the API from abuse.
