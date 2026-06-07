<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Farmasi - SIEMPUS</title>
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table-custom thead th {
            background-color: #F8F9FA;
            color: #A3AED0;
            font-weight: 600;
            font-size: 13px;
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
                <a class="nav-link" href="/dashboard-apoteker"><i
                        class="bi bi-clipboard2-pulse me-2 fs-5 align-middle"></i> Dashboard Resep</a>
                <a class="nav-link" href="/dashboard-apoteker/stok"><i
                        class="bi bi-box-seam me-2 fs-5 align-middle"></i> Stok Obat (Gudang)</a>
                <a class="nav-link active" href="/dashboard-apoteker/riwayat"><i
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
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1"
                        style="font-size: 1.05rem;">Riwayat Pemberian Obat</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Apoteker' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Apoteker Penanggung Jawab</div>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-4 pb-5">

                <div class="card-custom overflow-hidden shadow-sm">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-journal-text text-teal me-2"></i>Data
                                Riwayat Pemberian Obat</h5>
                            <p class="text-muted small mb-0">Catatan pasien yang telah selesai menerima obat.</p>
                        </div>
                        <form action="" method="GET" class="d-flex w-25">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control bg-light border-start-0"
                                    placeholder="Cari Pasien..." value="{{ request('search') }}">
                                <button type="submit" class="btn bg-teal text-white">Cari</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4" width="20%">Waktu Diserahkan</th>
                                    <th width="25%">Nama Pasien</th>
                                    <th width="40%">Instruksi Resep Dokter</th>
                                    <th class="text-end pe-4" width="15%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat as $r)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">
                                                {{ $r->updated_at->translatedFormat('d M Y') }}</div>
                                            <div class="text-muted small">{{ $r->updated_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $r->user->name }}</div>
                                            <span class="badge bg-light text-secondary border mt-1">Antrean
                                                #{{ sprintf('%03d', $r->nomor_antrean) }}</span>
                                        </td>
                                        <td>
                                            <div class="p-2 bg-light rounded border border-light-subtle small text-dark"
                                                style="max-height: 80px; overflow-y: auto; white-space: pre-line;">
                                                {{ $r->rekamMedis->resep_obat ?? 'Tidak ada data resep.' }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2 rounded-pill shadow-sm">
                                                <i class="bi bi-check-circle me-1"></i> Selesai
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="bi bi-folder2-open fs-1 d-block mb-3 opacity-25"></i>
                                            Belum ada data riwayat pemberian obat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
