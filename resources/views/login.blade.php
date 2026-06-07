<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pegawai - SIEMPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
        }

        /* Area Kiri (Branding) */
        .login-sidebar {
            background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%);
            position: relative;
            overflow: hidden;
        }

        /* Pola Ornamen di Kiri */
        .login-sidebar::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 10%, transparent 20%);
            background-size: 50px 50px;
            top: -50%;
            left: -50%;
            transform: rotate(30deg);
        }

        /* Area Kanan (Form) */
        .form-wrapper {
            max-width: 420px;
            width: 100%;
        }

        /* Modifikasi Input Form */
        .form-control-custom {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control-custom:focus {
            border-color: #14b8a6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1);
        }

        /* Tombol Login */
        .btn-login {
            background-color: #14b8a6;
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 16px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0d9488;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(20, 184, 166, 0.2);
            color: white;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #14b8a6;
        }
    </style>
</head>

<body>

    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1 g-0">

            <!-- SEBELAH KIRI: Gambar / Branding (Hanya muncul di layar PC/Laptop) -->
            <div
                class="col-lg-5 col-xl-6 d-none d-lg-flex login-sidebar flex-column justify-content-center align-items-center text-white p-5">
                <div class="position-relative" style="z-index: 1; max-width: 500px; text-align: center;">
                    <!-- Bisa diganti logo kelompok 6 atau ilustrasi dokter -->
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow-lg"
                        style="width: 80px; height: 80px; color: #14b8a6;">
                        <i class="bi bi-shield-lock-fill fs-1"></i>
                    </div>
                    <h1 class="fw-bold mb-3" style="letter-spacing: -1px;">Portal Pegawai</h1>
                    <p class="fs-5 opacity-75 mb-0">
                        Sistem Informasi Pelayanan Puskesmas.<br>Akses aman untuk Admin, Dokter, dan Apoteker.
                    </p>
                </div>
            </div>

            <!-- SEBELAH KANAN: Form Login -->
            <div class="col-lg-7 col-xl-6 d-flex justify-content-center align-items-center p-4 p-sm-5 bg-white">
                <div class="form-wrapper">

                    <!-- Tombol Kembali -->
                    <a href="/" class="back-link d-inline-flex align-items-center mb-5">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                    </a>

                    <!-- Header Form -->
                    <div class="mb-4">
                        <h2 class="fw-800 text-dark mb-2" style="letter-spacing: -0.5px;">Selamat Datang! 👋</h2>
                        <p class="text-muted">Silakan masukkan email dan kata sandi Anda untuk mengakses dashboard
                            pengelola.</p>
                    </div>

                    <!-- FORM LOGIN LARAVEL -->
                    <form method="POST" action="/proses-login">
                        @csrf

                        <!-- Alert jika ada error -->
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 border-0 small">
                                Email atau kata sandi tidak cocok dengan data kami.
                            </div>
                        @endif

                        <!-- Input Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold small text-dark">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-4"
                                    style="border: 2px solid #e2e8f0;">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input type="email"
                                    class="form-control form-control-custom border-start-0 rounded-end-4" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="contoh: admin@siempus.com"
                                    required autofocus>
                            </div>
                        </div>

                        <!-- Input Password -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-bold small text-dark mb-0">Kata Sandi</label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-4"
                                    style="border: 2px solid #e2e8f0;">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                <input type="password"
                                    class="form-control form-control-custom border-start-0 rounded-end-4" id="password"
                                    name="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Checkbox Remember Me -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-muted small" for="remember">
                                Ingat sesi saya
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-login w-100 mb-3 shadow-sm">
                            Masuk ke Sistem <i class="bi bi-box-arrow-in-right ms-1"></i>
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
