<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien - SIEMPUS</title>
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

        /* Sidebar Dokter */
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

        .card-custom {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
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
                <a class="nav-link" href="/dashboard-dokter"><i class="bi bi-display me-2 w-20px text-center"></i>
                    Dashboard Antrean</a>
                <a class="nav-link active" href="{{ route('dokter.riwayat') }}"><i
                        class="bi bi-journal-medical me-2 w-20px text-center"></i> Riwayat Pasien</a>
            </nav>
        </div>

        <div class="content">
            <div
                class="bg-white p-3 shadow-sm border-bottom d-flex justify-content-between align-items-center mb-4 sticky-top">
                <h5 class="mb-0 fw-bold ps-3 text-dark">Data Riwayat Medis Pasien</h5>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Dokter' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Dokter Poli</div>
                    </div>
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-light btn-sm rounded-circle border shadow-sm"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-power text-danger fw-bold"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="container-fluid px-4 pb-5">
                <div class="card-custom overflow-hidden shadow-sm">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <form action="" method="GET" class="d-flex w-50 gap-2">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control bg-light border-start-0"
                                    placeholder="Cari nama pasien..." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn text-white px-4 fw-medium"
                                style="background-color: var(--siempus-teal); border-radius: 10px;">Cari</button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small fw-semibold text-uppercase">
                                <tr>
                                    <th class="ps-4 py-3">Tanggal Periksa</th>
                                    <th class="py-3">Nama Pasien</th>
                                    <th class="py-3">Diagnosa Utama</th>
                                    <th class="text-end pe-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat as $r)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">
                                                {{ $r->created_at->translatedFormat('d F Y') }}</div>
                                            <div class="text-muted small">{{ $r->created_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $r->user->name }}</div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                                {{ $r->diagnosa }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <button
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium shadow-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDetailRiwayat{{ $r->id }}">
                                                <i class="bi bi-eye me-1"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="bi bi-folder2-open fs-1 d-block mb-3 opacity-50"></i>
                                            Belum ada rekam medis yang dicatat.
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

    @foreach ($riwayat as $r)
        <div class="modal fade" id="modalDetailRiwayat{{ $r->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="border-radius: 20px; border: none;">
                    <div class="modal-header border-0 bg-light" style="border-radius: 20px 20px 0 0;">
                        <h5 class="modal-title fw-bold text-dark"><i class="bi bi-file-medical me-2"
                                style="color: var(--siempus-teal);"></i>Detail Rekam Medis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <p class="text-muted small mb-1">Nama Pasien</p>
                                <h6 class="fw-bold">{{ $r->user->name }}</h6>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <p class="text-muted small mb-1">Waktu Pemeriksaan</p>
                                <h6 class="fw-bold">{{ $r->created_at->translatedFormat('d F Y - H:i') }} WIB</h6>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block mb-1">Tekanan Darah</small>
                                    <span class="fw-bold text-dark">{{ $r->tensi ?? '-' }} mmHg</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block mb-1">Suhu Tubuh</small>
                                    <span class="fw-bold text-dark">{{ $r->suhu ?? '-' }} °C</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold text-dark">Keluhan Utama</h6>
                            <div class="p-3 bg-light rounded-3 border">{{ $r->keluhan }}</div>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold text-danger">Diagnosa</h6>
                            <div
                                class="p-3 bg-danger bg-opacity-10 border border-danger-subtle rounded-3 text-danger fw-medium">
                                {{ $r->diagnosa }}</div>
                        </div>

                        <div class="mb-2">
                            <h6 class="fw-bold text-primary">Resep Obat</h6>
                            <div
                                class="p-3 bg-primary bg-opacity-10 border border-primary-subtle rounded-3 text-primary">
                                {{ $r->resep_obat }}</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light border rounded-pill px-4 w-100 fw-medium"
                            data-bs-dismiss="modal">Tutup Detail</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
