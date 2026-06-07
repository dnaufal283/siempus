<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - SIEMPUS</title>
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

        .bg-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 30px 30px;
        }

        /* CSS Khusus untuk 6 Kotak OTP */
        .otp-box {
            width: 55px;
            height: 65px;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background-color: #f8fafc;
            transition: all 0.2s ease-in-out;
        }

        .otp-box:focus {
            outline: none;
            border-color: #14b8a6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1);
        }

        /* Sembunyikan panah input number */
        .otp-box::-webkit-outer-spin-button,
        .otp-box::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                    <i class="bi bi-chat-left-dots-fill text-teal" style="font-size: 4rem;"></i>
                </div>
                <h1 class="fw-bold mb-3 display-5">Verifikasi Identitas</h1>
                <p class="px-5" style="font-size: 1.1rem; opacity: 0.9; line-height: 1.6;">
                    Keamanan data medis Anda adalah prioritas kami. Masukkan kode 6 digit rahasia yang baru saja kami
                    kirimkan ke nomor WhatsApp Anda.
                </p>
            </div>

            <!-- SISI KANAN (Form OTP) -->
            <div class="col-lg-7 d-flex flex-column justify-content-center" style="padding: 0 8%;">
                <div class="w-100" style="max-width: 500px; margin: 0 auto;">

                    <a href="/login-pasien"
                        class="text-decoration-none text-muted small fw-semibold mb-5 d-inline-block hover-teal">
                        <i class="bi bi-arrow-left me-1"></i> Batal & Kembali ke Login
                    </a>

                    <form method="POST" action="/verifikasi-otp/cek" id="otpForm">
                        @csrf

                        <div class="mb-4 mt-2">
                            <h2 class="fw-bold text-dark mb-2">Verifikasi OTP 💬</h2>
                            <p class="text-muted small" style="line-height: 1.6;">
                                Cek pesan WhatsApp Anda. Masukkan 6 digit kode keamanan yang telah kami kirimkan.
                            </p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger rounded-4 border-0 small mb-4 shadow-sm p-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                            </div>
                        @endif
                        @if (session('sukses'))
                            <div class="alert alert-success rounded-4 border-0 small mb-4 shadow-sm p-3">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') }}
                            </div>
                        @endif

                        <!-- Kotak Input OTP -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between gap-2" id="otp-container">
                                <input type="number" class="otp-box form-control" maxlength="1" autofocus>
                                <input type="number" class="otp-box form-control" maxlength="1">
                                <input type="number" class="otp-box form-control" maxlength="1">
                                <input type="number" class="otp-box form-control" maxlength="1">
                                <input type="number" class="otp-box form-control" maxlength="1">
                                <input type="number" class="otp-box form-control" maxlength="1">
                            </div>

                            <!-- Input tersembunyi untuk mengirim 6 angka ke Controller -->
                            <input type="hidden" name="otp" id="final_otp" required>
                        </div>

                        <div class="text-center mb-4">
                            <span class="text-muted small">Tidak menerima kode?</span>
                            <a href="/lupa-password"
                                class="text-teal text-decoration-none small fw-bold ms-1 hover-teal">
                                Kirim Ulang
                            </a>
                        </div>

                        <button type="submit" id="btn-submit" class="btn btn-login rounded-pill w-100 mb-3 shadow"
                            disabled>
                            Verifikasi Kode <i class="bi bi-check2-all ms-2"></i>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const otpBoxes = document.querySelectorAll(".otp-box");
            const finalOtpInput = document.getElementById("final_otp");
            const btnSubmit = document.getElementById("btn-submit");

            // 1. Logika Pindah Kotak Otomatis
            otpBoxes.forEach((box, index) => {
                box.addEventListener("input", function(e) {
                    // Hanya izinkan 1 angka per kotak
                    if (this.value.length > 1) {
                        this.value = this.value.slice(0, 1);
                    }
                    // Pindah ke kotak kanan jika sudah diisi
                    if (this.value !== "" && index < otpBoxes.length - 1) {
                        otpBoxes[index + 1].focus();
                    }
                    updateFinalOtp();
                });

                // Pindah ke kotak kiri kalau hapus pakai Backspace
                box.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" && this.value === "" && index > 0) {
                        otpBoxes[index - 1].focus();
                    }
                });
            });

            // 2. Gabungkan 6 angka ke dalam input hidden
            function updateFinalOtp() {
                let otpValue = "";
                otpBoxes.forEach(box => {
                    otpValue += box.value;
                });
                finalOtpInput.value = otpValue;

                // Nyalakan tombol submit kalau sudah 6 angka
                if (otpValue.length === 6) {
                    btnSubmit.removeAttribute("disabled");
                } else {
                    btnSubmit.setAttribute("disabled", "true");
                }
            }
        });
    </script>
</body>

</html>
