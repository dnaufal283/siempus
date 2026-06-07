<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian - SIEMPUS</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --siempus-teal: #14b8a6;
            --siempus-teal-hover: #0d9488;
        }

        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* Pengaturan Sidebar Konsisten */
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

        /* Mode Print - Trik Menyembunyikan Elemen yang Tidak Perlu di Kertas */
        @media print {
            body {
                background-color: #fff;
            }

            .sidebar,
            .topbar,
            .form-filter,
            .btn-cetak {
                display: none !important;
            }

            .content {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 0 !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .card-header {
                border-bottom: 2px solid #000 !important;
                padding: 0 0 15px 0 !important;
                background: #fff !important;
            }

            .badge {
                border: 1px solid #000 !important;
                color: #000 !important;
                background: none !important;
            }

            .kop-surat {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 3px solid #000;
                padding-bottom: 10px;
            }
        }

        .kop-surat {
            display: none;
        }

        /* Sembunyikan kop surat saat di browser */
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar Loket -->
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white"><i class="bi bi-hospital me-2"></i> LOKET PUSKESMAS</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="/dashboard-admin"><i class="bi bi-display me-2 w-20px text-center"></i>
                    Dashboard Antrean</a>
                <a class="nav-link" href="/dashboard-admin/pasien"><i
                        class="bi bi-people-fill me-2 w-20px text-center"></i> Data Pasien Master</a>
                <a class="nav-link active" href="/dashboard-admin/laporan"><i
                        class="bi bi-file-earmark-text me-2 w-20px text-center"></i> Laporan Harian</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Topbar -->
            <div
                class="topbar d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom mb-4">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">Panel
                        Admin Loket</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                            {{ Auth::user()->name ?? 'Admin Loket' }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Puskesmas Baleendah</div>
                    </div>
                </div>
            </div>

            <!-- Kop Surat Khusus Print -->
            <div class="kop-surat">
                <h2 style="margin:0;">PEMERINTAH KABUPATEN BANDUNG</h2>
                <h1 style="margin:0;">PUSKESMAS BALEENDAH</h1>
                <p style="margin:0;">Jl. Raya Baleendah, Kec. Baleendah, Kabupaten Bandung, Jawa Barat</p>
                <h3 style="margin-top: 15px;">LAPORAN REKAPITULASI ANTREAN PASIEN</h3>
                <p>Periode:
                    {{ request('tanggal_awal') ? \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d M Y') : \Carbon\Carbon::now()->translatedFormat('d M Y') }}
                    s.d
                    {{ request('tanggal_akhir') ? \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d M Y') : \Carbon\Carbon::now()->translatedFormat('d M Y') }}
                </p>
            </div>

            <div class="container-fluid px-4 pb-5">

                <!-- Filter Section -->
                <div class="card shadow-sm border-0 rounded-4 mb-4 form-filter">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3"><i class="bi bi-funnel text-secondary me-2"></i> Filter Laporan</h6>
                        <form action="" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control"
                                    value="{{ request('tanggal_awal', date('Y-m-d')) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control"
                                    value="{{ request('tanggal_akhir', date('Y-m-d')) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Poliklinik Tujuan</label>
                                <select name="poli" class="form-select">
                                    <option value="">Semua Poliklinik</option>
                                    <option value="Poli Umum" {{ request('poli') == 'Poli Umum' ? 'selected' : '' }}>
                                        Poli Umum</option>
                                    <option value="Poli Gigi" {{ request('poli') == 'Poli Gigi' ? 'selected' : '' }}>
                                        Poli Gigi</option>
                                    <option value="Poli KIA" {{ request('poli') == 'Poli KIA' ? 'selected' : '' }}>Poli
                                        KIA</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn text-white w-100 fw-medium"
                                    style="background-color: var(--siempus-teal);">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Laporan Section -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div
                        class="card-header bg-white p-4 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">Data Antrean Terdaftar</h5>
                            <span class="badge bg-light text-dark border me-2">Total: {{ $total }}</span>
                            <span
                                class="badge bg-success bg-opacity-10 text-success border border-success-subtle me-2">Selesai:
                                {{ $selesai }}</span>
                            <span
                                class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle">Lainnya:
                                {{ $batal_menunggu }}</span>
                        </div>
                        <button onclick="window.print()" class="btn btn-outline-dark fw-medium btn-cetak">
                            <i class="bi bi-printer me-2"></i> Cetak / PDF
                        </button>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3" width="15%">Waktu Daftar</th>
                                        <th class="py-3" width="15%">No. Antrean</th>
                                        <th class="py-3" width="30%">Nama Pasien</th>
                                        <th class="py-3" width="20%">Poliklinik</th>
                                        <th class="py-3" width="20%">Status Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan as $a)
                                        <tr>
                                            <td class="ps-4 text-muted small">{{ $a->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td><span class="fw-bold">{{ sprintf('%03d', $a->nomor_antrean) }}</span>
                                            </td>
                                            <td class="fw-bold text-dark">{{ $a->user->name }}</td>
                                            <td>{{ $a->poli }}</td>
                                            <td>
                                                @if ($a->status == 'selesai')
                                                    <span
                                                        class="badge bg-success bg-opacity-10 text-success border border-success-subtle">Selesai</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle text-uppercase">{{ $a->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-file-earmark-x fs-1 d-block mb-2 opacity-50"></i>
                                                Tidak ada data antrean pada rentang tanggal tersebut.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
