<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Dosen::query();
        
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        
        $dosens = $query->paginate(10)->appends(request()->query());
        return view('dosen.index', compact('dosens', 'search'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:dosens',
            'password' => 'required|string|min:6',
            'email' => 'nullable|email',
            'tempatLahir' => 'nullable|string|max:100',
            'tanggalLahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        Dosen::create([
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

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, string $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:dosens,username,' . $id . ',kodeDosen',
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

        $dosen->update($data);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}
