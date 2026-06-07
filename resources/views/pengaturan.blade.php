<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - SIEMPUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .text-teal {
            color: #14b8a6 !important;
        }

        .bg-teal {
            background-color: #14b8a6 !important;
        }

        .btn-teal {
            background-color: #14b8a6;
            color: white;
        }

        .btn-teal:hover {
            background-color: #0d9488;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="d-flex align-items-center mb-4">
                    <a href="/dashboard-pasien" class="btn btn-light rounded-circle shadow-sm me-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h3 class="fw-bold mb-0">Pengaturan Akun</h3>
                </div>

                <!-- Pesan Alert -->
                @if (session('sukses'))
                    <div class="alert alert-success border-0 shadow-sm rounded-3"><i
                            class="bi bi-check-circle-fill me-2"></i>{{ session('sukses') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger border-0 shadow-sm rounded-3"><i
                            class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- CARD 1: Profil -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-person-badge text-teal me-2"></i>Informasi Profil</h5>
                        <form action="/pengaturan/update-profil" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">NIK / Email (Tidak bisa
                                    diubah)</label>
                                <input type="text" class="form-control bg-light"
                                    value="{{ explode('@', $user->email)[0] }}" readonly>
                            </div>
                            <button type="submit" class="btn btn-teal rounded-pill px-4">Simpan Profil</button>
                        </form>
                    </div>
                </div>

                <!-- CARD 2: Keamanan (Ganti Password) -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-shield-lock text-teal me-2"></i>Keamanan Akun</h5>
                        <form action="/pengaturan/update-password" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Kata Sandi Lama</label>
                                <input type="password" name="password_lama" class="form-control"
                                    placeholder="Masukkan sandi saat ini" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-semibold text-muted">Kata Sandi Baru</label>
                                    <input type="password" name="password_baru" class="form-control"
                                        placeholder="Minimal 6 karakter" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-semibold text-muted">Konfirmasi Sandi Baru</label>
                                    <!-- Penamaan name ini penting agar validasi 'confirmed' di Laravel jalan -->
                                    <input type="password" name="password_baru_confirmation" class="form-control"
                                        placeholder="Ketik ulang sandi baru" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-dark rounded-pill px-4">Perbarui Kata
                                Sandi</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
