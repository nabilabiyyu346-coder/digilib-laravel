<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Penerbit::query();
        
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
        }
        
        $penerbits = $query->paginate(10)->appends(request()->query());
        return view('master.penerbit.index', compact('penerbits', 'search'));
    }

    public function create()
    {
        return view('master.penerbit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telp' => 'required|string|max:18',
            'email' => 'required|email|max:50',
        ]);

        Penerbit::create($request->only(['nama', 'alamat', 'telp', 'email']));
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('master.penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telp' => 'required|string|max:18',
            'email' => 'required|email|max:50',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->only(['nama', 'alamat', 'telp', 'email']));
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus');
    }
}
