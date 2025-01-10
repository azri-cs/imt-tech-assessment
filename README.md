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
