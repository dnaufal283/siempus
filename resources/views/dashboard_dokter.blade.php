<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Dokter - SIEMPUS</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --siempus-teal: #14b8a6;
            --siempus-teal-hover: #0d9488;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F4F7FE;
            color: #2B3674;
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--siempus-teal);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            border-radius: 5px;
            margin: 5px 15px;
            padding: 10px 15px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--siempus-teal-hover);
            color: #ffffff;
        }

        .content {
            margin-left: 260px;
            padding: 0;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .text-teal {
            color: var(--siempus-teal);
        }

        .bg-teal {
            background-color: var(--siempus-teal);
            color: white;
        }

        .card-custom {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .table-custom thead th {
            background-color: #F8F9FA;
            color: #A3AED0;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: none;
            padding: 16px;
        }

        .table-custom tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #F4F7FE;
            font-weight: 500;
        }

        .table-custom tbody tr:hover {
            background-color: #F8FAFC;
        }

        .nomor-antrean-badge {
            background-color: #F0FDFA;
            color: #0D9488;
            font-weight: 700;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 10px;
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        /* Styling Modal Khusus Dokter */
        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #E2E8F0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #14b8a6;
            box-shadow: 0 0 0 0.25rem rgba(20, 184, 166, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white"><i class="bi bi-heart-pulse me-2"></i>PANEL DOKTER</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="/dashboard-dokter"><i
                        class="bi bi-display me-2 w-20px text-center"></i> Dashboard Antrean</a>
                <a class="nav-link" href="{{ route('dokter.riwayat') }}"><i
                        class="bi bi-journal-medical me-2 w-20px text-center"></i> Riwayat Pasien</a>
            </nav>
        </div>

        <div class="content">
            <div
                class="bg-white p-3 shadow-sm border-bottom d-flex justify-content-between align-items-center mb-4 sticky-top">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">Panel
                        Dokter</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                            {{ Auth::user()->name ?? 'Dokter' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Dokter Poli</div>
                    </div>
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-light btn-sm rounded-circle border shadow-sm"
                            style="width: 40px; height: 40px;" title="Keluar">
                            <i class="bi bi-power text-danger fw-bold"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="container-fluid px-4 pb-5">
                @php
                    // Ambil pengumuman yang aktif untuk "semua" atau khusus role ini
                    $pengumuman = \App\Models\Pengumuman::where('is_active', true)
                        ->whereIn('target_role', ['semua', Auth::user()->role ?? ''])
                        ->latest()
                        ->first();
                @endphp

                @if ($pengumuman)
                    <div class="alert alert-warning alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4"
                        style="background: #FFFBEB;" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-megaphone-fill fs-3 text-warning me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Pengumuman dari Kepala Puskesmas</h6>
                                <p class="mb-0 small text-muted">{{ $pengumuman->pesan }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close mt-2 me-2" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (session('sukses'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm"
                        role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">Daftar Pasien Menunggu</h3>
                        <p class="text-muted mb-0">Pasien yang telah dipanggil oleh loket pendaftaran.</p>
                    </div>
                    <div class="text-muted bg-white px-3 py-2 rounded-pill shadow-sm border small fw-semibold">
                        <i class="bi bi-calendar3 me-2 text-teal"></i>
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <div class="card-custom overflow-hidden shadow-sm">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0"><i class="bi bi-person-lines-fill text-teal me-2"></i>Antrean Masuk
                            Ruangan</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">No. Urut</th>
                                    <th>Nama Pasien</th>
                                    <th>Status Saat Ini</th>
                                    <th class="text-end pe-4">Tindakan Medis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($antreanPoli as $a)
                                    <tr>
                                        <td class="ps-4">
                                            <span
                                                class="nomor-antrean-badge">{{ sprintf('%03d', $a->nomor_antrean) }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $a->user->name }}</div>
                                            <div class="text-muted small">Masuk: {{ $a->updated_at->format('H:i') }}
                                                WIB
                                            </div>
                                        </td>
                                        <td>
                                            @if ($a->status == 'dipanggil')
                                                <span
                                                    class="badge bg-warning bg-opacity-25 text-warning-emphasis px-3 py-2 rounded-pill border border-warning-subtle">
                                                    <i class="bi bi-door-open me-1"></i> Menunggu Diperiksa
                                                </span>
                                            @elseif($a->status == 'diperiksa')
                                                <span
                                                    class="badge bg-primary bg-opacity-25 text-primary-emphasis px-3 py-2 rounded-pill border border-primary-subtle shadow-sm">
                                                    <i class="bi bi-stethoscope me-1"></i> Sedang Diperiksa
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex gap-2 justify-content-end">
                                                @if ($a->status == 'dipanggil')
                                                    <form action="/update-status-antrean/{{ $a->id }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="diperiksa">
                                                        <button type="submit"
                                                            class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold">
                                                            <i class="bi bi-mic me-1"></i> Panggil Masuk
                                                        </button>
                                                    </form>
                                                @endif

                                                <button type="button"
                                                    class="btn bg-teal text-white btn-sm rounded-pill px-3 fw-semibold shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalPeriksa{{ $a->id }}">
                                                    <i class="bi bi-clipboard2-pulse me-1"></i> Input Diagnosa &
                                                    Resep
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-cup-hot fs-1 d-block mb-3 opacity-50"></i>
                                                <h5>Belum ada pasien yang masuk</h5>
                                                <p class="small">Silakan tunggu loket memanggil pasien ke ruangan
                                                    Anda.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <footer class="mt-4 pb-4 text-center text-muted">
                <p class="small mb-0">&copy; 2026 SIEMPUS - Dikembangkan oleh Kelompok 6 Informatics UIN Bandung.
                </p>
            </footer>
        </div>
    </div>

    @foreach ($antreanPoli as $a)
        <div class="modal fade" id="modalPeriksa{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-journal-medical me-2"></i>Rekam Medis Pasien
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="/simpan-rekam-medis" method="POST">
                        @csrf
                        <input type="hidden" name="antrean_id" value="{{ $a->id }}">
                        <input type="hidden" name="user_id" value="{{ $a->user_id }}">

                        <div class="modal-body p-4 bg-light">
                            <div class="d-flex align-items-center mb-4 p-3 bg-white rounded-3 border shadow-sm">
                                <div class="bg-teal bg-opacity-10 p-3 rounded-circle me-3 text-teal">
                                    <i class="bi bi-person-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $a->user->name }}</h6>
                                    <small class="text-muted">Nomor Antrean:
                                        {{ sprintf('%03d', $a->nomor_antrean) }}</small>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tekanan Darah (mmHg)</label>
                                    <input type="text" name="tensi" class="form-control"
                                        placeholder="Contoh: 120/80">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Suhu Tubuh (°C)</label>
                                    <input type="number" step="0.1" name="suhu" class="form-control"
                                        placeholder="Contoh: 36.5">
                                </div>

                                <div class="col-12 mt-4">
                                    <label class="form-label">Keluhan Utama</label>
                                    <textarea name="keluhan" class="form-control" rows="2" placeholder="Tuliskan keluhan pasien di sini..."
                                        required></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label text-danger fw-bold">Diagnosa Penyakit</label>
                                    <input type="text" name="diagnosa"
                                        class="form-control border-danger border-opacity-50"
                                        placeholder="Masukkan diagnosa akhir..." required>
                                </div>

                                <div class="col-12 mt-4">
                                    <div
                                        class="p-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-3">
                                        <label class="form-label text-dark fw-bold"><i
                                                class="bi bi-capsule text-warning me-2"></i>E-Resep (Untuk
                                            Apotek)</label>
                                        <textarea name="resep_obat" class="form-control mt-2" rows="3"
                                            placeholder="Tuliskan resep obat untuk ditebus di farmasi. Format: Nama Obat - Dosis - Aturan Pakai" required></textarea>
                                        <small class="text-muted mt-2 d-block"><i
                                                class="bi bi-info-circle me-1"></i>Resep ini akan otomatis muncul
                                            di
                                            Dashboard Apoteker.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4 pt-0 bg-light">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-teal text-white rounded-pill px-4 shadow-sm">
                                Simpan & Selesai Diperiksa <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
