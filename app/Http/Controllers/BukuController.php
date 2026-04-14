<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Pengarang;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Katalog publik - bisa dilihat semua user (read-only)
    public function katalog(Request $request)
    {
        $search = $request->input('search');
        $query = Buku::with(['kategori', 'pengarang', 'penerbit']);
        
        if ($search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('pengarang', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  })
                  ->orWhereHas('penerbit', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }
        
        $bukus = $query->paginate(10)->appends(request()->query());
        return view('buku.katalog', compact('bukus', 'search'));
    }

    // Index - admin hanya
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Buku::with(['kategori', 'pengarang', 'penerbit']);
        
        if ($search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('pengarang', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  })
                  ->orWhereHas('penerbit', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }
        
        $bukus = $query->paginate(10)->appends(request()->query());
        return view('buku.index', compact('bukus', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $pengarangs = Pengarang::all();
        $penerbits = Penerbit::all();
        return view('buku.create', compact('kategoris', 'pengarangs', 'penerbits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'kodePenerbit' => 'nullable|numeric',
            'kodePengarang' => 'nullable|numeric',
            'nama_penerbit_baru' => 'nullable|string|max:100',
            'nama_pengarang_baru' => 'nullable|string|max:100',
            'tahun' => 'required|numeric',
            'edisi' => 'required|string|max:20',
            'issn_isbn' => 'nullable|string|max:30',
            'seri' => 'nullable|string|max:10',
            'abstraksi' => 'nullable|string',
            'kodeKategori' => 'required|numeric',
            'stok' => 'required|numeric|min:0',
        ]);

        // Handle pengarang baru
        $kodePengarang = $request->kodePengarang;
        if ($request->nama_pengarang_baru) {
            $pengarang = Pengarang::create(['nama' => $request->nama_pengarang_baru]);
            $kodePengarang = $pengarang->kodePengarang;
        } elseif (!$kodePengarang) {
            return back()->withErrors(['kodePengarang' => 'Pilih pengarang atau ketik nama baru']);
        }

        // Handle penerbit baru
        $kodePenerbit = $request->kodePenerbit;
        if ($request->nama_penerbit_baru) {
            $penerbit = Penerbit::create(['nama' => $request->nama_penerbit_baru]);
            $kodePenerbit = $penerbit->kodePenerbit;
        } elseif (!$kodePenerbit) {
            return back()->withErrors(['kodePenerbit' => 'Pilih penerbit atau ketik nama baru']);
        }

        $data = $request->only(['judul', 'tahun', 'edisi', 'issn_isbn', 'seri', 'abstraksi', 'kodeKategori', 'stok']);
        $data['kodePenerbit'] = $kodePenerbit;
        $data['kodePengarang'] = $kodePengarang;
        $data['tglInput'] = now();
        $data['tglUpdate'] = now();
        $data['lastUpdateBy'] = session('user_id');

        Buku::create($data);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $buku = Buku::with(['kategori', 'pengarang', 'penerbit'])->findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        $pengarangs = Pengarang::all();
        $penerbits = Penerbit::all();
        return view('buku.edit', compact('buku', 'kategoris', 'pengarangs', 'penerbits'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'kodePenerbit' => 'nullable|numeric',
            'kodePengarang' => 'nullable|numeric',
            'nama_penerbit_baru' => 'nullable|string|max:100',
            'nama_pengarang_baru' => 'nullable|string|max:100',
            'tahun' => 'required|numeric',
            'edisi' => 'required|string|max:20',
            'issn_isbn' => 'nullable|string|max:30',
            'seri' => 'nullable|string|max:10',
            'abstraksi' => 'nullable|string',
            'kodeKategori' => 'required|numeric',
            'stok' => 'required|numeric|min:0',
        ]);

        $buku = Buku::findOrFail($id);

        // Handle pengarang baru
        $kodePengarang = $request->kodePengarang;
        if ($request->nama_pengarang_baru) {
            $pengarang = Pengarang::create(['nama' => $request->nama_pengarang_baru]);
            $kodePengarang = $pengarang->kodePengarang;
        } elseif (!$kodePengarang) {
            return back()->withErrors(['kodePengarang' => 'Pilih pengarang atau ketik nama baru']);
        }

        // Handle penerbit baru
        $kodePenerbit = $request->kodePenerbit;
        if ($request->nama_penerbit_baru) {
            $penerbit = Penerbit::create(['nama' => $request->nama_penerbit_baru]);
            $kodePenerbit = $penerbit->kodePenerbit;
        } elseif (!$kodePenerbit) {
            return back()->withErrors(['kodePenerbit' => 'Pilih penerbit atau ketik nama baru']);
        }

        $data = $request->only(['judul', 'tahun', 'edisi', 'issn_isbn', 'seri', 'abstraksi', 'kodeKategori', 'stok']);
        $data['kodePenerbit'] = $kodePenerbit;
        $data['kodePengarang'] = $kodePengarang;
        $data['tglUpdate'] = now();
        $data['lastUpdateBy'] = session('user_id');

        $buku->update($data);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
