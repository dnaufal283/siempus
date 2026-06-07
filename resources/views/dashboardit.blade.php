<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIEMPUS - Dashboard Admin IT</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --siempus-teal: #14b8a6;
            --siempus-teal-hover: #0d9488;
        }

        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* Sidebar Styling dengan Warna Tema Welcome */
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
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--siempus-teal-hover);
            color: #ffffff;
            font-weight: 500;
        }

        /* Main Content Styling */
        .content {
            margin-left: 260px;
            padding: 0;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* Card Hover Effect */
        .card-stat {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white"><i class="fas fa-server me-2"></i> PANEL IT</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->is('dashboard-it') ? 'active' : '' }}"
                    href="{{ route('it.dashboard') }}">
                    <i class="fas fa-home me-2 w-20px text-center"></i> Dashboard
                </a>
                <a class="nav-link {{ request()->is('dashboard-it/users*') ? 'active' : '' }}"
                    href="/dashboard-it/users">
                    <i class="fas fa-users-cog me-2 w-20px text-center"></i> Manajemen User
                </a>
                <a class="nav-link {{ request()->is('dashboard-it/poli*') ? 'active' : '' }}" href="/dashboard-it/poli">
                    <i class="fas fa-hospital me-2 w-20px text-center"></i> Data Master Poli
                </a>
                <a class="nav-link {{ request()->is('dashboard-it/dokter*') ? 'active' : '' }}"
                    href="/dashboard-it/dokter">
                    <i class="fas fa-user-md me-2 w-20px text-center"></i> Data Master Dokter
                </a>
                <a class="nav-link {{ request()->is('dashboard-it/config*') ? 'active' : '' }}"
                    href="/dashboard-it/config">
                    <i class="fas fa-cogs me-2 w-20px text-center"></i> Konfigurasi Sistem
                </a>
                <a class="nav-link" href="/dashboard-it/backup"><i class="fas fa-database me-2 w-20px text-center"></i>
                    Backup Data</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Topbar Mirip Admin Loket & Welcome -->
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom">

                <!-- Kiri: Logo & Title (Sudah Diperbaiki Warnanya) -->
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">
                        Panel Admin IT
                    </span>
                </div>

                <!-- Kanan: User Info & Logout -->
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Admin IT' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Puskesmas Baleendah</div>
                    </div>
                    <!-- Lingkaran Inisial -->
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                        style="width: 40px; height: 40px; border: 2px solid var(--siempus-teal); color: var(--siempus-teal); background-color: #f0fdfa;">
                        IT
                    </div>
                    <form action="/logout" method="POST" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4 ms-2">
                            <i class="fas fa-sign-out-alt me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Area Card Statistik & Konten -->
            <div class="p-4">
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
                <div class="row g-4 mb-4">
                    <!-- Card 1: Akun Pegawai -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stat bg-white shadow-sm p-3 border-start border-primary border-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Akun Pegawai</h6>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $totalPegawai ?? 0 }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-user-tie fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pasien Terdaftar -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stat bg-white shadow-sm p-3 border-start border-success border-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Pasien Terdaftar</h6>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $totalPasien ?? 0 }}</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-user-injured fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: WA Gateway -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stat bg-white shadow-sm p-3 border-start border-warning border-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">WA Gateway</h6>
                                    <h3 class="fw-bold mb-0 text-dark">
                                        @if ($waStatus == 'Aktif')
                                            <span class="text-success">Aktif</span>
                                        @else
                                            <span class="text-danger fs-5">{{ $waStatus }}</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="fab fa-whatsapp fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: System Load -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stat bg-white shadow-sm p-3 border-start border-info border-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">System Load</h6>
                                    <h3 class="fw-bold mb-0 text-dark">
                                        @if ($systemLoad == 'Normal')
                                            <span class="text-info">{{ $systemLoad }}</span>
                                        @else
                                            <span class="text-danger fs-5">{{ $systemLoad }}</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="bg-info bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-server fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area Log Aktivitas -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-history me-2 text-secondary"></i>
                                    Log Aktivitas Sistem Terbaru</h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-4">Waktu</th>
                                                <th>Pengguna</th>
                                                <th>Aksi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($logs as $log)
                                                <tr>
                                                    <td class="ps-4 text-muted"><small>{{ $log['waktu'] }}</small>
                                                    </td>
                                                    <td class="fw-medium">{{ $log['user'] }}</td>
                                                    <td>{{ $log['aksi'] }}</td>
                                                    <td>
                                                        @if ($log['status'] == 'Success')
                                                            <span
                                                                class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">Success</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1">Failed</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-3 text-muted">Belum ada
                                                        aktivitas sistem.</td>
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

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
