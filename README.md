# Nordroy Marine & Power — Corporate CMS

[![Laravel 11](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com)
[![Livewire 3](https://img.shields.io/badge/Livewire-3-pink.svg)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-blue.svg)](https://tailwindcss.com)

A high-performance, modular enterprise web platform and content management system custom-engineered for **Nordroy Marine & Power**. Features dynamic Turbocharger engineering services, genuine spare parts catalog, interactive video & photo galleries, high-speed dynamic balancing data sheets, and a live Theme Studio customizer.

---

## 🎨 Brand Identity

- **Primary Brand Color:** `#003C58` (Official Logo Navy)
- **Secondary Brand Color:** `#75767A` (Official Logo Steel Gray)
- **Accent Color:** `#0ea5e9` (Cyan / High-Tech Sky)
- **Theme Default:** **Dark Mode** (Automatic for first-time visitors, toggleable to 100% Light Mode)

---

## 🚀 Cloud Deployment (Render + Aiven)

### 1. Database Setup on Aiven (Free Cloud MySQL / PostgreSQL)
1. Go to [Aiven Console](https://console.aiven.io/) and create a free MySQL or PostgreSQL service (e.g., in `Singapore` or `Frankfurt`).
2. Once the service is running, copy the **Connection Parameters**:
   - `Host` (e.g., `mysql-xxxx.aivencloud.com`)
   - `Port` (e.g., `12345` or `3306`)
   - `User` (e.g., `avnadmin`)
   - `Password`
   - `Database` (e.g., `defaultdb`)

### 2. Web Service Setup on Render (render.com)
1. Push this repository to GitHub: `https://github.com/SASwagoto/nordroy-cms.git`
2. Go to [Render Dashboard](https://dashboard.render.com/) -> Click **New +** -> **Web Service** (or **Blueprint** with `render.yaml`).
3. Connect your repository `nordroy-cms`.
4. Configure:
   - **Environment:** `Docker`
   - **Branch:** `main`
   - **Region:** Choose closest to your Aiven DB (e.g., `Singapore`).
   - **Plan:** Free
5. In **Environment Variables**, set:
   ```env
   APP_NAME="Nordroy Marine & Power"
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=<Generate via artisan or leave empty for auto-generate>
   APP_URL=https://your-service-name.onrender.com

   DB_CONNECTION=mysql
   DB_HOST=<Aiven Host>
   DB_PORT=<Aiven Port>
   DB_DATABASE=<Aiven Database Name>
   DB_USERNAME=<Aiven Username>
   DB_PASSWORD=<Aiven Password>
   DB_SSL_VERIFY_SERVER_CERT=false

   AUTO_MIGRATE=true
   SESSION_DRIVER=cookie
   CACHE_STORE=file
   ```
6. Click **Deploy Web Service**.
   Render will automatically build the container (compile Vite frontend, install PHP dependencies, run migrations and seeds), and make the site live with a free SSL certificate!

---

## 🔐 Default Administrator Login

- **URL:** `https://your-domain.com/login`
- **Email:** `admin@gmail.com`
- **Password:** `12345678`

---

## 🛠 Local Development

```bash
# Clone the repository
git clone https://github.com/SASwagoto/nordroy-cms.git
cd nordroy-cms

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations and seed data
php artisan migrate --seed

# Start development servers
npm run dev
# in a separate terminal:
php artisan serve
```
