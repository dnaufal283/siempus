<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function dashboardDokter()
    {
        // Ambil antrean yang statusnya 'dipanggil' atau 'diperiksa' hari ini
        $antreanPoli = Antrean::with('user')
            ->whereDate('created_at', Carbon::today())
            ->whereIn('status', ['dipanggil', 'diperiksa'])
            ->orderBy('updated_at', 'asc')
            ->get();

        return view('dashboard_dokter', compact('antreanPoli'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'antrean_id' => 'required',
            'user_id' => 'required',
            'keluhan' => 'required',
            'diagnosa' => 'required',
            'resep_obat' => 'required',
        ]);
        // 1. Simpan data ke tabel rekam_medis
        RekamMedis::create([
            'antrean_id' => $request->antrean_id,
            'user_id' => $request->user_id,
            'tensi' => $request->tensi,
            'suhu' => $request->suhu,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'resep_obat' => $request->resep_obat,
        ]);

        // 2. Update status antrean menjadi 'menunggu_obat' agar muncul di layar Apoteker
        $antrean = Antrean::find($request->antrean_id);
        $antrean->update(['status' => 'menunggu_obat']);

        return back()->with('sukses', 'Pemeriksaan selesai! Data telah dikirim ke Apotek.');
    }

    public function riwayat(Request $request)
    {
        // Ambil data rekam medis beserta data pasien (user)
        $query = RekamMedis::with(['user', 'antrean'])->orderBy('created_at', 'desc');

        // Fitur Pencarian berdasarkan nama pasien
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }

        $riwayat = $query->get();

        return view('dokter.riwayat', compact('riwayat'));
    }
}
