<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request; // Pastikan model Pasien di-import
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ResetSandiController extends Controller
{
    // 1. Tampilkan form input NIK
    public function formNik()
    {
        return view('auth.lupa_password');
    }

    // 2. Proses pencarian NIK dan kirim OTP via WA
    public function kirimOtp(Request $request)
    {
        $request->validate(['nik' => 'required|numeric']);

        $identifier = trim($request->nik).'@pasien.siempus.com';
        $user = User::where('email', $identifier)->first();

        if (! $user) {
            return back()->with('error', 'NIK tidak terdaftar di sistem kami.');
        }

        // Cari data pasien untuk mengambil no_hp
        $pasien = Pasien::where('user_id', $user->id)->first();

        if (! $pasien || empty($pasien->no_hp)) {
            return back()->with('error', 'Nomor HP/WhatsApp tidak ditemukan untuk NIK ini.');
        }

        // ==========================================
        // 1. BAGIAN OTP: Bikin statis buat testing
        // ==========================================
        // $otp = rand(100000, 999999); // <-- Ini aslinya (dicomment dulu)
        $otp = 123456; // <-- Ini OTP bypass-nya (aktif)

        // Simpan ke Session
        Session::put('reset_nik', $request->nik);
        Session::put('reset_otp', $otp);

        // ==========================================
        // 2. BAGIAN FONNTE: Dicomment semua (Dimatikan)
        // ==========================================
        /*
        $pesan = "*SIEMPUS BALEENDAH*\n\nHalo, ini adalah kode OTP untuk mereset kata sandi Anda:\n\n*{$otp}*\n\n_Kode ini rahasia, jangan berikan kepada siapapun._";

        try {
            Http::withHeaders([
                'Authorization' => 'TOKEN_FONNTE_KAMU_DISINI',
            ])->post('https://api.fonnte.com/send', [
                'target' => $pasien->no_hp,
                'message' => $pesan,
                'countryCode' => '62',
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim WhatsApp. Pastikan koneksi internet stabil.');
        }
        */

        // ==========================================
        // 3. PESAN SUKSES: Diubah biar nampilin angka OTP-nya di layar
        // ==========================================
        return redirect('/verifikasi-otp')->with('sukses', '[MODE TESTING] Berhasil! Masukkan angka OTP ini: 123456');
    }

    // 3. Tampilkan form input OTP
    public function formOtp()
    {
        // Cegah akses langsung jika belum masukin NIK
        if (! Session::has('reset_nik')) {
            return redirect('/lupa-password');
        }

        return view('auth.verifikasi_otp');
    }

    // 4. Cek OTP yang dimasukkan
    public function cekOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        if ($request->otp == Session::get('reset_otp')) {
            Session::put('otp_verified', true);

            return redirect('/reset-password')->with('sukses', 'OTP Valid! Silakan buat sandi baru.');
        }

        return back()->with('error', 'Kode OTP salah. Silakan periksa kembali pesan WhatsApp Anda.');
    }

    // 5. Tampilkan form sandi baru
    public function formSandiBaru()
    {
        if (! Session::has('otp_verified')) {
            return redirect('/lupa-password');
        }

        return view('auth.reset_password');
    }

    // 6. Simpan sandi baru ke database
    public function simpanSandiBaru(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $identifier = Session::get('reset_nik').'@pasien.siempus.com';
        $user = User::where('email', $identifier)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus session agar tidak bisa diakses lagi
        Session::forget(['reset_nik', 'reset_otp', 'otp_verified']);

        return redirect('/login-pasien')->with('sukses', 'Kata sandi berhasil diubah! Silakan masuk dengan sandi baru.');
    }
}
