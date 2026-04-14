<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PetugasController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth.custom')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Debug Denda
    Route::get('/debug-denda', function() {
        return view('debug-denda');
    })->name('debug.denda');

    // Katalog Buku - Public read-only untuk semua user
    Route::get('/katalog', [BukuController::class, 'katalog'])->name('katalog.index');

    // Master Data Routes (Admin Only - Petugas)
    Route::middleware('auth.custom')->group(function () {
        // Kategori
        Route::resource('kategori', KategoriController::class);

        // Pengarang
        Route::resource('pengarang', PengarangController::class);

        // Penerbit
        Route::resource('penerbit', PenerbitController::class);

        // Buku
        Route::resource('buku', BukuController::class);

        // User Management
        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('petugas', PetugasController::class);

        // Peminjaman (Petugas Only - Create)
        Route::middleware('role:petugas')->group(function () {
            Route::get('pinjam/create', [PinjamController::class, 'create'])->name('pinjam.create');
            Route::post('pinjam', [PinjamController::class, 'store'])->name('pinjam.store');
            Route::get('pinjam/{id}/edit', [PinjamController::class, 'edit'])->name('pinjam.edit');
            Route::patch('pinjam/{id}', [PinjamController::class, 'update'])->name('pinjam.update');
            Route::delete('pinjam/{id}', [PinjamController::class, 'destroy'])->name('pinjam.destroy');
            Route::get('pinjam/{id}', [PinjamController::class, 'show'])->name('pinjam.show');
        });

        // Peminjaman Index untuk semua user (filter by session)
        Route::get('pinjam', [PinjamController::class, 'index'])->name('pinjam.index');

        // Laporan
        Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
        Route::get('/laporan/denda', [LaporanController::class, 'denda'])->name('laporan.denda');
        Route::get('/laporan/buku', [LaporanController::class, 'buku'])->name('laporan.buku');
    });

    // Dosen Routes (view riwayat-pinjaman saja)
    Route::middleware(['auth.custom', 'role:dosen'])->group(function () {
        Route::get('dosen/riwayat-pinjaman', [LaporanController::class, 'riwayatDosen'])->name('riwayat.dosen');
    });

    // Mahasiswa Routes (view riwayat-pinjaman saja)
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/riwayat-pinjaman', [LaporanController::class, 'riwayatMahasiswa'])->name('riwayat.mahasiswa');
    });
});

// Redirect root to login
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth.custom');

