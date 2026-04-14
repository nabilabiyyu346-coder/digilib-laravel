# 🚀 Quick Start Guide - DigiLib Laravel

## Langkah Cepat Setup (5 Menit)

### 1. Navigate ke Folder Project
```bash
cd c:\digilib-laravel
```

### 2. Install & Setup (Pertama Kali)
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Generate app key
php artisan key:generate

# Build assets
npm run build
```

### 3. Database Configuration
Edit file `.env` dan sesuaikan database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digilib
DB_USERNAME=root
DB_PASSWORD=root  # Sesuaikan dengan password MySQL Anda
```

### 4. Setup Database
```bash
# Run migrations untuk membuat tables
php artisan migrate

# Seed data master dari database original
php artisan db:seed
```

### 5. Start Development Server
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Buka browser: http://localhost:8000

---

## 🔐 Login dengan Test Accounts

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | admin |
| Dosen | dosen | dosen |
| Mahasiswa | deny | deny |

---

## 📁 File Structure Overview

```
c:\digilib-laravel/
├── app/Http/Controllers/        ← Business logic (8 controllers)
├── app/Models/                  ← Database models (9 models)
├── database/migrations/         ← Database schema (9 migrations)
├── database/seeders/            ← Initial data
├── resources/views/             ← Blade templates
│   ├── auth/login.blade.php
│   ├── layouts/app.blade.php
│   ├── dashboard.blade.php
│   └── master/kategori/
├── routes/web.php               ← All routes configured
├── bootstrap/app.php            ← Middleware registration
└── PANDUAN.md                   ← Full documentation
```

---

## ✅ Features Ready to Use

### ✓ Authentication
- [x] Multi-role login (Petugas, Dosen, Mahasiswa)
- [x] Session-based authentication
- [x] Role-based access control
- [x] Logout functionality

### ✓ Dashboard
- [x] Statistics (Total books, active loans)
- [x] Recent loans list
- [x] User information

### ✓ Master Data Management
- [x] Kategori CRUD (Fully implemented)
- [x] Pengarang CRUD (Controller ready, views needed)
- [x] Penerbit CRUD (Controller ready, views needed)
- [x] Buku CRUD (Controller ready, views needed)

### ✓ Loan Management
- [x] Peminjaman CRUD (Controller ready, views needed)
- [x] Business logic validation

### ✓ Reports
- [x] Report controllers ready
- [x] Report routes configured

---

## 🛠️ Common Developer Tasks

### Add New Master Data View
Copy template dari `resources/views/master/kategori/` dan modifikasi untuk data baru:

```bash
# Copy existing kategori views to pengarang
cp resources/views/master/kategori/index.blade.php resources/views/master/pengarang/index.blade.php
```

Edit file untuk menyesuaikan:
- Ubah `$kategoris` menjadi `$pengarangs`
- Ubah form labels dan field names
- Ubah route names ke pengarang

### Test Database Queries
```bash
php artisan tinker

# Test di dalam tinker shell:
> Buku::with('kategori', 'pengarang')->first()
> Kategori::all()
> Pinjam::where('status', 1)->get()
```

### Clear Cache & Rebuild
```bash
php artisan cache:clear
php artisan config:cache
php artisan route:cache
npm run build
```

### Reset Database
```bash
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

---

## 📚 Project Documentation

Baca dokumentasi lengkap untuk info lebih detail:

1. **PANDUAN.md** - Installation & deployment guide
2. **CONVERSION_SUMMARY.md** - Project overview & status
3. **DEVELOPMENT_GUIDE.md** - Development checklist & next steps
4. **CODE_EXAMPLES.md** - Code examples & reference

---

## ⚠️ Important Notes

1. **MySQL Required**: Pastikan MySQL/MariaDB sudah running di port 3306
2. **PHP Version**: Gunakan PHP 8.2 atau lebih tinggi
3. **Composer**: Update composer jika ada issue
4. **Assets**: Jalankan `npm run build` setelah setup
5. **Session Database**: App menggunakan database untuk session storage

---

## 🆘 Troubleshooting

### Error: "SQLSTATE[HY000] [1045]"
**Cause**: Database connection failed
**Solution**: 
- Pastikan MySQL running
- Verifikasi credentials di .env
- Test database connection

### Error: "No such file or directory" (views)
**Cause**: View file tidak ada
**Solution**: 
- Views masih perlu dikerjakan
- Template kategori sudah siap untuk dikopy
- Ikuti DEVELOPMENT_GUIDE.md untuk checklist

### Error: "Class not found"
**Cause**: Composer dependencies belum ter-install
**Solution**:
```bash
composer install
php artisan cache:clear
```

### Port 8000 sudah digunakan
**Solution**:
```bash
php artisan serve --port=8001  # Gunakan port berbeda
```

---

## 🎯 Next Development Steps

1. **Immediate** (30 min):
   - Buat Pengarang CRUD views (copy dari Kategori)
   - Buat Penerbit CRUD views
   - Test semua admin master data

2. **Short-term** (2-3 jam):
   - Buat Buku management views
   - Implement file upload untuk gambar
   - Buat Peminjaman form & list

3. **Medium-term** (1-2 hari):
   - Buat Report views
   - Implement search & filter
   - Add validation & error handling

4. **Polish** (1-2 hari):
   - Test semua fitur
   - Fix bugs
   - Optimize performance

---

## 📞 Contact & Support

**Documentation**: Baca PANDUAN.md untuk info lengkap

**Framework Docs**:
- Laravel: https://laravel.com/docs/11.x
- Bootstrap: https://getbootstrap.com/docs
- Blade: https://laravel.com/docs/11.x/blade

---

## ✨ Project Highlights

✅ **Modern Stack**: Laravel 11 + Bootstrap 5  
✅ **Complete Setup**: All models, migrations, controllers ready  
✅ **Multi-Role**: Support 3 user types dengan authorization  
✅ **Business Logic**: Implementing loan management rules  
✅ **Responsive UI**: Mobile-friendly interface  
✅ **Developer Friendly**: Clean code structure & documentation  

---

**Ready to Start Development!** 🎉

Buka `http://localhost:8000` dan login dengan test account untuk explore aplikasi.
