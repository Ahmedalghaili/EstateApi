
# EstateApi

EstateApi is a simple RESTful API built using PHP and Laravel for managing real estate properties. This API allows users to create, search, and filter properties based on various criteria such as type, address, size, bedrooms, and geolocation.

## Features
- **Create Properties**: Add properties with details like type (house/apartment), address, size, number of bedrooms, price, and geolocation (latitude/longitude).
- **Search Properties**: Filter properties by type, address, size, number of bedrooms, price, and more.
- **Geographical Search**: Perform searches based on latitude, longitude, and a radius.

## Installation

### Requirements
- PHP >= 8.0
- Laravel >= 9.x
- Composer

### Steps to Run Locally

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Ahmedalghaili/EstateApi.git
   ```

2. **Navigate into the Project Directory**
   ```bash
   cd EstateApi
   ```

3. **Install Dependencies Using Composer**
   ```bash
   composer install
   ```

4. **Set up the `.env` File**  
   Copy the `.env.example` file and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```

5. **Generate the Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Configure Your Database Connection**  
   Open the `.env` file and configure the following database connection variables:
   - `DB_CONNECTION`: Your database driver (e.g., `mysql`).
   - `DB_HOST`: The host of your database server (e.g., `127.0.0.1`).
   - `DB_PORT`: The port of your database server (e.g., `3306` for MySQL).
   - `DB_DATABASE`: The name of your database.
   - `DB_USERNAME`: Your database username.
   - `DB_PASSWORD`: Your database password.

7. **Run the Database Migrations**
   ```bash
   php artisan migrate
   ```

8. **Serve the Application Locally**
   ```bash
   php artisan serve
   ```

   Now, you can access the API at:  
   [http://127.0.0.1:8000](http://127.0.0.1:8000)

## API Endpoints

### Create Property
- **POST** `/api/properties`
- **Payload**:
    ```json
    {
      "type": "house",
      "address": "1234 Elm Street",
      "size": 2000,
      "bedrooms": 4,
      "latitude": 34.0522,
      "longitude": -118.2437,
      "price": 500000
    }
    ```

    - **type**: Type of the property (e.g., "house", "apartment").
    - **address**: Full address of the property.
    - **size**: Size of the property in square feet (or square meters, depending on your system).
    - **bedrooms**: The number of bedrooms in the property.
    - **latitude**: The latitude of the property location.
    - **longitude**: The longitude of the property location.
    - **price**: The price of the property.

### Search Properties
- **GET** `/api/properties/search`
- **Query Parameters**: 
    - `type` (e.g., "house", "apartment")
    - `address` (e.g., "Elm Street")
    - `size` (e.g., "2000")
    - `bedrooms` (e.g., "4")
    - `price` (e.g., "500000")
    - `latitude` (e.g., "34.0522")
    - `longitude` (e.g., "-118.2437")
    - `radius` (e.g., "5" for 5 kilometers)

### Example Request

- **POST** `/api/properties` with the following body:
    ```json
    {
      "type": "house",
      "address": "1234 Elm Street",
      "size": 2000,
      "bedrooms": 4,
      "latitude": 34.0522,
      "longitude": -118.2437,
      "price": 500000
    }
    ```

### Example Response
```json
{
  "message": "Property created successfully!",
  "property": {
    "id": 1,
    "type": "house",
    "address": "1234 Elm Street",
    "size": 2000,
    "bedrooms": 4,
    "latitude": 34.0522,
    "longitude": -118.2437,
    "price": 500000
  }
}
```

### Error Handling
- If any required fields are missing or data is invalid, the API will return an error response with an appropriate message.
  
For example:
```json
{
  "error": "The address field is required."
}
```

## Testing the API

To test the API endpoints, you can use tools like **[Postman](https://www.postman.com/)** or **[Insomnia](https://insomnia.rest/)**. Here’s how you can use Postman:

1. **Download and Install Postman**: Go to [Postman](https://www.postman.com/downloads/) and install the application for your OS.
2. **Make API Requests**:
   - For the **Create Property** endpoint, use the **POST** method, set the URL to `http://127.0.0.1:8000/api/properties`, and add the JSON body in the request body section.
   - For the **Search Properties** endpoint, use the **GET** method with query parameters (e.g., `http://127.0.0.1:8000/api/properties/search?type=house&price=500000`).

## Future Improvements
- Implement user authentication with JWT or OAuth.
- Add additional filters for advanced searches (e.g., available date, amenities).
