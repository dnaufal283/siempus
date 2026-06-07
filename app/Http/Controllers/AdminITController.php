<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminITController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Utama
        $totalPegawai = User::where('role', '!=', 'pasien')->count();
        $totalPasien = Pasien::count();

        // 2. Cek WA Gateway (Cek apakah Token Fonnte ada di .env)
        // Nanti kamu bisa tambahkan FONNTE_TOKEN=xxx di file .env kamu
        $waStatus = env('FONNTE_TOKEN') ? 'Aktif' : 'Belum Setup';

        // 3. Cek System Load (Kesehatan Database)
        try {
            DB::connection()->getPdo();
            $systemLoad = 'Normal';
        } catch (\Exception $e) {
            $systemLoad = 'Gangguan DB';
        }

        // 4. Log Aktivitas (Sementara kita buat array dinamis)
        // Ke depannya kita bisa buatkan tabel 'activity_logs' di database
        $logs = [
            [
                'waktu' => now()->format('H:i'),
                'user' => Auth::user()->name,
                'aksi' => 'Akses Dashboard IT',
                'status' => 'Success',
            ],
        ];

        return view('dashboardit', compact('totalPegawai', 'totalPasien', 'waStatus', 'systemLoad', 'logs'));
    }

    public function users()
    {
        // Ambil semua data user kecuali pasien (karena pasien punya dashboard sendiri)
        $users = User::where('role', '!=', 'pasien')->orderBy('created_at', 'desc')->get();

        return view('admin_it.users', compact('users'));
    }

    // Fungsi untuk menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Pegawai baru berhasil ditambahkan!');
    }

    // Fungsi untuk update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan email unik, KECUALI untuk email user ini sendiri
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Cek kalau admin IT mau reset password sekalian (kalau dikosongkan, password tidak berubah)
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // Fungsi untuk menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah Admin IT menghapus dirinya sendiri
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', 'Akun pegawai berhasil dihapus!');
    }

    // --- FITUR MASTER POLI ---
    public function poliIndex()
    {
        $polis = Poli::orderBy('created_at', 'desc')->get();

        return view('admin_it.poli', compact('polis'));
    }

    public function poliStore(Request $request)
    {
        $request->validate(['nama_poli' => 'required|string|max:255']);
        Poli::create($request->all());

        return back()->with('success', 'Data Poli berhasil ditambahkan!');
    }

    public function poliUpdate(Request $request, $id)
    {
        $request->validate(['nama_poli' => 'required|string|max:255']);
        Poli::findOrFail($id)->update($request->all());

        return back()->with('success', 'Data Poli berhasil diperbarui!');
    }

    public function poliDestroy($id)
    {
        Poli::findOrFail($id)->delete();

        return back()->with('success', 'Data Poli berhasil dihapus!');
    }

    // --- FITUR MASTER DOKTER ---
    public function dokterIndex()
    {
        // Ambil data dokter beserta nama polinya
        $dokters = Dokter::with('poli')->orderBy('created_at', 'desc')->get();
        // Ambil semua data poli untuk dropdown di form
        $polis = Poli::all();

        return view('admin_it.dokter', compact('dokters', 'polis'));
    }

    public function dokterStore(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'poli_id' => 'required|exists:polis,id',
            'no_telp' => 'nullable|string|max:20',
        ]);
        Dokter::create($request->all());

        return back()->with('success', 'Data Dokter berhasil ditambahkan!');
    }

    public function dokterUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'poli_id' => 'required|exists:polis,id',
            'no_telp' => 'nullable|string|max:20',
        ]);
        Dokter::findOrFail($id)->update($request->all());

        return back()->with('success', 'Data Dokter berhasil diperbarui!');
    }

    public function dokterDestroy($id)
    {
        Dokter::findOrFail($id)->delete();

        return back()->with('success', 'Data Dokter berhasil dihapus!');
    }

    public function configIndex()
    {
        // Ambil semua setting dan ubah jadi key => value agar gampang dipanggil di blade
        $settings = Setting::pluck('value', 'key');

        return view('admin_it.config', compact('settings'));
    }

    public function configUpdate(Request $request)
    {
        $data = $request->except('_token'); // Ambil semua input kecuali token csrf

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Konfigurasi sistem berhasil diperbarui!');
    }

    public function backupIndex()
    {
        return view('admin_it.backup');
    }

    public function backupDownload()
    {
        // Ambil kredensial database dari .env
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        // Buat nama file yang unik berdasarkan waktu
        $fileName = 'backup_siempus_'.date('Y-m-d_H-i-s').'.sql';
        $path = storage_path('app/public/'.$fileName);

        // Eksekusi perintah mysqldump (Bawaan MySQL)
        // Catatan: Jika di Windows/XAMPP error, pastikan path mysql/bin sudah masuk ke Environment Variables Windows.
        $command = "mysqldump --user={$username} --password={$password} {$database} > {$path}";

        if (empty($password)) {
            $command = "mysqldump --user={$username} {$database} > {$path}";
        }

        exec($command);

        // Langsung download filenya dan hapus dari server agar tidak menuh-menuhin storage
        return response()->download($path)->deleteFileAfterSend(true);
    }
}
