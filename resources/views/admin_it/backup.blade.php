<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup Data - SIEMPUS IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .content {
            margin-left: 260px;
            padding: 0;
            width: calc(100% - 260px);
            min-height: 100vh;
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
                <a class="nav-link" href="{{ route('it.dashboard') }}"><i
                        class="fas fa-home me-2 w-20px text-center"></i> Dashboard</a>
                <a class="nav-link" href="/dashboard-it/users"><i class="fas fa-users-cog me-2 w-20px text-center"></i>
                    Manajemen User</a>
                <a class="nav-link" href="/dashboard-it/poli"><i class="fas fa-hospital me-2 w-20px text-center"></i>
                    Master Poli</a>
                <a class="nav-link" href="/dashboard-it/dokter"><i class="fas fa-user-md me-2 w-20px text-center"></i>
                    Master Dokter</a>
                <a class="nav-link" href="/dashboard-it/config"><i class="fas fa-cogs me-2 w-20px text-center"></i>
                    Konfigurasi Sistem</a>
                <a class="nav-link active" href="/dashboard-it/backup"><i
                        class="fas fa-database me-2 w-20px text-center"></i> Backup Data</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">Panel
                        Admin IT</span>
                </div>
            </div>

            <!-- Area Konten Backup -->
            <div class="p-4">
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-1"><i class="fas fa-database me-2 text-secondary"></i> Backup
                        Database</h5>
                    <p class="text-muted">Amankan data sistem SIEMPUS dengan melakukan backup secara berkala.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 rounded text-center p-4">
                            <div class="card-body">
                                <i class="fas fa-cloud-download-alt text-success mb-3" style="font-size: 4rem;"></i>
                                <h5 class="fw-bold text-dark">Unduh Backup Terkini</h5>
                                <p class="text-muted text-sm mb-4">Fitur ini akan meng-generate file <code>.sql</code>
                                    yang berisi seluruh struktur dan data aplikasi dari awal sampai detik ini.</p>

                                <a href="{{ route('it.backup.download') }}"
                                    class="btn text-white px-4 rounded-pill shadow-sm"
                                    style="background-color: var(--siempus-teal);">
                                    <i class="fas fa-download me-2"></i> Proses & Download Database
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-warning border-0 shadow-sm" role="alert">
                            <h6 class="fw-bold alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Perhatian
                                Penting!</h6>
                            <hr>
                            <ul class="mb-0 text-dark" style="font-size: 0.9rem;">
                                <li class="mb-2">Simpan file backup di tempat yang aman (Flashdisk / Google Drive).
                                </li>
                                <li class="mb-2">Lakukan backup minimal <strong>1 minggu sekali</strong> untuk
                                    mencegah kehilangan data antrean pasien.</li>
                                <li>File <code>.sql</code> ini bersifat konfidensial karena mengandung riwayat data
                                    pasien Puskesmas Baleendah.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
