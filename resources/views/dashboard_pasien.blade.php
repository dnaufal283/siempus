<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien - SIEMPUS</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
        }

        /* Tweak Warna Khusus */
        .text-teal {
            color: #14B8A6 !important;
        }

        .bg-teal {
            background-color: #14B8A6 !important;
            color: white !important;
        }

        .bg-teal-light {
            background-color: rgba(20, 184, 166, 0.1) !important;
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Efek Hover Card Modern */
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            background: white;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(20, 184, 166, 0.08);
            border: 1px solid rgba(20, 184, 166, 0.1);
        }

        /* Banner Utama */
        .welcome-banner {
            background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);
            color: white;
            border-radius: 20px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(20, 184, 166, 0.2);
        }

        .welcome-banner .bg-icon {
            position: absolute;
            right: -20px;
            bottom: -30px;
            font-size: 150px;
            opacity: 0.1;
            transform: rotate(-15deg);
        }

        /* Desain Tiket Keren */
        .ticket-card {
            display: flex;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            flex-wrap: wrap;
            /* Biar aman di HP */
        }

        .ticket-left {
            padding: 2rem;
            flex: 1;
            border-right: 2px dashed #CBD5E1;
        }

        .ticket-right {
            padding: 2rem;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(20, 184, 166, 0.03);
        }

        .ticket-number {
            font-size: 4rem;
            font-weight: 800;
            color: #14B8A6;
            line-height: 1;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 1.5rem auto;
            background-color: rgba(20, 184, 166, 0.1);
            color: #14B8A6;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <span class="text-teal">SIEM</span>PUS
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-block text-end">
                    <p class="mb-0 fw-bold lh-1 text-dark">{{ Auth::user()->name }}</p>
                    <small class="text-muted" style="font-size: 0.75rem;">ID: #{{ Auth::user()->id }}</small>
                </div>
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-teal fw-bold border border-2 border-white shadow-sm"
                    style="width: 45px; height: 45px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="vr mx-1 text-muted"></div>
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill fw-semibold">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill px-4 mb-4 border-0 shadow-sm"
                role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') }}
                <button type="button" class="btn-close mt-1" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show rounded-pill px-4 mb-4 border-0 shadow-sm"
                role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close mt-1" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="welcome-banner mb-5">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8">
                    <span class="badge bg-white text-teal px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">Puskesmas
                        Baleendah</span>
                    <h2 class="fw-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="fs-6 mb-0 opacity-75">Gunakan layanan mandiri SIEMPUS untuk pendaftaran yang lebih cepat.
                    </p>
                </div>
            </div>
            <i class="bi bi-heart-pulse bg-icon"></i>
        </div>

        @if ($antreanAktif)
            <div class="mb-5">
                <h5 class="fw-bold mb-3 ms-1 text-dark"><i class="bi bi-ticket-perforated text-teal me-2"></i>Tiket
                    Antrean Anda Hari Ini</h5>
                <div class="ticket-card">
                    <div class="ticket-left">
                        <span
                            class="badge bg-{{ $antreanAktif->status == 'menunggu' ? 'warning text-dark' : 'success' }} px-3 py-2 rounded-pill mb-3 fw-semibold shadow-sm">
                            <i
                                class="bi {{ $antreanAktif->status == 'menunggu' ? 'bi-hourglass-split' : 'bi-check-circle' }} me-1"></i>
                            Status: {{ ucfirst($antreanAktif->status) }}
                        </span>
                        <h3 class="fw-bold text-dark mb-1">{{ $antreanAktif->poli }}</h3>
                        <p class="text-muted mb-0">
                            <i class="bi bi-calendar-check text-teal me-2"></i>
                            {{ \Carbon\Carbon::parse($antreanAktif->tanggal_periksa)->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                    <div class="ticket-right text-center">
                        <span class="d-block text-muted small fw-bold mb-1">NOMOR URUT</span>
                        <div class="ticket-number">{{ sprintf('%03d', $antreanAktif->nomor_antrean) }}</div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card card-custom h-100 p-4 text-center">
                    <div class="bg-teal-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                        style="width: 90px; height: 90px;">
                        <i class="bi bi-person-fill text-teal" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-1 text-dark">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small mb-4">{{ Auth::user()->email }}</p>

                    <div class="bg-light p-3 rounded-4 border text-start mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <small class="text-muted fw-semibold">Status Akun</small>
                            <span
                                class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3">Aktif</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted fw-semibold">Tipe Pasien</small>
                            <span class="fw-bold text-dark small">Umum / BPJS</span>
                        </div>
                    </div>
                    <a href="/pengaturan"
                        class="btn btn-outline-secondary w-100 rounded-pill fw-semibold border-2 mt-auto">
                        <i class="bi bi-gear me-1"></i> Pengaturan
                    </a>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card card-custom card-hover p-4 h-100 text-center border-top border-4 border-teal">
                            <div class="icon-circle shadow-sm">
                                <i class="bi bi-grid"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Ambil Nomor Antrean</h5>

                            @if (!$antreanAktif)
                                <p class="text-muted small mb-4">Pilih layanan poli tujuan Anda hari ini.</p>
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="/ambil-antrean" method="POST" class="mt-auto">
                                    @csrf
                                    <div class="mb-3">
                                        <select name="poli_id" class="form-select" required>
                                            <option value="">-- Pilih Poli Tujuan --</option>
                                            @foreach ($polis as $poli)
                                                @if ($poli->is_active)
                                                    <option value="{{ $poli->id }}">
                                                        {{ $poli->nama_poli }} (Kuota: {{ $poli->kuota }})
                                                    </option>
                                                @else
                                                    <option value="{{ $poli->id }}" disabled class="text-danger">
                                                        {{ $poli->nama_poli }} - Tutup Sementara
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="btn bg-teal w-100 rounded-pill py-2 fw-semibold shadow-sm text-white"
                                        style="background-color: #14b8a6;">
                                        Ambil Sekarang
                                    </button>
                                </form>
                            @else
                                <div class="mt-auto p-4 rounded-4 text-center"
                                    style="background-color: #f0fdfa; border: 1px solid #ccfbf1;">
                                    <i class="bi bi-check2-circle text-teal display-6 mb-2 d-block"
                                        style="color: #14b8a6;"></i>
                                    <p class="small fw-bold mb-0" style="color: #0d9488;">Anda sudah memiliki tiket
                                        aktif hari ini.</p>
                                    <small class="text-muted">Silakan cek detail nomor antrean Anda di bagian
                                        bawah.</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-custom card-hover p-4 h-100 text-center">
                            <div class="icon-circle shadow-sm"
                                style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                                <i class="bi bi-folder2-open"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Riwayat Medis</h5>
                            <p class="text-muted small mb-4">Akses catatan kunjungan, diagnosa dokter, dan resep Anda.
                            </p>
                            <a href="/riwayat"
                                class="btn btn-outline-dark w-100 rounded-pill py-2 mt-auto fw-semibold border-2">
                                <i class="bi bi-search me-1"></i> Lihat Catatan
                            </a>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card card-custom p-4 bg-dark text-white text-start">
                            <div class="row align-items-center">
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <h5 class="fw-bold mb-1"><i class="bi bi-headset text-success me-2"></i>Butuh
                                        Bantuan?</h5>
                                    <p class="small mb-0 text-light opacity-75">Admin siap membantu Anda jika mengalami
                                        kendala pendaftaran.</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <a href="https://wa.me/628987096566"
                                        class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                                        <i class="bi bi-whatsapp me-2"></i> Hubungi Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
