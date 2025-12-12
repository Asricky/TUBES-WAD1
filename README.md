# Tell2U - Sistem Konsultasi Online

Platform konsultasi online untuk mahasiswa dengan fitur auto-booking dan meeting link generation.

## 🚀 Quick Start

### Setup Project

1. **Clone & Install**

```bash
git clone https://github.com/YOUR_USERNAME/TUBES-WAD1.git
cd TUBES-WAD1
composer install
npm install
```

2. **Environment Setup**

```bash
copy .env.example .env
php artisan key:generate
```

3. **Database Configuration**
   Edit `.env`:

```env
DB_DATABASE=tell2u_db
DB_USERNAME=root
DB_PASSWORD=
APP_TIMEZONE=Asia/Jakarta
```

Create database:

```sql
CREATE DATABASE tell2u_db;
```

4. **Migrate & Seed**

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

5. **Run Development Server**

⚠️ **PENTING:** Anda harus menjalankan **2 terminal** secara bersamaan!

**Terminal 1 - Vite Dev Server (untuk CSS/JS):**

```bash
npm run dev
```

**Terminal 2 - Laravel Server:**

```bash
php artisan serve
```

**ATAU gunakan 1 perintah:**

```bash
npm run serve  # Menjalankan keduanya sekaligus
```

> ⚠️ **Jika CSS hilang:** Pastikan `npm run dev` berjalan! Tanpa Vite dev server, CSS tidak akan ter-load.

**Untuk Production/Demo:**

```bash
npm run build  # Compile assets sekali
php artisan serve
```

## 🔐 Default Login

**Admin:**

-   Email: `admin@tell2u.com`
-   Password: `Admin123!`

**Mahasiswa:** Register melalui halaman utama

## 📚 Dokumentasi

-   **Setup Guide:** Lihat `SETUP.md` untuk instruksi lengkap
-   **User Guide:** Lihat `user_guide.md` untuk panduan penggunaan

## ✨ Fitur Utama

-   Auto-status schedule management
-   Auto-generate meeting links
-   Time-based access control
-   Cancellation system
-   Auto-complete after 1 hour
-   Role-based authentication (Admin & Mahasiswa)

## ⚙️ Tech Stack

-   Laravel 11
-   MySQL
-   Tailwind CSS
-   Blade Templates

## ⚠️ Important Notes

-   **Timezone:** HARUS `Asia/Jakarta` - jangan diubah!
-   **.env:** Jangan commit `.env` file
-   **Auto-Complete:** Setup cron untuk production

## 📝 License

Educational Project - Web Application Development Course
