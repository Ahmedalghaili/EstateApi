### Steps to Run Locally

1. **Clone the repository**
   ```bash
   git clone https://github.com/Ahmedalghaili/EstateApi.git
   ```

2. **Navigate into the project directory**
   ```bash
   cd EstateApi
   ```

3. **Install dependencies using Composer**
   ```bash
   composer install
   ```

4. **Generate the application key**
   ```bash
   php artisan key:generate
   ```

5. **Configure your database connection**
   - Open the `.env` file and set the following database connection variables:
     - `DB_CONNECTION`: Your database driver (e.g., `mysql`)
     - `DB_HOST`: The host of your database server (e.g., `127.0.0.1`)
     - `DB_PORT`: The port of your database server (e.g., `3306` for MySQL)
     - `DB_DATABASE`: The name of your database
     - `DB_USERNAME`: Your database username
     - `DB_PASSWORD`: Your database password

6. **Run the database migrations**
   ```bash
   php artisan migrate
   ```

7. **Serve the application locally**
   ```bash
   php artisan serve
   ```

   You can now access the API at [http://127.0.0.1:8000](http://127.0.0.1:8000)
