<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Medis - SIEMPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
        }

        .text-teal {
            color: #14B8A6 !important;
        }

        .bg-teal {
            background-color: #14B8A6 !important;
            color: white !important;
        }

        .bg-teal-light {
            background-color: rgba(20, 184, 166, 0.1) !important;
        }

        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .history-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border-left: 5px solid #14B8A6;
            transition: all 0.3s ease;
        }

        .history-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.1);
        }

        .date-box {
            background-color: #F1F5F9;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            min-width: 90px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/dashboard-pasien">
                <i class="bi bi-arrow-left me-2 text-dark fs-5"></i>
                <span class="text-teal">SIEM</span>PUS
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-teal fw-bold border border-2 border-white shadow-sm"
                    style="width: 45px; height: 45px;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">Riwayat Medis Anda 📋</h3>
                        <p class="text-muted mb-0">Catatan kunjungan, diagnosa, dan resep obat dari dokter.</p>
                    </div>
                </div>

                <!-- Looping Data Riwayat -->
                @forelse ($riwayat as $item)
                    <div class="card history-card mb-4 bg-white shadow-sm border-0">
                        <div class="card-body p-4">
                            @php
                                // LOGIKA ANTI-ERROR: Mengecek apakah $item itu objek database atau array mentah
                                try {
                                    $rawDate = is_array($item)
                                        ? $item['created_at'] ?? now()
                                        : $item->created_at ?? now();
                                    $tglObj = \Carbon\Carbon::parse($rawDate);
                                } catch (\Exception $e) {
                                    $tglObj = now();
                                }
                            @endphp

                            <div class="d-flex flex-column flex-md-row gap-4 align-items-start">
                                <div class="date-box d-flex flex-column justify-content-center align-items-center bg-light rounded-4 border"
                                    style="min-width: 110px; height: 100px;">
                                    <span class="text-teal fw-bold display-6 lh-1">{{ $tglObj->format('d') }}</span>
                                    <span
                                        class="text-muted small fw-bold text-uppercase">{{ $tglObj->translatedFormat('M Y') }}</span>
                                </div>

                                <div class="flex-grow-1 w-100">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="fw-bold mb-0 text-dark">
                                            {{ is_array($item) ? $item['poli'] ?? 'Poli Umum' : $item->poli->nama_poli ?? 'Poli Umum' }}
                                        </h5>
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                        </span>
                                    </div>

                                    <div class="bg-light p-3 rounded-3 mb-3 border-start border-4 border-teal">
                                        <div class="mb-2">
                                            <span class="fw-semibold text-dark d-block small mb-1">Keluhan:</span>
                                            <span class="text-muted small">
                                                {{ $item->rekamMedis->keluhan ?? 'Catatan tidak ditemukan' }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark d-block small mb-1">Diagnosa &
                                                Resep:</span>
                                            <span class="text-danger fw-medium small">
                                                <i class="bi bi-clipboard-pulse me-1"></i>
                                                {{ $item->rekamMedis->diagnosa ?? 'Belum diinput' }}
                                            </span>
                                            <div class="mt-2">
                                                <small class="text-dark bg-white border rounded px-2 py-1">
                                                    <i class="bi bi-capsule me-1 text-teal"></i>
                                                    {{ $item->rekamMedis->resep_obat ?? 'Tidak ada resep' }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 bg-white rounded-4 border shadow-sm">
                        <i class="bi bi-folder-x text-muted" style="font-size: 4rem;"></i>
                        <h5 class="fw-bold mt-3">Belum Ada Riwayat</h5>
                        <p class="text-muted">Riwayat medis kamu akan muncul setelah pemeriksaan selesai.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
