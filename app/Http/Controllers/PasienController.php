<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Poli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    /**
     * DASHBOARD PASIEN
     * Menampilkan form pendaftaran & tiket aktif hari ini.
     */
    public function index()
    {
        $polis = Poli::all();

        $antreanAktif = Antrean::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->whereIn('status', ['menunggu', 'proses', 'menunggu_obat', 'dipanggil', 'diperiksa'])
            ->first();

        return view('dashboard_pasien', compact('polis', 'antreanAktif'));
    }

    /**
     * RIWAYAT BEROBAT (Untuk Pasien Sendiri)
     */
    public function riwayat()
    {
        $riwayat = Antrean::with(['rekamMedis']) // Hapus 'poli' dari sini
            ->where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat', compact('riwayat'));
    }

    /**
     * DAFTAR PASIEN (Untuk Dashboard Admin)
     * Agar admin tidak nyasar ke dashboard-pasien.
     */
    public function indexAdmin()
    {
        $pasiens = User::where('role', 'pasien')->get()->map(function ($user) {
            // Jika kolom NIK kosong, coba ambil angka dari email
            if (empty($user->nik)) {
                // Mengambil angka sebelum tanda @ di email
                $user->nik_auto = explode('@', $user->email)[0];
            } else {
                $user->nik_auto = $user->nik;
            }

            return $user;
        });

        return view('admin.pasien', compact('pasiens'));
    }

    /**
     * UPDATE PROFIL PASIEN
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|max:16',
        ]);

        $pasien = User::findOrFail($id);
        $pasien->update([
            'name' => $request->name,
            'nik' => $request->nik,
        ]);

        return back()->with('sukses', 'Data profil berhasil diperbarui!');
    }
}
