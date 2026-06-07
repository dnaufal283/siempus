<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Farmasi - SIEMPUS</title>
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

        /* Sidebar Konsisten */
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

        /* Styling Card Statistik Baru */
        .stat-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 1.5rem;
        }

        /* Dekorasi Lingkaran Abstrak di Widget */
        .stat-card::after {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.03);
            z-index: 0;
        }

        .card-custom {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out;
        }

        .card-custom:hover {
            transform: translateY(-3px);
        }

        .card-resep {
            border: 2px dashed #E2E8F0;
            background: #FFFBEB;
            border-radius: 15px;
            padding: 20px;
            position: relative;
        }

        .card-resep::before {
            content: 'Rx';
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 2.5rem;
            font-weight: 800;
            color: rgba(217, 119, 6, 0.08);
        }

        .nomor-antrean-badge {
            background-color: #F0FDFA;
            color: #0D9488;
            font-weight: 700;
            font-size: 14px;
            padding: 5px 15px;
            border-radius: 8px;
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .status-badge {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 50px;
            background: rgba(245, 158, 11, 0.1);
            color: #D97706;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mt-2 mb-2">
                <i class="bi bi-capsule-pill fs-1 text-white"></i>
                <h5 class="fw-bold mt-2 mb-0 text-white">PANEL<br>FARMASI</h5>
            </div>
            <nav class="nav flex-column mt-3">
                <a class="nav-link active" href="/dashboard-apoteker"><i
                        class="bi bi-clipboard2-pulse me-2 fs-5 align-middle"></i> Dashboard Resep</a>
                <a class="nav-link" href="/dashboard-apoteker/stok"><i
                        class="bi bi-box-seam me-2 fs-5 align-middle"></i> Stok Obat (Gudang)</a>
                <a class="nav-link" href="/dashboard-apoteker/riwayat"><i
                        class="bi bi-journal-check me-2 fs-5 align-middle"></i> Riwayat Pemberian</a>
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
                        Farmasi</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Apoteker' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Apoteker Penanggung Jawab</div>
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
                        <h3 class="fw-bold mb-1 text-dark">Selamat Bertugas, {{ Auth::user()->name ?? 'Apoteker' }}! 👋
                        </h3>
                        <p class="text-muted mb-0">Berikut adalah ringkasan operasional apotek hari ini.</p>
                    </div>
                    <div class="text-muted bg-white px-4 py-2 rounded-pill shadow-sm border small fw-semibold">
                        <i class="bi bi-calendar3 me-2 text-teal"></i>
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card bg-white h-100 p-3">
                            <div class="card-body d-flex align-items-center position-relative z-1">
                                <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div>
                                    <p class="text-muted small fw-bold mb-1 text-uppercase tracking-wider">Menunggu Obat
                                    </p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $antreanObat->count() }} <span
                                            class="fs-6 text-muted fw-normal">Resep</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card bg-white h-100 p-3">
                            <div class="card-body d-flex align-items-center position-relative z-1">
                                <div class="stat-icon bg-teal bg-opacity-10 text-teal me-3">
                                    <i class="bi bi-boxes"></i>
                                </div>
                                <div>
                                    <p class="text-muted small fw-bold mb-1 text-uppercase tracking-wider">Total Jenis
                                        Obat</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $semuaObat->count() }} <span
                                            class="fs-6 text-muted fw-normal">Item Tersedia</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card bg-white h-100 p-3">
                            <div class="card-body d-flex align-items-center position-relative z-1">
                                <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <p class="text-muted small fw-bold mb-1 text-uppercase tracking-wider">Stok Menipis
                                        (< 10)</p>
                                            <h3 class="fw-bold mb-0 text-dark">
                                                {{ $semuaObat->where('stok', '<=', 10)->count() }} <span
                                                    class="fs-6 text-muted fw-normal">Item</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-list-task text-teal me-2"></i>Daftar Tunggu Resep
                        Masuk</h5>
                    @if ($antreanObat->count() > 0)
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm"><i
                                class="bi bi-bell-fill me-1"></i> Ada resep baru!</span>
                    @endif
                </div>

                <div class="row">
                    @forelse ($antreanObat as $a)
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card-custom p-4 h-100 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-teal bg-opacity-10 text-teal p-3 rounded-3 me-3">
                                            <i class="bi bi-person-fill fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1 text-dark">{{ $a->user->name }}</h5>
                                            <span class="nomor-antrean-badge">Antrean
                                                #{{ sprintf('%03d', $a->nomor_antrean) }}</span>
                                            <span class="text-muted small ms-2"><i class="bi bi-clock"></i>
                                                {{ $a->updated_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    <span class="status-badge"><i class="bi bi-hourglass-split me-1"></i> Menunggu
                                        Obat</span>
                                </div>

                                <div class="card-resep mb-4 shadow-sm border-0 flex-grow-1">
                                    <h6 class="fw-bold text-warning-emphasis mb-3"><i
                                            class="bi bi-clipboard2-pulse me-2"></i>INSTRUKSI RESEP DOKTER:</h6>
                                    <div class="bg-white p-3 rounded-3 border border-warning border-opacity-10">
                                        <p class="mb-0 fw-medium text-dark"
                                            style="white-space: pre-line; line-height: 1.6;">
                                            {{ $a->rekamMedis->resep_obat ?? 'Peringatan: Resep belum diisi oleh dokter.' }}
                                        </p>
                                    </div>
                                </div>

                                <button type="button"
                                    class="btn btn-success w-100 text-white shadow-sm fw-bold p-3 mt-auto"
                                    style="border-radius: 12px;" data-bs-toggle="modal"
                                    data-bs-target="#modalObat{{ $a->id }}">
                                    <i class="bi bi-box-seam me-2"></i> Siapkan & Potong Stok Obat
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="modalObat{{ $a->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content" style="border-radius: 20px; border: none;">
                                    <div class="modal-header bg-teal text-white border-0"
                                        style="border-radius: 20px 20px 0 0;">
                                        <h5 class="modal-title fw-bold"><i class="bi bi-capsule me-2"></i>Pilih Obat
                                            untuk {{ $a->user->name }}</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/serahkan-obat/{{ $a->id }}" method="POST">
                                        @csrf
                                        <div class="modal-body p-4 bg-light">
                                            <div class="alert alert-warning border-0 rounded-3 mb-4 shadow-sm">
                                                <i class="bi bi-info-circle-fill me-2"></i><strong>Resep
                                                    Dokter:</strong><br>
                                                <span class="small">{{ $a->rekamMedis->resep_obat }}</span>
                                            </div>
                                            <p class="text-muted small mb-3 fw-bold">SILAKAN INPUT OBAT YANG DISERAHKAN
                                                (Stok akan dipotong otomatis):</p>

                                            @for ($i = 1; $i <= 3; $i++)
                                                <div
                                                    class="row g-2 mb-3 align-items-center bg-white p-3 rounded-3 border shadow-sm">
                                                    <div class="col-md-8 col-sm-12">
                                                        <label class="form-label small text-muted fw-bold">Pilih Obat
                                                            {{ $i }}</label>
                                                        <select name="obat_id[]" class="form-select bg-light">
                                                            <option value="">-- Tidak Ada / Kosong --</option>
                                                            @foreach ($semuaObat as $obat)
                                                                <option value="{{ $obat->id }}">
                                                                    {{ $obat->nama_obat }} (Sisa: {{ $obat->stok }}
                                                                    {{ $obat->satuan }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <label class="form-label small text-muted fw-bold">Jumlah
                                                            Dipotong</label>
                                                        <input type="number" name="jumlah[]"
                                                            class="form-control bg-light" placeholder="0"
                                                            min="1">
                                                    </div>
                                                </div>
                                            @endfor

                                        </div>
                                        <div
                                            class="modal-footer border-0 p-4 pt-0 bg-light d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm"
                                                onclick="return confirm('Obat akan diserahkan dan status pasien selesai. Lanjutkan?')">
                                                Serahkan Obat & Selesai <i class="bi bi-check-lg ms-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-12 mt-2">
                            <div class="card-custom p-5 text-center shadow-sm"
                                style="background: linear-gradient(to bottom, #ffffff, #F8FAFC);">
                                <div class="d-inline-flex align-items-center justify-content-center bg-teal bg-opacity-10 text-teal rounded-circle mb-4"
                                    style="width: 100px; height: 100px;">
                                    <i class="bi bi-clipboard2-check" style="font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-2">Kerjaan Beres! 🎉</h3>
                                <p class="text-muted fs-6 mb-0">Belum ada resep baru dari ruangan dokter saat
                                    ini.<br>Sistem akan memunculkan resep secara otomatis di sini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>

            <footer class="mt-4 pb-4 text-center text-muted">
                <p class="small mb-0 fw-medium">&copy; 2026 SIEMPUS System &bull; Informatics UIN Bandung</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
