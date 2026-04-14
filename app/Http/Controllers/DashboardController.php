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
        $totalPeminjaman = Pinjam::count();
        $peminjamanAktif = Pinjam::where('status', 1)->count();
        $userType = session('user_type');
        $userName = session('user_name');

        $recentPinjams = Pinjam::with('pinjamDetails')->orderBy('tglPinjam', 'desc')->limit(5)->get();

        return view('dashboard', compact('totalBuku', 'totalPeminjaman', 'peminjamanAktif', 'userType', 'userName', 'recentPinjams'));
    }
}

