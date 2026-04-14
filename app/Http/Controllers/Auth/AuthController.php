<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Check Petugas (Admin)
        $petugas = Petugas::where('username', $username)->first();
        if ($petugas && Hash::check($password, $petugas->password)) {
            Session::put('user_id', $petugas->kodePetugas);
            Session::put('user_type', 'petugas');
            Session::put('user_name', $petugas->nama);
            return redirect()->route('dashboard');
        }

        // Check Dosen
        $dosen = Dosen::where('username', $username)->first();
        if ($dosen && Hash::check($password, $dosen->password)) {
            Session::put('user_id', $dosen->kodeDosen);
            Session::put('user_type', 'dosen');
            Session::put('user_name', $dosen->nama);
            return redirect()->route('dashboard');
        }

        // Check Mahasiswa
        $mahasiswa = Mahasiswa::where('username', $username)->first();
        if ($mahasiswa && Hash::check($password, $mahasiswa->password)) {
            Session::put('user_id', $mahasiswa->kodeMhs);
            Session::put('user_type', 'mahasiswa');
            Session::put('user_name', $mahasiswa->nama);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}

