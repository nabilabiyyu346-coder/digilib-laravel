<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Buku;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function peminjaman(Request $request)
    {
        $search = $request->input('search');
        $query = Pinjam::with('pinjamDetails');
        
        if ($search) {
            $query->where('kodePinjam', 'like', "%{$search}%")
                  ->orWhere('kodePeminjam', 'like', "%{$search}%");
        }
        
        $pinjams = $query->paginate(10)->appends(request()->query());
        return view('laporan.peminjaman', compact('pinjams', 'search'));
    }

    public function denda(Request $request)
    {
        $search = $request->input('search');
        // Cari peminjaman yang terlambat (status = 1 atau 2 dengan tglKembali sudah lewat)
        $query = Pinjam::with('pinjamDetails')
                       ->whereIn('status', [1, 2]);
        
        if ($search) {
            $query->where('kodePinjam', 'like', "%{$search}%")
                  ->orWhere('kodePeminjam', 'like', "%{$search}%");
        }
        
        $pinjams = $query->get();
        
        $daftar_denda = [];
        foreach($pinjams as $pinjam) {
            $tgl_kembali = \Carbon\Carbon::parse($pinjam->tglKembali);
            $denda = 0;
            
            // Cek apakah tglKembali sudah lewat (terlambat)
            if($tgl_kembali < now()) {
                $hari_terlambat = $tgl_kembali->diffInDays(now());
                $denda = $hari_terlambat * 500;
            }
            
            if($denda > 0) {
                $daftar_denda[] = [
                    'kodePinjam' => $pinjam->kodePinjam,
                    'peminjam' => 'Peminjam #' . $pinjam->kodePeminjam,
                    'tglKembali' => $tgl_kembali,
                    'statusPinjam' => $pinjam->status == 2 ? 'Terlambat' : 'Aktif (Terlambat)',
                    'denda' => $denda
                ];
            }
        }
        
        return view('laporan.denda', compact('daftar_denda', 'search'));
    }

    public function buku()
    {
        $bukus = Buku::with(['kategori', 'pengarang', 'penerbit'])->get();
        return view('laporan.buku', compact('bukus'));
    }

    public function riwayatDosen()
    {
        $user_id = session('user_id');
        $pinjams = Pinjam::where('kodePeminjam', $user_id)
                        ->where('tipePeminjam', 1)
                        ->where('status', 3) // Hanya pinjaman yang sudah selesai
                        ->with('pinjamDetails')
                        ->get();
        return view('laporan.riwayat', compact('pinjams'));
    }

    public function riwayatMahasiswa()
    {
        $user_id = session('user_id');
        $pinjams = Pinjam::where('kodePeminjam', $user_id)
                        ->where('tipePeminjam', 2)
                        ->where('status', 3) // Hanya pinjaman yang sudah selesai
                        ->with('pinjamDetails')
                        ->get();
        return view('laporan.riwayat', compact('pinjams'));
    }
}

