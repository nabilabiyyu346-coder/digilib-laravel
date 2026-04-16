<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $userType = session('user_type');
        $userName = session('user_name');
        $userId = session('user_id');

        // Filter data berdasarkan user type
        if ($userType === 'petugas') {
            // Petugas (Admin) - lihat semua peminjaman
            $totalPeminjaman = Pinjam::count();
            $peminjamanAktif = Pinjam::where('status', 1)->count();
            $recentPinjams = Pinjam::with('pinjamDetails')->orderBy('tglPinjam', 'desc')->limit(5)->get();
        } elseif ($userType === 'dosen') {
            // Dosen - lihat hanya peminjaman mereka
            $totalPeminjaman = Pinjam::where('kodePeminjam', $userId)->count();
            $peminjamanAktif = Pinjam::where('kodePeminjam', $userId)->where('status', 1)->count();
            $recentPinjams = Pinjam::with('pinjamDetails')
                                    ->where('kodePeminjam', $userId)
                                    ->orderBy('tglPinjam', 'desc')
                                    ->limit(5)
                                    ->get();
        } else {
            // Mahasiswa - lihat hanya peminjaman mereka
            $totalPeminjaman = Pinjam::where('kodePeminjam', $userId)->count();
            $peminjamanAktif = Pinjam::where('kodePeminjam', $userId)->where('status', 1)->count();
            $recentPinjams = Pinjam::with('pinjamDetails')
                                    ->where('kodePeminjam', $userId)
                                    ->orderBy('tglPinjam', 'desc')
                                    ->limit(5)
                                    ->get();
        }

        return view('dashboard', compact('totalBuku', 'totalPeminjaman', 'peminjamanAktif', 'userType', 'userName', 'recentPinjams'));
    }
}

