# ArkaSEO - CMS Blog & Pages Management

Aplikasi CMS Blog dan Pages Management berbasis Laravel 11, MySQL, Tailwind CSS, dan Spatie Laravel Permission.

## 🚀 Fitur Utama

✅ **Autentikasi Admin Only** - Login tanpa register, akses terbatas untuk admin  
✅ **Role & Permission Management** - Menggunakan Spatie Laravel Permission  
✅ **Dynamic Navbar** - Menu navbar 100% dinamis dari database dengan support parent-child  
✅ **Pages Management** - Kelola halaman statis (About, Contact, Services, dll)  
✅ **Categories Management** - Kategori blog dengan support parent-child  
✅ **Posts Management** - CRUD blog dengan thumbnail, status (draft/published), SEO-friendly slug  
✅ **Dashboard Admin** - Statistics & monitoring konten  
✅ **Tailwind CSS** - Modern, responsive UI untuk admin & frontend  
✅ **SEO Friendly** - Slug otomatis, meta description, Route Model Binding

## 📦 Tech Stack

- **Laravel 11** - Backend Framework
- **MySQL** - Database
- **Tailwind CSS** - Styling Framework
- **Spatie Laravel Permission** - Role & Permission Management
- **Laravel Breeze** - Authentication (Login Only)
- **Vite** - Asset Bundler

## 🔧 Installation

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Create Database

Buka **phpMyAdmin** (http://localhost/phpmyadmin) dan buat database baru:

- Nama: `arka-seo`
- Collation: `utf8mb4_unicode_ci`

Atau via script:

```bash
php create_database.php
```

### 3. Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

### 4. Build Assets

```bash
npm run build
# atau untuk development:
npm run dev
```

### 5. Serve Application

```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

## 🔐 Default Credentials

**Admin Login:**

- URL: http://localhost:8000/login
- Email: `admin@arkaseo.com`
- Password: `password`

## 📍 URL Structure

### Frontend (Public)

- Home: `/`
- Blog List: `/blog`
- Blog Detail: `/blog/{slug}`
- Category: `/category/{slug}`
- Page: `/page/{slug}`

### Admin Panel (Protected)

- Dashboard: `/admin/dashboard`
- Menus: `/admin/menus`
- Pages: `/admin/pages`
- Categories: `/admin/categories`
- Posts: `/admin/posts`

## 🗄️ Database Schema

- **users** - Admin users
- **roles & permissions** - Spatie role/permission tables
- **menus** - Dynamic navbar (parent-child support)
- **pages** - Static pages
- **categories** - Blog categories (parent-child support)
- **posts** - Blog posts (with thumbnail, status, SEO)

## 📝 Sample Data

Seeder menciptakan:

- 1 admin user
- 3 categories (SEO, Technology, Digital Marketing)
- 3 pages (About, Contact, Services)
- 4 posts (3 published, 1 draft)
- Dynamic menu structure dengan submenu

## 🎨 Customization

### Tailwind CSS

Edit `resources/css/app.css` untuk custom components:

- `.btn-primary`, `.btn-secondary`, `.btn-danger`, `.btn-success`
- `.form-input`, `.form-label`
- `.card`, `.sidebar-link`

### App Name

Edit `.env`:

```env
APP_NAME="Your CMS Name"
```

## 🚨 Troubleshooting

**Database Error:**

- Pastikan MySQL running (XAMPP)
- Database `arka-seo` sudah dibuat
- Cek credentials di `.env`

**Tailwind Not Working:**

```bash
npm run build
```

**Storage Error:**

```bash
php artisan storage:link
```

## 📚 Documentation

Struktur file lengkap ada di [README.md](README.md).

---

**Built with ❤️ using Laravel, Tailwind CSS, and Spatie Permission**
