<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Pengarang::query();
        
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
        }
        
        $pengarangs = $query->paginate(10)->appends(request()->query());
        return view('master.pengarang.index', compact('pengarangs', 'search'));
    }

    public function create()
    {
        return view('master.pengarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        Pengarang::create($request->only(['nama']));
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('master.pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $pengarang = Pengarang::findOrFail($id);
        $pengarang->update($request->only(['nama']));
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus');
    }
}
