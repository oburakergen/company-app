# Company App
A simple news application that allows users to view, create, update, and delete news articles.

### Installation

#### Local Development
1. Clone the repository
```bash
git git@github.com:oburakergen/company-app.git
```

2. Install dependencies
```bash
cd company-app
composer install
npm install
```
3. Create a `.env` file in the root directory of the project and add the following environment variables
```bash
# .env
```

4. Generate an application key
```bash
php artisan key:generate
php artisan app:setup
```

5. Start the server
```bash
npm run dev
php artisan serve
```