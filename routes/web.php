<?php

use App\Http\Controllers\AdminITController;
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ResetSandiController;
use Illuminate\Support\Facades\Route;

// --- 0. RUTE PUBLIK ---
Route::get('/', function () {
    return view('welcome');
});

// --- 1. GUEST ROUTES (Belum Login) ---
Route::middleware('guest')->group(function () {
    Route::get('/daftar', function () {
        return view('daftar');
    });
    Route::post('/simpan-daftar', [AuthController::class, 'simpanDaftar']);

    Route::get('/login-pasien', function () {
        return view('login_pasien');
    })->name('login');
    Route::get('/login', function () {
        return view('login');
    });
    Route::post('/proses-login', [AuthController::class, 'prosesLogin']);

    // Reset Password
    Route::get('/lupa-password', [ResetSandiController::class, 'formNik']);
    Route::post('/lupa-password/kirim-otp', [ResetSandiController::class, 'kirimOtp']);
    Route::get('/verifikasi-otp', [ResetSandiController::class, 'formOtp']);
    Route::post('/verifikasi-otp/cek', [ResetSandiController::class, 'cekOtp']);
    Route::get('/reset-password', [ResetSandiController::class, 'formSandiBaru']);
    Route::post('/reset-password/simpan', [ResetSandiController::class, 'simpanSandiBaru']);
});

// --- 2. AUTH ROUTES (Sudah Login) ---
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // --- Rute PASIEN ---
    // Dashboard & Ambil Antrean
    Route::get('/dashboard-pasien', [PasienController::class, 'index'])->name('pasien.dashboard');
    Route::post('/ambil-antrean', [AntreanController::class, 'ambilAntrean']);

    // Riwayat Medis Pasien
    Route::get('/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');

    // --- Rute ADMIN (Loket) ---
    Route::get('/dashboard-admin', [AntreanController::class, 'dashboardAdmin'])->name('admin.dashboard');
    Route::post('/update-status-antrean/{id}', [AntreanController::class, 'updateStatus']);
    Route::get('/cetak-struk/{id}', [AntreanController::class, 'cetakStruk'])->name('cetak.struk');
    Route::get('/dashboard-admin/laporan', [AntreanController::class, 'laporan'])->name('admin.laporan');

    // Manajemen Pasien oleh Admin (Sekarang ke indexAdmin agar tidak nyasar)
    // Gunakan alamat ini agar seragam dengan tombol di dashboard admin
    Route::get('/dashboard-admin/pasien', [PasienController::class, 'indexAdmin'])->name('admin.pasien.index');
    Route::put('/dashboard-admin/pasien/{id}', [PasienController::class, 'update']);

    // --- Rute DOKTER ---
    Route::get('/dashboard-dokter', [RekamMedisController::class, 'dashboardDokter']);
    Route::post('/simpan-rekam-medis', [RekamMedisController::class, 'simpan']);
    Route::get('/dashboard-dokter/riwayat', [RekamMedisController::class, 'riwayat'])->name('dokter.riwayat');

    // --- Rute APOTEKER ---
    Route::get('/dashboard-apoteker', [ApotekerController::class, 'index']);
    Route::post('/serahkan-obat/{id}', [ApotekerController::class, 'serahkanObat']);
    Route::get('/dashboard-apoteker/stok', [ApotekerController::class, 'stokObat']);
    Route::get('/dashboard-apoteker/riwayat', [ApotekerController::class, 'riwayatObat']);
    Route::post('/dashboard-apoteker/stok/tambah', [ApotekerController::class, 'tambahObat']);
    Route::post('/dashboard-apoteker/stok/update/{id}', [ApotekerController::class, 'updateObat']);
    Route::get('/dashboard-apoteker/stok/hapus/{id}', [ApotekerController::class, 'hapusObat']);

    // --- Rute KEPALA PUSKESMAS ---
    Route::get('/dashboard-kepala', [KepalaController::class, 'index']);
    Route::post('/dashboard-kepala/broadcast', [KepalaController::class, 'kirimBroadcast']);
    Route::post('/dashboard-kepala/pengaturan-poli', [KepalaController::class, 'updatePoli']);
    Route::get('/cetak-laporan', [AntreanController::class, 'cetakLaporan']);

    // --- Rute PENGATURAN UMUM ---
    Route::get('/pengaturan', [PengaturanController::class, 'index']);
    Route::post('/pengaturan/update-profil', [PengaturanController::class, 'updateProfil']);
    Route::post('/pengaturan/update-password', [PengaturanController::class, 'updatePassword']);

    // --- Rute ADMIN IT ---
    Route::middleware('roleIT')->group(function () {
        Route::get('/dashboard-it', [AdminITController::class, 'index'])->name('it.dashboard');

        // Manajemen User/Pegawai
        Route::get('/dashboard-it/users', [AdminITController::class, 'users'])->name('it.users');
        Route::post('/dashboard-it/users', [AdminITController::class, 'store'])->name('it.users.store');
        Route::put('/dashboard-it/users/{id}', [AdminITController::class, 'update'])->name('it.users.update');
        Route::delete('/dashboard-it/users/{id}', [AdminITController::class, 'destroy'])->name('it.users.destroy');

        // Master Poli
        Route::get('/dashboard-it/poli', [AdminITController::class, 'poliIndex'])->name('it.poli');
        Route::post('/dashboard-it/poli', [AdminITController::class, 'poliStore'])->name('it.poli.store');
        Route::put('/dashboard-it/poli/{id}', [AdminITController::class, 'poliUpdate'])->name('it.poli.update');
        Route::delete('/dashboard-it/poli/{id}', [AdminITController::class, 'poliDestroy'])->name('it.poli.destroy');

        // Master Dokter
        Route::get('/dashboard-it/dokter', [AdminITController::class, 'dokterIndex'])->name('it.dokter');
        Route::post('/dashboard-it/dokter', [AdminITController::class, 'dokterStore'])->name('it.dokter.store');
        Route::put('/dashboard-it/dokter/{id}', [AdminITController::class, 'dokterUpdate'])->name('it.dokter.update');
        Route::delete('/dashboard-it/dokter/{id}', [AdminITController::class, 'dokterDestroy'])->name('it.dokter.destroy');

        // Konfigurasi Sistem
        Route::get('/dashboard-it/config', [AdminITController::class, 'configIndex'])->name('it.config');
        Route::post('/dashboard-it/config', [AdminITController::class, 'configUpdate'])->name('it.config.update');

        // Backup Data
        Route::get('/dashboard-it/backup', [AdminITController::class, 'backupIndex'])->name('it.backup');
        Route::get('/dashboard-it/backup/download', [AdminITController::class, 'backupDownload'])->name('it.backup.download');
    });
});
