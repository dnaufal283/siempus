<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fungsi simpan daftar tetap sama
    public function simpanDaftar(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pasiens,nik',
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar di sistem kami.',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->nik.'@pasien.siempus.com',
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        Pasien::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'no_bpjs' => $request->no_bpjs,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        // Arahkan ke pintu masuk pasien
        return redirect('/login-pasien')->with('sukses', 'Pendaftaran berhasil! Silakan Login menggunakan NIK.');
    }

    // Fungsi Login yang sudah digabung dan cerdas
    public function prosesLogin(Request $request)
    {
        // 1. Ambil input dari kotak 'email' di form
        $loginInput = $request->email;

        // 2. Logika Deteksi Otomatis:
        if (is_numeric($loginInput)) {
            $identifier = $loginInput.'@pasien.siempus.com';
        } else {
            $identifier = $loginInput;
        }

        $kredensial = [
            'email' => $identifier,
            'password' => $request->password,
        ];

        // 3. Eksekusi Login
        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            // 4. Pengalihan berdasarkan Role
            switch ($role) {
                case 'admin':
                    return redirect()->intended('/dashboard-admin');
                case 'dokter':
                    return redirect()->intended('/dashboard-dokter');
                case 'apoteker':
                    return redirect()->intended('/dashboard-apoteker');
                case 'kepala':
                    return redirect()->intended('/dashboard-kepala');
                case 'it':
                    return redirect()->intended('/dashboard-it');
                default:
                    return redirect()->intended('/dashboard-pasien');
            }
        }

        // 5. Jika gagal, beri pesan error yang jelas
        return back()->with('error', 'Login gagal! Periksa kembali Email/NIK dan Kata Sandi Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
