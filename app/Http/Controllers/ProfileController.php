<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Petugas;

class ProfileController extends Controller
{
    private function getUserModel()
    {
        $userType = session('user_type');
        $userId = session('user_id');

        if ($userType === 'dosen') {
            return Dosen::find($userId);
        } elseif ($userType === 'mahasiswa') {
            return Mahasiswa::find($userId);
        } elseif ($userType === 'petugas') {
            return Petugas::find($userId);
        }

        return null;
    }

    public function show()
    {
        $user = $this->getUserModel();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User tidak ditemukan');
        }

        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = $this->getUserModel();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User tidak ditemukan');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->getUserModel();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User tidak ditemukan');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'nullable|string|max:1000',
            'gambar_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar_profil')) {
            // Delete old file if exists
            if ($user->gambar_profil && file_exists(storage_path('app/public/' . $user->gambar_profil))) {
                unlink(storage_path('app/public/' . $user->gambar_profil));
            }

            $file = $request->file('gambar_profil');
            $filename = time() . '_' . $user->uuid . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $filename, 'public');
            $validated['gambar_profil'] = 'profile/' . $filename;
        }

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile berhasil diperbarui');
    }
}
