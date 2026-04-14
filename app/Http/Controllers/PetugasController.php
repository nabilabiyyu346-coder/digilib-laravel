<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Petugas::query();
        
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        
        $petugas_list = $query->paginate(10)->appends(request()->query());
        return view('petugas.index', compact('petugas_list', 'search'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:petugas',
            'password' => 'required|string|min:6',
            'email' => 'nullable|email',
            'tempatLahir' => 'nullable|string|max:100',
            'tanggalLahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'tempatLahir' => $request->tempatLahir,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $request->alamat,
            'dateInput' => now(),
            'dateUpdate' => now(),
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, string $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:petugas,username,' . $id . ',kodePetugas',
            'email' => 'nullable|email',
            'tempatLahir' => 'nullable|string|max:100',
            'tanggalLahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $data['dateUpdate'] = now();

        $petugas->update($data);
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}
