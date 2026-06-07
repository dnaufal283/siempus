<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    // Menampilkan halaman pengaturan
    public function index()
    {
        $user = Auth::user();

        return view('pengaturan', compact('user'));
    }

    // Mengubah Nama Profil
    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        // Jika ada kolom lain di database seperti no_hp atau bpjs, tambahkan di sini
        $user->save();

        return back()->with('sukses', 'Profil berhasil diperbarui!');
    }

    // Mengubah Kata Sandi yang aman dengan Hash
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed', // Wajib ada 'password_baru_confirmation' di form
        ]);

        $user = User::find(Auth::id());

        // Cek apakah password lama yang diketik cocok dengan di database
        if (! Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Kata sandi lama yang Anda masukkan salah!');
        }

        // Simpan password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('sukses', 'Kata sandi berhasil diubah! Data Anda aman.');
    }
}
