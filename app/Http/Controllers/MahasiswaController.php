<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Mahasiswa::query();
        
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%");
        }
        
        $mahasiswas = $query->paginate(10)->appends(request()->query());
        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:mahasiswas',
            'password' => 'required|string|min:6',
            'email' => 'nullable|email',
            'jurusan' => 'nullable|string|max:100',
            'tempatLahir' => 'nullable|string|max:100',
            'tanggalLahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        Mahasiswa::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'tempatLahir' => $request->tempatLahir,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $request->alamat,
            'dateInput' => now(),
            'dateUpdate' => now(),
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:mahasiswas,username,' . $id . ',kodeMhs',
            'email' => 'nullable|email',
            'jurusan' => 'nullable|string|max:100',
            'tempatLahir' => 'nullable|string|max:100',
            'tanggalLahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $data['dateUpdate'] = now();

        $mahasiswa->update($data);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
