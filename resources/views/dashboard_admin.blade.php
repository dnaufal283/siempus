<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Antrean - SIEMPUS</title>
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

        /* Pengaturan Sidebar Sama Seperti Panel IT & Pasien */
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
    </style>
</head>

<body>

    @php
        $totalAntrean = $semuaAntrean->count();
        $menunggu = $semuaAntrean->where('status', 'menunggu')->count();
        $selesai = $semuaAntrean->where('status', 'selesai')->count();
    @endphp

    <div class="d-flex">
        <!-- Sidebar Loket -->
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white"><i class="bi bi-hospital me-2"></i> LOKET PUSKESMAS</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="/dashboard-admin"><i class="bi bi-display me-2 w-20px text-center"></i>
                    Dashboard Antrean</a>
                <a class="nav-link" href="/dashboard-admin/pasien"><i
                        class="bi bi-people-fill me-2 w-20px text-center"></i> Data Pasien Master</a>
                <a class="nav-link" href="/dashboard-admin/laporan"><i
                        class="bi bi-file-earmark-text me-2 w-20px text-center"></i> Laporan Harian</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom mb-4">
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
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-light btn-sm rounded-circle border shadow-sm"
                            style="width: 40px; height: 40px;" title="Keluar">
                            <i class="bi bi-power text-danger fw-bold"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Area Konten Antrean -->
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
                        <h4 class="fw-bold mb-1 text-dark"><i class="bi bi-display me-2 text-secondary"></i> Manajemen
                            Antrean</h4>
                        <p class="text-muted mb-0 small">Pantau dan kelola antrean pasien hari ini.</p>
                    </div>
                    <div class="text-muted bg-white px-3 py-2 rounded-pill shadow-sm border small fw-semibold">
                        <i class="bi bi-calendar3 me-2" style="color: var(--siempus-teal);"></i>
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <!-- 3 Kartu Statistik -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="bg-white p-3 rounded-4 shadow-sm d-flex align-items-center gap-3 border">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0 small fw-bold text-uppercase">Total Pasien</p>
                                <h2 class="fw-bold mb-0">{{ $totalAntrean }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white p-3 rounded-4 shadow-sm d-flex align-items-center gap-3 border">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0 small fw-bold text-uppercase">Menunggu</p>
                                <h2 class="fw-bold mb-0">{{ $menunggu }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white p-3 rounded-4 shadow-sm d-flex align-items-center gap-3 border">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0 small fw-bold text-uppercase">Selesai</p>
                                <h2 class="fw-bold mb-0">{{ $selesai }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Data Antrean -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white p-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Daftar Antrean Berjalan</h5>
                            <button class="btn btn-light btn-sm rounded-pill fw-semibold text-muted border"
                                onclick="window.location.reload();">
                                <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                            </button>
                        </div>

                        <form action="" method="GET" class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-search text-muted"></i></span>
                                    <input type="text" name="search" class="form-control border-start-0 bg-light"
                                        placeholder="Cari No. / Nama..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="poli" class="form-select bg-light">
                                    <option value="">-- Semua Poliklinik --</option>
                                    <option value="Poli Umum" {{ request('poli') == 'Poli Umum' ? 'selected' : '' }}>
                                        Poli Umum</option>
                                    <option value="Poli Gigi" {{ request('poli') == 'Poli Gigi' ? 'selected' : '' }}>
                                        Poli Gigi</option>
                                    <option value="Poli KIA" {{ request('poli') == 'Poli KIA' ? 'selected' : '' }}>
                                        Poli
                                        KIA</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select bg-light">
                                    <option value="">-- Semua Status --</option>
                                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                                        Menunggu</option>
                                    <option value="dipanggil"
                                        {{ request('status') == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                        Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn w-100 fw-semibold text-white rounded-3"
                                    style="background-color: var(--siempus-teal);">Filter</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3">No. Antrean</th>
                                        <th class="py-3">Nama Pasien</th>
                                        <th class="py-3">Poli Tujuan</th>
                                        <th class="py-3">Status</th>
                                        <th class="text-end pe-4 py-3">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($semuaAntrean as $a)
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <span
                                                    class="badge bg-secondary bg-opacity-10 text-dark border px-3 py-2 fs-6 rounded-pill">
                                                    {{ sprintf('%03d', $a->nomor_antrean) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $a->user->name }}</div>
                                                <div class="text-muted small">Waktu Daftar:
                                                    {{ $a->created_at->format('H:i') }} WIB</div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-medium">
                                                    <i class="bi bi-building-add me-1"
                                                        style="color: var(--siempus-teal);"></i> {{ $a->poli }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($a->status == 'menunggu')
                                                    <span
                                                        class="badge bg-warning bg-opacity-25 text-warning-emphasis px-3 py-2 rounded-pill border border-warning-subtle">
                                                        <i class="bi bi-clock me-1"></i> Menunggu
                                                    </span>
                                                @elseif($a->status == 'dipanggil')
                                                    <span
                                                        class="badge bg-primary bg-opacity-25 text-primary-emphasis px-3 py-2 rounded-pill border border-primary-subtle">
                                                        <i class="bi bi-mic me-1"></i> Dipanggil
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-success bg-opacity-25 text-success-emphasis px-3 py-2 rounded-pill border border-success-subtle">
                                                        <i class="bi bi-check2-all me-1"></i> Selesai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex gap-2 justify-content-end">
                                                    @if ($a->status == 'selesai')
                                                        <button type="button"
                                                            class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail{{ $a->id }}">
                                                            <i class="bi bi-eye me-1"></i> Detail
                                                        </button>
                                                        <a href="{{ route('cetak.struk', $a->id) }}"
                                                            class="btn btn-outline-info btn-sm rounded-pill px-3 fw-semibold shadow-sm text-info-emphasis border-info-subtle"
                                                            target="_blank">
                                                            <i class="bi bi-printer me-1"></i> Cetak Struk
                                                        </a>
                                                    @else
                                                        <form action="/update-status-antrean/{{ $a->id }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="dipanggil">
                                                            <button type="submit"
                                                                class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold"
                                                                {{ $a->status == 'dipanggil' ? 'disabled' : '' }}>
                                                                <i class="bi bi-megaphone-fill me-1"></i> Panggil
                                                            </button>
                                                        </form>
                                                        <form action="/update-status-antrean/{{ $a->id }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="selesai">
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                                                                <i class="bi bi-check-lg me-1"></i> Selesai
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                                <h5>Belum ada antrean yang ditemukan</h5>
                                                <p class="small">Pastikan tidak ada salah ketik pada kolom pencarian.
                                                </p>
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

    <!-- PERULANGAN MODAL DETAIL (Di Luar Tabel) -->
    @foreach ($semuaAntrean as $a)
        @if ($a->status == 'selesai')
            <div class="modal fade text-start" id="modalDetail{{ $a->id }}" tabindex="-1"
                aria-labelledby="modalDetailLabel{{ $a->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-light border-bottom-0 rounded-top-4 p-4 pb-3">
                            <h5 class="modal-title fw-bold text-dark" id="modalDetailLabel{{ $a->id }}">
                                <i class="bi bi-person-vcard me-2" style="color: var(--siempus-teal);"></i> Informasi
                                Detail Pasien
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 pt-2">
                            <div class="text-center mb-4">
                                <p class="text-muted mb-1 small text-uppercase fw-semibold">Nomor Antrean</p>
                                <h1 class="display-4 fw-bold mb-0" style="color: var(--siempus-teal);">
                                    {{ sprintf('%03d', $a->nomor_antrean) }}</h1>
                                <span class="badge bg-light text-dark border px-3 py-2 mt-2 rounded-pill fw-medium">
                                    <i class="bi bi-building-add me-1 text-muted"></i> {{ $a->poli }}
                                </span>
                            </div>

                            <div class="bg-light p-3 rounded-3 border mb-0">
                                <table class="table table-borderless table-sm mb-0">
                                    <tr>
                                        <td class="text-muted" width="45%">Nama Lengkap</td>
                                        <td class="fw-bold text-dark">: {{ $a->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tanggal Daftar</td>
                                        <td class="fw-bold text-dark">:
                                            {{ $a->created_at->translatedFormat('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Waktu Daftar</td>
                                        <td class="fw-bold text-dark">: {{ $a->created_at->format('H:i') }} WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status Antrean</td>
                                        <td class="fw-bold text-dark">:
                                            <span class="text-success text-uppercase"><i
                                                    class="bi bi-check-circle-fill me-1"></i>
                                                {{ $a->status }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 bg-white rounded-bottom-4 p-4 pt-0">
                            <button type="button" class="btn btn-light border rounded-pill px-4 fw-medium w-100"
                                data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
