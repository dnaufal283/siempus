<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SIEMPUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        .text-teal {
            color: #14b8a6 !important;
        }

        .bg-teal {
            background-color: #14b8a6 !important;
        }

        .btn-login {
            background-color: #14b8a6;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #0d9488;
            color: white;
        }

        .hover-teal:hover {
            color: #14b8a6 !important;
        }

        .form-control-custom {
            padding: 12px 15px;
            background-color: #f8fafc;
        }

        .form-control-custom:focus {
            box-shadow: none;
            border-color: #14b8a6;
            background-color: #ffffff;
        }

        /* Motif Polkadot transparan untuk sisi kiri */
        .bg-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 30px 30px;
        }
    </style>
</head>

<body>

    <div class="container-fluid vh-100">
        <div class="row h-100">

            <!-- SISI KIRI (Ilustrasi & Branding) -->
            <div
                class="col-lg-5 d-none d-lg-flex flex-column justify-content-center align-items-center bg-teal bg-pattern text-white text-center position-relative">

                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mb-4 shadow-lg"
                    style="width: 120px; height: 120px;">
                    <i class="bi bi-shield-lock-fill text-teal" style="font-size: 4rem;"></i>
                </div>

                <h1 class="fw-bold mb-3 display-5">Pemulihan Akun</h1>
                <p class="px-5" style="font-size: 1.1rem; opacity: 0.9; line-height: 1.6;">
                    Jangan khawatir jika Anda melupakan kata sandi. Kami akan membantu memulihkan akses ke rekam medis
                    Anda dengan aman dan cepat melalui verifikasi WhatsApp.
                </p>
            </div>

            <!-- SISI KANAN (Form Lupa Sandi) -->
            <div class="col-lg-7 d-flex flex-column justify-content-center" style="padding: 0 8%;">

                <div class="w-100" style="max-width: 500px; margin: 0 auto;">

                    <!-- Link Kembali -->
                    <a href="/login-pasien"
                        class="text-decoration-none text-muted small fw-semibold mb-5 d-inline-block hover-teal">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Login
                    </a>

                    <form method="POST" action="/lupa-password/kirim-otp">
                        @csrf

                        <!-- Bagian Header Form -->
                        <div class="mb-4 mt-2">
                            <h2 class="fw-bold text-dark mb-2">Lupa Kata Sandi? 🔐</h2>
                            <p class="text-muted small" style="line-height: 1.6;">
                                Masukkan Nomor Induk Kependudukan (NIK) Anda. Kami akan mengirimkan 6 digit kode OTP ke
                                nomor WhatsApp yang terdaftar pada sistem kami.
                            </p>
                        </div>

                        <!-- Pesan Error -->
                        @if (session('error'))
                            <div class="alert alert-danger rounded-4 border-0 small mb-4 shadow-sm p-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        <!-- Input NIK -->
                        <div class="mb-5">
                            <label for="nik" class="form-label fw-bold small text-dark mb-2">Nomor Induk
                                Kependudukan (NIK)</label>
                            <div class="input-group shadow-sm rounded-4">
                                <span class="input-group-text bg-light border-end-0 rounded-start-4 px-3"
                                    style="border: 2px solid #e2e8f0;">
                                    <i class="bi bi-person-vcard text-muted fs-5"></i>
                                </span>
                                <input type="text"
                                    class="form-control form-control-custom border-start-0 rounded-end-4" id="nik"
                                    name="nik" placeholder="Contoh: 3204322811050010" required autofocus>
                            </div>
                            <div class="form-text mt-2 small text-muted">
                                <i class="bi bi-info-circle me-1"></i> Pastikan NIK terdiri dari 16 digit angka.
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-login rounded-pill w-100 mb-3 shadow">
                            Kirim Kode OTP <i class="bi bi-whatsapp ms-2"></i>
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
