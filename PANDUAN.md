# DigiLib - Digital Library System (Laravel 11)

Konversi aplikasi Digital Library dari PHP Native ke Laravel 11 dengan CoreUI Bootstrap Interface.

## 📋 Fitur Utama

### Master Data Management
- 📚 **Buku** - Kelola koleksi buku dengan detail lengkap
- 🏷️ **Kategori** - Organisir buku berdasarkan kategori
- ✍️ **Pengarang** - Kelola data penulis buku
- 🏢 **Penerbit** - Kelola informasi penerbit

### Sistem Peminjaman
- 📤 **Peminjaman Buku** - Proses peminjaman dengan validasi bisnis
- 📋 **Tracking Peminjaman** - Monitor status peminjaman real-time
- 🔄 **Pengembalian** - Proses pengembalian dan perhitungan denda
- 📊 **Laporan** - Generate laporan peminjaman dan denda

### Multi-User System
- 👤 **Admin/Petugas** - Akses penuh ke semua fitur
- 👨‍🏫 **Dosen** - Peminjaman dan riwayat
- 👨‍🎓 **Mahasiswa** - Peminjaman dan riwayat

## 🎯 Aturan Bisnis

- ✅ Maksimal 2 buku per transaksi peminjaman
- ✅ Buku yang sudah dipinjam tidak bisa dipinjam lagi
- ✅ Batas pengembalian: 1 minggu
- ✅ Denda keterlambatan: Rp. 500 per hari

## 🛠️ Requirements

- PHP 8.2+
- Composer
- MySQL 5.7+ atau MariaDB
- Node.js (untuk asset compilation)

## 📦 Installation

### 1. Clone/Extract Project
```bash
cd c:\digilib-laravel
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 4. Update Database Configuration (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digilib
DB_USERNAME=root
DB_PASSWORD=root    # sesuaikan dengan password MySQL Anda
```

### 5. Migrate & Seed Database
```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Assets
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Akses aplikasi di: http://localhost:8000

## 👤 Test Accounts

| User Type | Username | Password |
|-----------|----------|----------|
| Admin     | admin    | admin    |
| Dosen     | dosen    | dosen    |
| Mahasiswa | deny     | deny     |

## 📁 Project Structure

```
digilib-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Business logic
│   │   ├── Middleware/       # Authentication & roles
│   ├── Models/               # Database models
├── database/
│   ├── migrations/           # Database schema
│   ├── seeders/              # Initial data
├── resources/
│   ├── views/
│   │   ├── auth/             # Login page
│   │   ├── layouts/          # Main layout
│   │   ├── dashboard/        # Dashboard
│   │   ├── master/           # Master data CRUD
│   │   ├── peminjaman/       # Loan management
├── routes/
│   ├── web.php               # Web routes
├── public/                   # Public assets
└── storage/                  # File storage
```

## 🎨 Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5
- **UI Components**: CoreUI Bootstrap Theme
- **Database**: MySQL/MariaDB
- **Authentication**: Session-based custom auth
- **ORM**: Eloquent

## 🔐 Authentication System

Sistem autentikasi menggunakan session-based authentication dengan support untuk 3 user types:

```php
// Middleware untuk proteksi route
Route::middleware('auth.custom')->group(function() {
    // Routes yang memerlukan login
    Route::middleware('role:petugas')->group(function() {
        // Hanya untuk admin/petugas
    });
});
```

## 📚 API Endpoints

### Authentication
- `POST /login` - Login user
- `POST /logout` - Logout user

### Dashboard
- `GET /dashboard` - Dashboard utama

### Master Data (Admin Only)
- `GET /kategori` - List kategori
- `POST /kategori` - Create kategori
- `GET /kategori/{id}/edit` - Edit form
- `PUT /kategori/{id}` - Update kategori
- `DELETE /kategori/{id}` - Delete kategori

- `GET /pengarang` - List pengarang
- `POST /pengarang` - Create pengarang
- `GET /pengarang/{id}/edit` - Edit form
- `PUT /pengarang/{id}` - Update pengarang
- `DELETE /pengarang/{id}` - Delete pengarang

- `GET /penerbit` - List penerbit
- `POST /penerbit` - Create penerbit
- `GET /penerbit/{id}/edit` - Edit form
- `PUT /penerbit/{id}` - Update penerbit
- `DELETE /penerbit/{id}` - Delete penerbit

- `GET /buku` - List buku
- `POST /buku` - Create buku
- `GET /buku/{id}` - View detail buku
- `GET /buku/{id}/edit` - Edit form
- `PUT /buku/{id}` - Update buku
- `DELETE /buku/{id}` - Delete buku

### Loan Management (Admin Only)
- `GET /pinjam` - List peminjaman
- `POST /pinjam` - Create peminjaman
- `GET /pinjam/{id}` - View detail
- `GET /pinjam/{id}/edit` - Edit form
- `PUT /pinjam/{id}` - Update peminjaman
- `DELETE /pinjam/{id}` - Delete peminjaman

### Reports (Admin Only)
- `GET /laporan/peminjaman` - Laporan peminjaman
- `GET /laporan/denda` - Laporan denda
- `GET /laporan/buku` - Laporan buku

## 🚀 Deployment

### Production Setup
```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Run optimization commands
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
```

### Using Artisan Server (Development)
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### Using Web Server (Production)
Configure your web server (Apache/Nginx) to point to the `public` directory.

## 🐛 Troubleshooting

### Database Connection Error
- Pastikan MySQL/MariaDB sudah running
- Verifikasi kredensial database di `.env`
- Pastikan database `digilib` sudah dibuat

### Migration Error
```bash
# Reset database
php artisan migrate:reset

# Re-run migrations
php artisan migrate --seed
```

### Permission Error
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap
```

## 📝 Development Notes

### Database Model Relationships
```php
// Buku -> Kategori (Many to One)
$buku->kategori;

// Buku -> Pengarang (Many to One)
$buku->pengarang;

// Buku -> Penerbit (Many to One)
$buku->penerbit;

// Pinjam -> PinjamDetail (One to Many)
$pinjam->pinjamDetails;

// PinjamDetail -> Buku (Many to One)
$pinjamDetail->buku;
```

### Custom Authentication
Authentication menggunakan session untuk menyimpan:
- `user_id` - ID user (dari tabel yang sesuai)
- `user_type` - Tipe user (petugas, dosen, mahasiswa)
- `user_name` - Nama user

```php
// Check if user is logged in
if(session('user_id')) {
    // User sudah login
}

// Get current user type
$userType = session('user_type'); // petugas, dosen, atau mahasiswa
```

## 📞 Support

Untuk bantuan lebih lanjut, silakan periksa:
- Laravel Documentation: https://laravel.com/docs
- Bootstrap Documentation: https://getbootstrap.com/docs

## 📄 License

Aplikasi ini merupakan konversi dari aplikasi Digital Library original ke Laravel 11.
