<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Poli;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntreanController extends Controller
{
    /**
     * Menyimpan data antrean baru dari Pasien
     */
    public function ambilAntrean(Request $request)
    {
        $today = Carbon::today();

        // 1. Validasi poli_id dari form
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
        ]);

        // Ambil data poli untuk mendapatkan NAMANYA (Teks)
        $poliData = Poli::find($request->poli_id);

        // 2. Cek apakah pasien sudah ambil antrean hari ini
        $cekAntrean = Antrean::where('user_id', Auth::id())
            ->whereDate('created_at', $today)
            ->first();

        if ($cekAntrean) {
            return back()->with('error', 'Anda sudah mengambil antrean untuk hari ini!');
        }

        // 3. Hitung nomor antrean selanjutnya berdasarkan Nama Poli (Teks)
        $nomorTerakhir = Antrean::where('poli', $poliData->nama_poli)
            ->whereDate('created_at', $today)
            ->max('nomor_antrean');

        $nomorBaru = $nomorTerakhir ? $nomorTerakhir + 1 : 1;

        // 4. Simpan ke database (Gunakan kolom 'poli' sesuai struktur DB kamu)
        Antrean::create([
            'user_id' => Auth::id(),
            'poli' => $poliData->nama_poli,
            'nomor_antrean' => $nomorBaru,
            'tanggal_periksa' => $today,
            'status' => 'menunggu',
        ]);

        return back()->with('sukses', 'Nomor antrean berhasil diambil! Nomor Anda: '.$nomorBaru);
    }

    /**
     * Memperbarui status antrean (Admin/Loket/Dokter)
     */
    public function updateStatus(Request $request, $id)
    {
        $antrean = Antrean::find($id);

        if ($antrean) {
            $antrean->status = $request->status;
            $antrean->save();

            return back()->with('sukses', 'Status antrean berhasil diperbarui!');
        }

        return back()->with('error', 'Data antrean tidak ditemukan.');
    }

    /**
     * Dashboard Admin IT / Loket
     */
    public function dashboardAdmin()
    {
        // REVISI: Hapus 'poli' dari with()
        $semuaAntrean = Antrean::with(['user'])
            ->whereDate('created_at', Carbon::today())
            ->orderBy('nomor_antrean', 'asc')
            ->get();

        return view('dashboard_admin', compact('semuaAntrean'));
    }

    /**
     * Mencetak laporan PDF untuk Kepala Puskesmas
     */
    public function cetakLaporan()
    {
        $hariIni = Carbon::today();

        $data = [
            'title' => 'Laporan Harian SIEMPUS',
            'date' => $hariIni->translatedFormat('d F Y'),
            // REVISI: Hapus 'poli' dari with() agar tidak RelationNotFoundException
            'antrean' => Antrean::with(['user'])
                ->whereDate('created_at', $hariIni)
                ->get(),
            'total' => Antrean::whereDate('created_at', $hariIni)->count(),
            'selesai' => Antrean::whereDate('created_at', $hariIni)->where('status', 'selesai')->count(),
        ];

        $pdf = Pdf::loadView('laporan_pdf', $data);

        return $pdf->download('laporan-siempus-'.date('Y-m-d').'.pdf');
    }

    /**
     * Cetak Struk Antrean
     */
    public function cetakStruk($id)
    {
        // REVISI: Hapus 'poli' dari with()
        $antrean = Antrean::with(['user'])->findOrFail($id);

        return view('admin.struk', compact('antrean'));
    }

    /**
     * Halaman Laporan Filterable
     */
    public function laporan(Request $request)
    {
        // REVISI: Hapus 'poli' dari with()
        $query = Antrean::with(['user']);

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_awal.' 00:00:00', $request->tanggal_akhir.' 23:59:59']);
        } else {
            $query->whereDate('created_at', Carbon::today());
        }

        // REVISI: Sesuaikan filter dengan nama kolom 'poli'
        if ($request->filled('poli')) {
            $query->where('poli', $request->poli);
        }

        $laporan = $query->orderBy('created_at', 'asc')->get();
        $total = $laporan->count();
        $selesai = $laporan->where('status', 'selesai')->count();
        $batal_menunggu = $total - $selesai;

        return view('admin.laporan', compact('laporan', 'total', 'selesai', 'batal_menunggu'));
    }
}
