# DevThreads 👕💻

> A full-stack e-commerce store for developer-themed apparel, built with Laravel 12.

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-blue?logo=php)
![License](https://img.shields.io/badge/License-MIT-green)

## About

DevThreads is a print-on-demand e-commerce platform selling developer-themed t-shirts, hoodies, mugs, and stickers. Built from scratch with Laravel to demonstrate full-stack web development skills.

### Features

- 🛍️ **Product Catalog** — Browse by category, search, filter, sort
- 🛒 **Shopping Cart** — Session-based cart with size selection
- 📱 **Responsive Design** — Mobile-first with Tailwind CSS
- 🔍 **SEO Optimized** — Meta tags, clean URLs (`/shop/git-push-force-friday`), semantic HTML
- 👨‍💼 **Admin Panel** — CRUD for products (auth-protected)
- 🗄️ **Database Design** — Migrations, relationships, seeders with sample data
- 🔒 **Security** — CSRF protection, input validation, parameterized queries

### Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12, PHP 8.4 |
| Frontend | Blade Templates, Tailwind CSS |
| Database | SQLite (dev) / MySQL (production) |
| Auth | Laravel built-in authentication |

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer

### Installation

```bash
# Clone the repository
git clone https://github.com/TornadoSW/devthreads.git
cd devthreads

# Install dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations and seed sample data
php artisan migrate --seed

# Start development server
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

## Project Structure

```
app/
├── Models/          # Eloquent models (Product, Category, Order, etc.)
├── Http/
│   └── Controllers/
│       ├── HomeController.php        # Landing page
│       ├── ProductController.php     # Shop & product pages
│       ├── CartController.php        # Cart management
│       └── Admin/                    # Admin panel controllers
database/
├── migrations/      # Database schema
└── seeders/         # Sample product data
resources/
└── views/
    ├── layouts/     # Base layout with nav & footer
    ├── products/    # Shop listing & product detail pages
    ├── cart/        # Shopping cart
    └── admin/       # Admin panel views
```

## Roadmap

- [x] Product catalog with categories
- [x] Shopping cart
- [x] Admin product management
- [x] SEO meta tags
- [ ] Stripe payment integration
- [ ] Order management
- [ ] User authentication & order history
- [ ] Blog section for content marketing
- [ ] Email notifications

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
