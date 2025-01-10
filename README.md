# imt-tech-assessment
My documentation for IMT Tech assessment for Full Stack Laravel Developer

## Installations
1. ```bash
   git clone https://github.com/azri-cs/imt-assessment
   ```
2. ```bash
    cd imt-assessment
   ```
3. ```bash
    cp .env.example .env && cp backend/.env.example backend/.env
   ```
4. Adjust the value of both `.env` files accordingly.
5. ```bash
   docker compose up -d --build
   ```
6. ```bash
   docker compose exec backend php artisan key:generate
   ```
7. ```bash
   docker compose exec backend php artisan migrate
   ```

Now you can access the Vue application on http://localhost while Laravel backend on http://localhost/api.

Further step would be to configure physical Nginx to point a domain to the exposed port and configure SSL.

# NOTES
1. `'errCode'` is using the same 1001 value due to documentation provided have been using it for all error response code.
2. No logging on `catch (HttpResponseException)` as it is intentional to catch the validation error.
3. Since all these exceptions will be handled the same way (same response, same logging), there is only 2 catch blocks. If not, there should be each catch block for QueryException, ModelNotFoundException, and PDOException.
