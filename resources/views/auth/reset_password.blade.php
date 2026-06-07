<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Sandi Baru - SIEMPUS</title>
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

        /* CSS untuk menyatukan border input dengan tombol mata */
        .input-group-text,
        .form-control-custom,
        .btn-toggle-password {
            border: 2px solid #e2e8f0;
        }

        .form-control-custom:focus+.btn-toggle-password {
            border-color: #14b8a6;
        }

        .bg-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 30px 30px;
        }
    </style>
</head>

<body>

    <div class="container-fluid vh-100">
        <div class="row h-100">

            <!-- SISI KIRI (Branding) -->
            <div
                class="col-lg-5 d-none d-lg-flex flex-column justify-content-center align-items-center bg-teal bg-pattern text-white text-center position-relative">
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mb-4 shadow-lg"
                    style="width: 120px; height: 120px;">
                    <i class="bi bi-key-fill text-teal" style="font-size: 4rem;"></i>
                </div>
                <h1 class="fw-bold mb-3 display-5">Akses Dipulihkan</h1>
                <p class="px-5" style="font-size: 1.1rem; opacity: 0.9; line-height: 1.6;">
                    Verifikasi identitas Anda berhasil. Silakan buat kata sandi baru yang kuat untuk menjaga rekam medis
                    elektronik Anda tetap aman.
                </p>
            </div>

            <!-- SISI KANAN (Form Sandi Baru) -->
            <div class="col-lg-7 d-flex flex-column justify-content-center" style="padding: 0 8%;">
                <div class="w-100" style="max-width: 500px; margin: 0 auto;">

                    <form method="POST" action="/reset-password/simpan">
                        @csrf

                        <div class="mb-4 mt-2">
                            <h2 class="fw-bold text-dark mb-2">Buat Sandi Baru 🔑</h2>
                            <p class="text-muted small" style="line-height: 1.6;">
                                Silakan masukkan kata sandi baru Anda. Pastikan mudah diingat, namun sulit ditebak oleh
                                orang lain.
                            </p>
                        </div>

                        <!-- PENANGKAP ERROR LENGKAP -->
                        @if (session('error'))
                            <div class="alert alert-danger rounded-4 border-0 small mb-4 shadow-sm p-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        <!-- Error dari Validasi Laravel (misal: sandi tidak cocok) -->
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-4 border-0 small mb-4 shadow-sm p-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Input Sandi Baru -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold small text-dark mb-2">Kata Sandi
                                Baru</label>
                            <div class="input-group shadow-sm rounded-4">
                                <span class="input-group-text bg-light border-end-0 rounded-start-4 px-3">
                                    <i class="bi bi-lock text-muted fs-6"></i>
                                </span>
                                <input type="password"
                                    class="form-control form-control-custom border-start-0 border-end-0" id="password"
                                    name="password" placeholder="Minimal 6 karakter" required autofocus>
                                <button class="btn bg-light border-start-0 rounded-end-4 px-3 btn-toggle-password"
                                    type="button" data-target="password">
                                    <i class="bi bi-eye-slash text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input Konfirmasi Sandi -->
                        <div class="mb-5">
                            <label for="password_confirmation" class="form-label fw-bold small text-dark mb-2">Ulangi
                                Sandi Baru</label>
                            <div class="input-group shadow-sm rounded-4">
                                <span class="input-group-text bg-light border-end-0 rounded-start-4 px-3">
                                    <i class="bi bi-shield-check text-muted fs-6"></i>
                                </span>
                                <input type="password"
                                    class="form-control form-control-custom border-start-0 border-end-0"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Ketik ulang sandi baru di sini" required>
                                <button class="btn bg-light border-start-0 rounded-end-4 px-3 btn-toggle-password"
                                    type="button" data-target="password_confirmation">
                                    <i class="bi bi-eye-slash text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-login rounded-pill w-100 mb-3 shadow">
                            Simpan Sandi Baru <i class="bi bi-check-circle ms-2"></i>
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logika Javascript untuk ikon Mata (Show/Hide Password)
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButtons = document.querySelectorAll('.btn-toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil ID dari input yang mau di-toggle (password atau password_confirmation)
                    const targetId = this.getAttribute('data-target');
                    const inputElement = document.getElementById(targetId);
                    const iconElement = this.querySelector('i');

                    // Ubah tipe dari password ke text atau sebaliknya
                    if (inputElement.type === 'password') {
                        inputElement.type = 'text';
                        iconElement.classList.remove('bi-eye-slash');
                        iconElement.classList.add('bi-eye'); // Ganti ikon mata terbuka
                    } else {
                        inputElement.type = 'password';
                        iconElement.classList.remove('bi-eye');
                        iconElement.classList.add('bi-eye-slash'); // Ganti ikon mata tercoret
                    }
                });
            });
        });
    </script>
</body>

</html>
