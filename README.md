# HROC RDC

Website and administration panel for **Healing and Rebuilding Our Communities (HROC RDC)** — an NGO working on peace, human rights, governance, and sustainable development in the Democratic Republic of Congo.

Built with **Laravel 12**, **Tailwind CSS**, and **Alpine.js**.

## Features

### Public website
- Home page with sliders, approaches, blog highlights, and partners
- About pages (mission, vision, objectives, who we are)
- Actions (domains, approaches, realisations, reports, gallery)
- Blog with paginated listing and single post pages
- Contact form and donation page
- Google Translate integration (French / English)

### Blog
- Rich text content via **TinyMCE**
- Featured image and additional gallery images (JSON field)
- Publish / draft toggle (publication date set automatically)
- Fancybox lightbox on post gallery (right sidebar on desktop)
- Admin preview before publishing

### Admin panel (`/dashboard`)
- Dashboard with content stats and recent posts
- Manage blog posts, realisations, gallery images, sliders, partners, reports
- Manage domains, approaches, objectives, and company info
- User profile and settings

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+ and npm
- MySQL (or MariaDB)
- Web server (Apache via XAMPP, or `php artisan serve`)

## Installation

### 1. Clone and install dependencies

```bash
cd hroc-rdc
composer install
npm install
```

### 2. Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials:

```env
APP_NAME="HROC RDC"
APP_URL=http://localhost/hroc-rdc/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hroc_rdc
DB_USERNAME=root
DB_PASSWORD=
```

Create the database in MySQL (e.g. `hroc_rdc`), then run migrations:

```bash
php artisan migrate
```

### 3. Storage link

Uploaded images (blog posts, gallery, etc.) are stored in `storage/app/public`. Link them to the web root:

```bash
php artisan storage:link
```

### 4. Build frontend assets

**Development:**

```bash
npm run dev
```

**Production:**

```bash
npm run build
```

### 5. Run the application

**With XAMPP:** point your browser to `http://localhost/hroc-rdc/public` (adjust path if needed).

**With Artisan:**

```bash
php artisan serve
```

Then open `http://127.0.0.1:8000`.

### Quick setup (Composer script)

```bash
composer run setup
```

Runs install, `.env` copy, key generate, migrate, `npm install`, and `npm run build`.

## Development

Start the dev stack (server, queue, Vite):

```bash
composer run dev
```

Run tests:

```bash
composer run test
```

## Authentication

The admin area requires a logged-in user. Register or log in via Laravel Breeze routes (`/login`, `/register`). After login, access the dashboard at `/dashboard`.

## Main routes

| Area | Path |
|------|------|
| Home | `/` |
| Blog | `/blog` |
| Blog post | `/blog/{slug}` |
| Contact | `/contact` |
| Dashboard | `/dashboard` |
| Blog posts (admin) | `/admin/blog-posts` |
| Create post | `/admin/blog-posts/create` |
| Preview post | `/admin/blog-posts/{id}/preview` |

## Project structure (high level)

```
app/
  Http/Controllers/       # PageController, DashboardController, Admin/*
  Models/                 # BlogPost, Realisation, GalleryImage, etc.
resources/views/
  pages/                  # Public NGO pages
  admin/                  # Admin CRUD views
  layouts/                # app (admin), ngo (public)
routes/web.php            # Web routes
```

## Tech stack

- **Backend:** Laravel 12, PHP 8.2+
- **Auth:** Laravel Breeze
- **Frontend:** Tailwind CSS 3, Alpine.js, Vite
- **Editor:** TinyMCE 6 (blog content)
- **Lightbox:** Fancybox 4 (blog gallery)
- **Database:** MySQL

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
