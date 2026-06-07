<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Obat;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function index()
    {
        // Ambil pasien yang statusnya menunggu obat
        $antreanObat = Antrean::with(['user', 'rekamMedis'])
            ->where('status', 'menunggu_obat')->get();
        // Ambil daftar obat untuk dipilih di modal
        $semuaObat = Obat::all();

        return view('dashboard_apoteker', compact('antreanObat', 'semuaObat'));
    }

    public function serahkanObat(Request $request, $id)
    {
        // Logika potong stok (mengambil input array obat_id dan jumlah)
        foreach ($request->obat_id as $key => $obat_id) {
            if ($obat_id) {
                $obat = Obat::find($obat_id);
                $obat->decrement('stok', $request->jumlah[$key]);
            }
        }
        // Selesaikan antrean
        Antrean::find($id)->update(['status' => 'selesai']);

        return back()->with('sukses', 'Obat diserahkan, stok berkurang!');
    }

    // Menampilkan halaman Stok Obat
    public function stokObat()
    {
        $semuaObat = Obat::orderBy('nama_obat', 'asc')->get();

        return view('apoteker.stok', compact('semuaObat'));
        // Catatan: Kalau file view kamu nggak di dalam folder 'apoteker', sesuaikan jadi view('namafilekamu') ya.
    }

    // Menyimpan Obat Baru
    public function tambahObat(Request $request)
    {
        // 1. Tampung hasil validasi ke dalam variabel $validatedData
        $validatedData = $request->validate([
            'kode_obat' => 'required|unique:obats',
            'nama_obat' => 'required',
            'kategori' => 'required',
            'stok' => 'required|numeric',
            'satuan' => 'required',
        ]);

        // 2. Simpan hanya data yang sudah tervalidasi (bebas dari _token)
        Obat::create($validatedData);

        return back()->with('sukses', 'Obat baru berhasil ditambahkan ke gudang!');
    }

    // Update / Edit Stok Obat
    public function updateObat(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->update($request->all());

        return back()->with('sukses', 'Data stok obat berhasil diperbarui!');
    }

    // Hapus Obat
    public function hapusObat($id)
    {
        Obat::destroy($id);

        return back()->with('sukses', 'Data obat berhasil dihapus dari sistem!');
    }

    // Menampilkan Riwayat Pemberian Obat
    public function riwayatObat(Request $request)
    {
        // Ambil pasien yang antreannya sudah selesai (sudah ambil obat)
        $query = Antrean::with(['user', 'rekamMedis'])
            ->where('status', 'selesai')
            ->orderBy('updated_at', 'desc');

        // Fitur Pencarian berdasarkan nama pasien
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }

        $riwayat = $query->get();

        return view('apoteker.riwayat', compact('riwayat'));
    }
}
