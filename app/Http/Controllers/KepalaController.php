<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Obat;
use App\Models\Pengumuman;
use App\Models\Poli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KepalaController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Hitung Statistik Antrean Hari Ini
        $total = Antrean::whereDate('created_at', $today)->count();
        $selesai = Antrean::whereDate('created_at', $today)->where('status', 'selesai')->count();
        $menunggu = $total - $selesai;

        $stats = [
            'total' => $total,
            'selesai' => $selesai,
            'menunggu' => $menunggu,
        ];

        // 2. Ambil 5 Antrean Terbaru (Live Monitor)
        $antreanTerbaru = Antrean::with('user')
            ->whereDate('created_at', $today)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        // 3. Ambil Daftar Pegawai (Selain Pasien)
        $petugasAktif = User::whereIn('role', ['admin', 'dokter', 'apoteker', 'it'])->get();

        // 4. Ambil Peringatan Stok Obat (Yang stoknya <= 10)
        $stokMenipis = Obat::where('stok', '<=', 10)->orderBy('stok', 'asc')->take(5)->get();

        // 5. Ambil data Poli
        $polis = Poli::all();

        // PERBAIKAN: 'polis' sudah ditambahkan ke dalam compact
        return view('dashboard_kepala', compact('stats', 'antreanTerbaru', 'petugasAktif', 'stokMenipis', 'polis'));
    }

    public function kirimBroadcast(Request $request)
    {
        $request->validate([
            'target_role' => 'required',
            'pesan' => 'required',
        ]);

        Pengumuman::where('target_role', $request->target_role)->update(['is_active' => false]);

        Pengumuman::create([
            'target_role' => $request->target_role,
            'pesan' => $request->pesan,
            'is_active' => true,
        ]);

        return back()->with('sukses', 'Pengumuman berhasil di-broadcast ke layar pegawai!');
    }

    // TAMBAHAN: Fungsi untuk menyimpan pengaturan Buka/Tutup Poli
    public function updatePoli(Request $request)
    {
        if ($request->has('poli_id')) {
            foreach ($request->poli_id as $key => $id) {
                $poli = Poli::find($id);
                if ($poli) {
                    $poli->update([
                        'is_active' => isset($request->is_active[$id]) ? true : false,
                        'kuota' => $request->kuota[$key] ?? 0,
                    ]);
                }
            }
        }

        return back()->with('sukses', 'Pengaturan Poli berhasil disimpan dan disinkronkan!');
    }
}
