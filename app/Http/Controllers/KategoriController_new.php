<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('master.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('master.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:50',
        ]);

        Kategori::create($request->only(['namaKategori']));
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('master.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:50',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['namaKategori']));
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
