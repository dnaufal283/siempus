<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Pasien - SIEMPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
        }

        /* Area Kiri (Branding Pasien) - Warna gradient sedikit lebih fresh */
        .login-sidebar {
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
            position: relative;
            overflow: hidden;
        }

        .login-sidebar::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 10%, transparent 20%);
            background-size: 60px 60px;
            top: -50%;
            left: -50%;
            transform: rotate(45deg);
        }

        .form-wrapper {
            max-width: 420px;
            width: 100%;
        }

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

        .register-box {
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>

<body>

    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1 g-0">

            <!-- SEBELAH KIRI: Branding Pasien -->
            <div
                class="col-lg-5 col-xl-6 d-none d-lg-flex login-sidebar flex-column justify-content-center align-items-center text-white p-5">
                <div class="position-relative" style="z-index: 1; max-width: 500px; text-align: center;">
                    <!-- Ikon Detak Jantung / Kesehatan -->
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow-lg"
                        style="width: 80px; height: 80px; color: #14b8a6;">
                        <i class="bi bi-heart-pulse-fill fs-1"></i>
                    </div>
                    <h1 class="fw-bold mb-3" style="letter-spacing: -1px;">Layanan Pasien</h1>
                    <p class="fs-5 opacity-75 mb-0" style="line-height: 1.6;">
                        Ambil antrean online dari rumah, pantau estimasi panggilan, dan lihat rekam medis Anda dengan
                        mudah.
                    </p>
                </div>
            </div>

            <!-- SEBELAH KANAN: Form Login -->
            <div class="col-lg-7 col-xl-6 d-flex justify-content-center align-items-center p-4 p-sm-5 bg-white">
                <div class="form-wrapper">

                    <a href="/" class="back-link d-inline-flex align-items-center mb-5">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                    </a>

                    <div class="mb-4">
                        <h2 class="fw-800 text-dark mb-2" style="letter-spacing: -0.5px;">Halo, Sehat Selalu! 🏥</h2>
                        <p class="text-muted">Silakan masuk menggunakan email dan kata sandi yang telah Anda daftarkan.
                        </p>
                    </div>

                    <form method="POST" action="/proses-login">
                        @csrf
                        <!-- Pesan Sukses Daftar -->
                        @if (session('sukses'))
                            <div class="alert alert-success rounded-3 border-0 small mb-4">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
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

                        <!-- Pesan Gagal Login -->
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 border-0 small mb-4">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Email atau kata sandi tidak cocok
                                dengan data kami.
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
                                    name="email" value="{{ old('email') }}" placeholder="nik@pasien.siempus.com"
                                    required autofocus>
                            </div>
                        </div>

                        <!-- Input Password -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-bold small text-dark mb-0">Kata Sandi</label>
                                <!-- Link Lupa Password -->
                                <a href="/lupa-password"
                                    class="text-teal text-decoration-none small fw-semibold hover-teal">Lupa Sandi?</a>
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

                        <button type="submit" class="btn btn-login w-100 mb-3 shadow-sm">
                            Masuk <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </form>

                    <!-- KOTAK PENDAFTARAN PASIEN BARU -->
                    <div class="register-box">
                        <p class="text-muted small mb-2">Belum memiliki akun rekam medis?</p>
                        <a href="/daftar" class="btn btn-outline-dark fw-bold rounded-pill w-100 py-2 border-2">
                            Daftar Pasien Baru
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
