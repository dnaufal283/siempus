<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurasi Sistem - SIEMPUS IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --siempus-teal: #14b8a6;
            --siempus-teal-hover: #0d9488;
        }

        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--siempus-teal);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            margin: 5px 15px;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--siempus-teal-hover);
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 0;
            width: calc(100% - 260px);
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white">PANEL IT</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('it.dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
                <a class="nav-link" href="/dashboard-it/users"><i class="fas fa-users-cog me-2"></i> Manajemen User</a>
                <a class="nav-link" href="/dashboard-it/poli"><i class="fas fa-hospital me-2"></i> Master Poli</a>
                <a class="nav-link" href="/dashboard-it/dokter"><i class="fas fa-user-md me-2"></i> Master Dokter</a>
                <a class="nav-link active" href="/dashboard-it/config"><i class="fas fa-cogs me-2"></i> Konfigurasi
                    Sistem</a>
                <a class="nav-link" href="/dashboard-it/backup"><i class="fas fa-database me-2 w-20px text-center"></i>
                    Backup Data</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="bg-white p-3 shadow-sm border-bottom mb-4">
                <h4 class="mb-0 fw-bold"><span style="color: var(--siempus-teal);">SIE</span>MPUS <small
                        class="text-secondary fw-normal fs-6">| Pengaturan Sistem</small></h4>
            </div>

            <div class="p-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-sliders-h me-2 text-secondary"></i>
                            Identitas Puskesmas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('it.config.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Nama Puskesmas</label>
                                    <input type="text" name="nama_puskesmas" class="form-control"
                                        value="{{ $settings['nama_puskesmas'] ?? 'Puskesmas Baleendah' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Nomor Telepon Kantor</label>
                                    <input type="text" name="nomor_telepon" class="form-control"
                                        value="{{ $settings['nomor_telepon'] ?? '' }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-medium">Alamat Lengkap</label>
                                    <textarea name="alamat_puskesmas" class="form-control" rows="3">{{ $settings['alamat_puskesmas'] ?? '' }}</textarea>
                                </div>
                                <hr>
                                <h6 class="fw-bold mb-3 mt-2 text-primary">Pengaturan WhatsApp Gateway (Fonnte)</h6>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-medium">Fonnte API Token</label>
                                    <input type="password" name="fonnte_token" class="form-control"
                                        value="{{ $settings['fonnte_token'] ?? '' }}"
                                        placeholder="Masukkan token API fonnte jika sudah ada">
                                    <small class="text-muted italic">*Token ini akan digunakan untuk mengirim notifikasi
                                        antrean otomatis.</small>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn text-white px-4 rounded-pill"
                                    style="background-color: var(--siempus-teal);">
                                    <i class="fas fa-save me-2"></i> Simpan Konfigurasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
