<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executive Panel - SIEMPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F4F7FE;
            color: #2B3674;
        }

        .text-teal {
            color: #14b8a6;
        }

        .bg-teal {
            background-color: #14b8a6;
            color: white;
        }

        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
            padding: 15px 0;
        }

        .card-custom {
            background: white;
            border: none;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 1.75rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.5);
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .progress {
            height: 10px;
            border-radius: 10px;
            background-color: #E2E8F0;
        }

        .progress-bar {
            background: linear-gradient(90deg, #14b8a6, #0d9488);
        }

        .btn-action {
            background: white;
            border: 1px solid #E2E8F0;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-action:hover {
            background: #F8FAFC;
            border-color: #14b8a6;
            color: #14b8a6;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <span class="text-teal">SIEM</span>PUS <span class="text-muted fs-6 fw-normal ms-2">| Eksekutif</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row mb-5">
            <div class="col-lg-8">
                <h3 class="fw-800 mb-1">Halo, {{ Auth::user()->name }} 👋</h3>
                <p class="text-muted fw-medium">Berikut adalah rangkuman performa puskesmas hari ini.</p>

                <div class="d-flex gap-2 mt-3">
                    <a href="/cetak-laporan" class="btn-action shadow-sm text-decoration-none text-dark">
                        <i class="bi bi-printer text-teal me-2"></i> Cetak Laporan
                    </a>
                    <button class="btn-action shadow-sm" data-bs-toggle="modal" data-bs-target="#modalBroadcast">
                        <i class="bi bi-megaphone text-teal me-2"></i> Broadcast Info
                    </button>
                    <button class="btn-action shadow-sm" data-bs-toggle="modal" data-bs-target="#modalPengaturanPoli">
                        <i class="bi bi-gear text-teal me-2"></i> Pengaturan Poli
                    </button>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card-custom py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="fw-bold text-muted text-uppercase">Efisiensi Pelayanan</small>
                        <small
                            class="fw-bold text-teal fs-5">{{ $stats['total'] > 0 ? round(($stats['selesai'] / $stats['total']) * 100) : 0 }}%</small>
                    </div>
                    <div class="progress mb-2">
                        <div class="progress-bar" role="progressbar"
                            style="width: {{ $stats['total'] > 0 ? ($stats['selesai'] / $stats['total']) * 100 : 0 }}%">
                        </div>
                    </div>
                    <small class="text-muted" style="font-size: 11px;">Target: 100% Pasien Terlayani</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3"><i
                                class="bi bi-people-fill fs-4"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $stats['total'] }}</h2>
                            <small class="text-muted fw-bold text-uppercase">Total Kunjungan</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 me-3"><i
                                class="bi bi-check-circle-fill fs-4"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $stats['selesai'] }}</h2>
                            <small class="text-muted fw-bold text-uppercase">Sudah Selesai</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 me-3"><i
                                class="bi bi-hourglass-split fs-4"></i></div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $stats['menunggu'] }}</h2>
                            <small class="text-muted fw-bold text-uppercase">Masih Menunggu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-custom p-0 overflow-hidden h-100">
                    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Antrean Perlu Pantauan</h5>
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-bold"
                            style="font-size: 10px;">
                            <span class="spinner-grow spinner-grow-sm me-1" style="width: 8px; height: 8px;"></span>
                            LIVE MONITOR
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="border-collapse: separate;">
                            <thead class="bg-light">
                                <tr class="text-muted small fw-bold">
                                    <th class="ps-4 py-3">PASIEN</th>
                                    <th>JAM MASUK</th>
                                    <th class="text-end pe-4">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($antreanTerbaru as $a)
                                    <tr>
                                        <td class="ps-4 fw-bold">{{ $a->user->name }}</td>
                                        <td class="text-muted small">{{ $a->updated_at->format('H:i') }} WIB</td>
                                        <td class="text-end pe-4">
                                            @if ($a->status == 'selesai')
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold"
                                                    style="font-size: 10px;">SELESAI</span>
                                            @elseif($a->status == 'menunggu_obat')
                                                <span
                                                    class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 fw-bold"
                                                    style="font-size: 10px;">MENUNGGU OBAT</span>
                                            @else
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold"
                                                    style="font-size: 10px;">{{ strtoupper($a->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">Belum ada aktivitas hari
                                            ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card-custom mb-4">
                    <h6 class="fw-bold mb-4 border-bottom pb-2">Daftar Pegawai (Shift Hari Ini)</h6>
                    @forelse($petugasAktif as $petugas)
                        <div
                            class="d-flex align-items-center mb-3 p-2 {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                            <div
                                class="bg-{{ $petugas->role == 'dokter' ? 'teal' : ($petugas->role == 'apoteker' ? 'warning' : 'primary') }} bg-opacity-10 text-{{ $petugas->role == 'dokter' ? 'teal' : ($petugas->role == 'apoteker' ? 'warning' : 'primary') }} p-2 rounded-circle me-3">
                                <i
                                    class="bi {{ $petugas->role == 'dokter' ? 'bi-person-badge' : ($petugas->role == 'apoteker' ? 'bi-capsule' : 'bi-pc-display') }}"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold small text-dark">{{ $petugas->name }}</p>
                                <small class="text-muted text-capitalize" style="font-size: 10px;">Unit:
                                    {{ $petugas->role }}</small>
                            </div>
                            <span class="ms-auto badge bg-success p-1 rounded-circle" title="Online"><span
                                    class="visually-hidden">Online</span></span>
                        </div>
                    @empty
                        <div class="text-center text-muted small py-3">Belum ada data pegawai.</div>
                    @endforelse
                </div>

                <div class="card-custom border-danger border-opacity-25">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                        <h6 class="fw-bold mb-0 text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Stok
                            Obat Menipis</h6>
                        <span class="badge bg-danger rounded-pill">{{ $stokMenipis->count() }} Item</span>
                    </div>

                    @forelse($stokMenipis as $obat)
                        <div
                            class="d-flex justify-content-between align-items-center mb-2 pb-2 {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                            <div>
                                <p class="mb-0 fw-bold small text-dark">{{ $obat->nama_obat }}</p>
                                <small class="text-muted" style="font-size: 10px;">{{ $obat->kategori }}</small>
                            </div>
                            <span
                                class="badge bg-danger bg-opacity-10 text-danger fw-bold border border-danger-subtle">
                                Sisa {{ $obat->stok }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-3">
                            <i class="bi bi-check-circle text-success fs-1 opacity-50 mb-2 d-block"></i>
                            <span class="text-muted small fw-medium">Stok obat di gudang aman.</span>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBroadcast" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-megaphone text-teal me-2"></i> Kirim Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="/dashboard-kepala/broadcast" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kirim Kepada:</label>
                            <select name="target_role" class="form-select border-0 bg-light py-2" required>
                                <option value="semua">Semua Staff (Dokter, Apoteker, Admin)</option>
                                <option value="dokter">Hanya Dokter Poli</option>
                                <option value="apoteker">Hanya Unit Farmasi</option>
                                <option value="admin">Hanya Admin Loket</option>
                                <option value="it">Hanya Admin IT</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Pesan Pengumuman:</label>
                            <textarea name="pesan" class="form-control border-0 bg-light" rows="4"
                                placeholder="Ketik pesan penting di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn w-100 rounded-3 fw-bold text-white shadow-sm py-3"
                            style="background-color: #14b8a6;">
                            <i class="bi bi-send-fill me-2"></i> Kirim Broadcast Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPengaturanPoli" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-gear-fill text-teal me-2"></i> Manajemen Unit Layanan (Poli)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="/dashboard-kepala/pengaturan-poli" method="POST">
                        @csrf
                        <div class="table-responsive mb-3">
                            <table class="table align-middle">
                                <thead class="bg-light text-muted small">
                                    <tr>
                                        <th>Nama Unit / Poli</th>
                                        <th>Status Buka/Tutup</th>
                                        <th>Kuota Maksimal / Hari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($polis as $index => $poli)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="poli_id[]" value="{{ $poli->id }}">
                                                <p
                                                    class="mb-0 fw-bold {{ $poli->is_active ? 'text-dark' : 'text-muted' }}">
                                                    {{ $poli->nama_poli }}</p>
                                                @if ($poli->is_active)
                                                    <small class="text-teal fw-bold" style="font-size: 11px;">Aktif
                                                        melayani</small>
                                                @else
                                                    <small class="text-danger fw-bold" style="font-size: 11px;">Sedang
                                                        Tutup</small>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-check form-switch fs-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="is_active[{{ $poli->id }}]" value="1"
                                                        {{ $poli->is_active ? 'checked' : '' }} role="switch">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" name="kuota[]"
                                                    class="form-control form-control-sm w-75 bg-light border-0"
                                                    value="{{ $poli->kuota }}" min="0"
                                                    {{ !$poli->is_active ? 'disabled' : '' }}>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted small">Data Poli
                                                belum ditambahkan di database.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="alert alert-warning border-0 bg-warning bg-opacity-10 text-dark small d-flex align-items-center rounded-3 mb-4">
                            <i class="bi bi-info-circle-fill text-warning me-3 fs-4"></i>
                            <div>
                                <strong>Peringatan Sistem:</strong><br>
                                Menutup Poli akan membuat opsi tersebut hilang dari menu pendaftaran akun Pasien dan
                                Admin Loket.
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 rounded-3 fw-bold text-white shadow-sm py-3"
                            style="background-color: #14b8a6;">
                            <i class="bi bi-floppy-fill me-2"></i> Simpan Peraturan Poli
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
