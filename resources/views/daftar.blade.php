<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien Baru - SIEMPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
        }

        /* Area Kiri (Branding Register) - Gradasi Toska ke Biru Gelap */
        .register-sidebar {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            position: relative;
            overflow: hidden;
        }

        .register-sidebar::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 10%, transparent 20%);
            background-size: 80px 80px;
            top: -50%;
            left: -50%;
            transform: rotate(-45deg);
        }

        .form-wrapper {
            max-width: 600px;
            /* Diperlebar karena formnya 2 kolom */
            width: 100%;
        }

        .form-control-custom {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control-custom:focus {
            border-color: #14b8a6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1);
        }

        .btn-register {
            background-color: #0f172a;
            /* Warna gelap agar beda dengan login */
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 16px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background-color: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.2);
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

        .login-box {
            background-color: #f0fdfa;
            /* Warna toska sangat muda */
            border: 1px dashed #5eead4;
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

            <!-- SEBELAH KIRI: Branding Register -->
            <div
                class="col-lg-4 col-xl-5 d-none d-lg-flex register-sidebar flex-column justify-content-center align-items-center text-white p-5">
                <div class="position-relative" style="z-index: 1; max-width: 450px; text-align: center;">
                    <!-- Ikon Kartu Identitas Medis -->
                    <div class="bg-white rounded-4 d-flex align-items-center justify-content-center mx-auto mb-4 shadow-lg"
                        style="width: 80px; height: 80px; color: #0f766e; transform: rotate(-5deg);">
                        <i class="bi bi-person-vcard-fill fs-1"></i>
                    </div>
                    <h1 class="fw-bold mb-3" style="letter-spacing: -1px;">Daftar Akun Baru</h1>
                    <p class="fs-6 opacity-75 mb-0" style="line-height: 1.6;">
                        Satu akun untuk seluruh kemudahan layanan kesehatan di Puskesmas. Pastikan data diri Anda sesuai
                        dengan KTP.
                    </p>
                </div>
            </div>

            <!-- SEBELAH KANAN: Form Register -->
            <div
                class="col-lg-8 col-xl-7 d-flex justify-content-center align-items-center p-4 p-sm-5 bg-white overflow-auto">
                <div class="form-wrapper py-4">

                    <a href="/" class="back-link d-inline-flex align-items-center mb-4">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                    </a>

                    <div class="mb-4">
                        <h2 class="fw-800 text-dark mb-2" style="letter-spacing: -0.5px;">Lengkapi Data Diri 📝</h2>
                        <p class="text-muted small">Informasi ini akan digunakan sebagai data rekam medis utama Anda.
                        </p>
                    </div>

                    <!-- FORM REGISTER -->
                    <form method="POST" action="/simpan-daftar">
                        @csrf

                        <!-- Grid 2 Kolom untuk Input -->
                        <div class="row g-3 mb-3">
                            <!-- NIK -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Nomor Induk Kependudukan (NIK)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-credit-card-2-front text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="nik" placeholder="16 Digit NIK" required autofocus>
                                </div>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Nama Lengkap (Sesuai KTP)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="nama" placeholder="Nama Lengkap" required>
                                </div>
                            </div>

                            <!-- Tempat Lahir -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Tempat Lahir</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-geo-alt text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="tempat_lahir" placeholder="Contoh: Bandung" required>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Tanggal Lahir</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-calendar-date text-muted"></i>
                                    </span>
                                    <input type="date"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="tanggal_lahir" required>
                                </div>
                            </div>

                            <!-- Nomor BPJS -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Nomor BPJS (Opsional)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-postcard-heart text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="no_bpjs" placeholder="13 Digit BPJS">
                                </div>
                            </div>

                            <!-- Nomor HP/WA (Sudah diubah menjadi name="no_hp") -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Nomor HP (WhatsApp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-whatsapp text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="no_hp" placeholder="08xxxxxxxx" required>
                                </div>
                            </div>

                            <!-- Alamat Lengkap (BARU - Full Width col-12) -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold small text-dark">Alamat Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-house-door text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="alamat" placeholder="Nama Jalan, RT/RW, Desa/Kelurahan" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="password" placeholder="Minimal 8 karakter" required>
                                </div>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Konfirmasi Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3"
                                        style="border: 2px solid #e2e8f0;">
                                        <i class="bi bi-shield-check text-muted"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control form-control-custom border-start-0 rounded-end-3"
                                        name="password_confirmation" placeholder="Ketik ulang sandi" required>
                                </div>
                            </div>
                        </div>
                        <!-- Syarat & Ketentuan -->
                        <div class="form-check mb-4 mt-2">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label text-muted small" for="terms">
                                Saya setuju dengan <a href="#"
                                    class="text-teal text-decoration-none fw-bold">Syarat & Ketentuan</a> serta
                                Kebijakan Privasi SIEMPUS.
                            </label>
                        </div>

                        <!-- Tombol Daftar -->
                        <button type="submit" class="btn btn-register w-100 mb-3 shadow-sm">
                            Buat Akun Pasien <i class="bi bi-check-circle ms-1"></i>
                        </button>
                    </form>

                    <!-- KOTAK PINDAH KE LOGIN -->
                    <div class="login-box">
                        <p class="text-teal fw-medium small mb-2">Sudah memiliki akun rekam medis?</p>
                        <!-- Menggunakan /login-pasien untuk menghindari error Route Not Defined -->
                        <a href="/login-pasien"
                            class="btn btn-light fw-bold rounded-pill w-100 py-2 text-teal shadow-sm">
                            Masuk ke Dashboard
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
