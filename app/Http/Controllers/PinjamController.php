<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\PinjamDetail;
use App\Models\Buku;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Pinjam::with('pinjamDetails');
        
        // Filter by logged-in user (jika bukan petugas)
        if (session('user_type') != 'petugas') {
            $query->where('kodePeminjam', session('user_id'))
                  ->where('tipePeminjam', session('user_type') == 'dosen' ? 1 : 2)
                  ->where('status', 1); // Hanya pinjaman aktif
        }
        
        if ($search) {
            $query->where('kodePinjam', 'like', "%{$search}%")
                  ->orWhere('kodePeminjam', 'like', "%{$search}%");
        }
        
        $pinjams = $query->paginate(10)->appends(request()->query());
        return view('peminjaman.index', compact('pinjams', 'search'));
    }

    public function create()
    {
        $bukus = Buku::all();
        $mahasiswas = Mahasiswa::select('kodeMhs', 'nama')->get();
        $dosens = Dosen::select('kodeDosen', 'nama')->get();
        return view('peminjaman.create', compact('bukus', 'mahasiswas', 'dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kodePeminjam' => 'required|numeric',
            'tipePeminjam' => 'required|in:1,2',
            'buku_ids' => 'required|array|max:2',
            'buku_ids.*' => 'required|numeric',
        ]);

        // Generate kodePinjam from current datetime
        $kodePinjam = now()->format('YmdHi');

        // Create Pinjam record
        $pinjam = Pinjam::create([
            'kodePinjam' => $kodePinjam,
            'kodePetugas' => session('user_id'),
            'kodePeminjam' => $validated['kodePeminjam'],
            'tipePeminjam' => $validated['tipePeminjam'],
            'tglPinjam' => now(),
            'tglKembali' => now()->addDays(7),
            'status' => 1,
        ]);

        // Create Pinjam Details and decrease stok
        foreach ($validated['buku_ids'] as $bukuId) {
            PinjamDetail::create([
                'kodePinjam' => $kodePinjam,
                'kodeBuku' => $bukuId,
            ]);
            
            // Decrease stok for this book
            $buku = Buku::findOrFail($bukuId);
            $buku->decrement('stok');
        }

        return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil disimpan');
    }

    public function show(string $id)
    {
        $pinjam = Pinjam::with('pinjamDetails')->findOrFail($id);
        return view('peminjaman.show', compact('pinjam'));
    }

    public function edit(string $id)
    {
        $pinjam = Pinjam::findOrFail($id);
        return view('peminjaman.edit', compact('pinjam'));
    }

    public function update(Request $request, string $id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $request->validate([
            'tglKembali' => 'required|date',
            'status' => 'required|in:1,2,3',
        ]);

        $status_baru = $request->input('status');
        $status_lama = $pinjam->status;

        // Validasi transisi status
        $valid_transitions = [
            1 => [2, 3], // Aktif bisa ke Terlambat atau Selesai
            2 => [3],    // Terlambat hanya bisa ke Selesai
            3 => [],     // Selesai tidak bisa diubah
        ];

        if (!in_array($status_baru, $valid_transitions[$status_lama] ?? [])) {
            $status_names = [1 => 'Aktif', 2 => 'Terlambat', 3 => 'Selesai'];
            return redirect()->back()->withErrors([
                'status' => "Tidak bisa mengubah status dari {$status_names[$status_lama]} ke {$status_names[$status_baru]}"
            ])->withInput();
        }

        // If changing to Selesai (3), increase stok for all books
        if ($status_baru == 3 && $status_lama != 3) {
            foreach ($pinjam->pinjamDetails as $detail) {
                $buku = Buku::findOrFail($detail->kodeBuku);
                $buku->increment('stok');
            }
        }

        $pinjam->update($request->only(['tglKembali', 'status']));
        return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pinjam = Pinjam::findOrFail($id);
        
        // Return stok for all books if pinjam is not completed
        if ($pinjam->status != 3) {
            foreach ($pinjam->pinjamDetails as $detail) {
                $buku = Buku::findOrFail($detail->kodeBuku);
                $buku->increment('stok');
            }
        }
        
        PinjamDetail::where('kodePinjam', $id)->delete();
        $pinjam->delete();
        return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}

