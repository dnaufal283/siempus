<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIEMPUS Baleendah - Layanan Kesehatan Modern</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        :root {
            --primary-deep: #0F172A;
            --accent-green: #14B8A6;
            --accent-green-hover: #0d9488;
            --accent-light: #F0FDFA;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --body-bg: #F8FAFC;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background-color: var(--body-bg);
            letter-spacing: -0.01em;
            overflow-x: hidden;
        }

        /* Animasi Masuk Halus */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 1. Definisikan gaya class-nya */
        .animasi-mengambang {
            /* Menjalankan animasi bernama 'float', durasi 6 detik, halus (ease-in-out), putar terus (infinite) */
            animation: float 6s ease-in-out infinite;
        }

        /* 2. Buat gerakan animasinya */
        @keyframes float {
            0% {
                transform: translateY(0px);
                /* Posisi awal */
            }

            50% {
                transform: translateY(-20px);
                /* Naik ke atas 20px saat di tengah durasi */
            }

            100% {
                transform: translateY(0px);
                /* Kembali ke posisi awal */
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        /* --- Navbar Glassmorphism --- */
        .navbar-modern {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            color: var(--primary-deep) !important;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.03em;
        }

        .navbar-brand span {
            color: var(--accent-green);
        }

        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 1.25rem !important;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            color: var(--accent-green) !important;
        }

        /* --- Buttons --- */
        .btn {
            border-radius: 99px;
            /* Pill shape untuk kesan modern */
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-accent {
            background-color: var(--accent-green);
            color: white;
            border: none;
            box-shadow: 0 4px 14px rgba(20, 184, 166, 0.25);
        }

        .btn-accent:hover {
            background-color: var(--accent-green-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(20, 184, 166, 0.35);
        }

        .btn-outline-dark-modern {
            border: 2px solid #E2E8F0;
            color: var(--primary-deep);
            background: white;
        }

        .btn-outline-dark-modern:hover {
            background-color: var(--body-bg);
            border-color: #CBD5E1;
            transform: translateY(-2px);
        }

        /* --- Hero Section --- */
        .hero-section {
            padding: 160px 0 100px 0;
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top right, rgba(20, 184, 166, 0.08) 0%, rgba(248, 250, 252, 0) 50%);
        }

        .hero-tagline {
            color: var(--accent-green);
            background-color: var(--accent-light);
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.25rem;
            border-radius: 99px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            color: var(--primary-deep);
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 4rem);
            /* Responsive typography */
            line-height: 1.15;
            letter-spacing: -0.04em;
            margin-bottom: 1.5rem;
        }

        .hero-desc {
            color: var(--text-muted);
            font-size: 1.15rem;
            line-height: 1.7;
            max-width: 550px;
            margin-bottom: 2.5rem;
        }

        .hero-image-wrapper {
            position: relative;
            z-index: 1;
        }

        .hero-image-wrapper::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--accent-green);
            border-radius: 2rem;
            top: 20px;
            left: -20px;
            z-index: -1;
            opacity: 0.1;
        }

        /* --- Services Card Modern --- */
        .services-section {
            padding: 100px 0;
        }

        .section-title {
            color: var(--primary-deep);
            font-weight: 800;
            font-size: 2.5rem;
            letter-spacing: -0.03em;
        }

        .modern-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.04);
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .modern-card:hover {
            border-color: rgba(20, 184, 166, 0.3);
            box-shadow: 0 20px 40px rgba(20, 184, 166, 0.08);
            transform: translateY(-8px);
        }

        .card-icon-circle {
            width: 64px;
            height: 64px;
            background-color: var(--accent-light);
            color: var(--accent-green);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            margin-bottom: 1.5rem;
            transition: 0.3s;
        }

        .modern-card:hover .card-icon-circle {
            background-color: var(--accent-green);
            color: white;
            transform: scale(1.05);
        }

        .modern-card h3 {
            color: var(--primary-deep);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .modern-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* --- GAYA KHUSUS KARTU DOKTER --- */
        .doctor-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
            position: relative;
            margin-top: 80px;
            /* Ruang untuk foto yang keluar ke atas */
            border-bottom: 5px solid transparent;
            transition: all 0.3s ease;
        }

        .doctor-card:hover {
            transform: translateY(-10px);
            border-bottom: 5px solid #14b8a6;
            box-shadow: 0 20px 40px rgba(20, 184, 166, 0.1);
        }

        .doctor-img-wrapper {
            position: absolute;
            top: -70px;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: #ffffff;
            border: 4px solid #14b8a6;
            /* Lingkaran Toska */
            padding: 4px;
        }

        .doctor-img-wrapper img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .source-badge {
            background: #1e293b;
            color: #f8fafc;
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        .doctor-info {
            margin-top: 70px;
            /* Dorong teks ke bawah foto */
        }

        .doctor-name {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .doctor-sub {
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 15px;
        }

        .doctor-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            font-weight: 500;
            color: #334155;
            padding: 15px 0;
            margin-top: 15px;
            border-top: 1px dashed #e2e8f0;
        }

        .btn-lihat-jadwal {
            background: #14b8a6;
            color: white;
            font-weight: 700;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            border: none;
            transition: 0.3s;
        }

        .btn-lihat-jadwal:hover {
            background: #0d9488;
            color: white;
        }

        /* --- GAYA KHUSUS KARTU DOKTER --- */
        .doctor-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
            position: relative;
            margin-top: 80px;
            /* Ruang untuk foto yang keluar ke atas */
            border-bottom: 5px solid transparent;
            transition: all 0.3s ease;
        }

        .doctor-card:hover {
            transform: translateY(-10px);
            border-bottom: 5px solid #14b8a6;
            box-shadow: 0 20px 40px rgba(20, 184, 166, 0.1);
        }

        .doctor-img-wrapper {
            position: absolute;
            top: -70px;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: #ffffff;
            border: 4px solid #14b8a6;
            /* Lingkaran Toska */
            padding: 4px;
        }

        .doctor-img-wrapper img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .source-badge {
            background: #1e293b;
            color: #f8fafc;
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        .doctor-info {
            margin-top: 70px;
            /* Dorong teks ke bawah foto */
        }

        .doctor-name {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .doctor-sub {
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 15px;
        }

        .doctor-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            font-weight: 500;
            color: #334155;
            padding: 15px 0;
            margin-top: 15px;
            border-top: 1px dashed #e2e8f0;
        }

        .btn-lihat-jadwal {
            background: #14b8a6;
            color: white;
            font-weight: 700;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            border: none;
            transition: 0.3s;
        }

        .btn-lihat-jadwal:hover {
            background: #0d9488;
            color: white;
        }

        /* --- GAYA KHUSUS KARTU FASILITAS --- */
        .fasilitas-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .fasilitas-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(20, 184, 166, 0.15);
            border-color: rgba(20, 184, 166, 0.3);
        }

        .fasilitas-img-wrapper {
            width: 100%;
            height: 220px;
            overflow: hidden;
            /* Mencegah gambar keluar kotak saat di-zoom */
        }

        .fasilitas-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
            /* Animasi mulus selama 0.6 detik */
        }

        .fasilitas-card:hover .fasilitas-img-wrapper img {
            transform: scale(1.1);
            /* Memperbesar gambar 10% saat di-hover */
        }

        .fasilitas-info {
            padding: 24px;
        }

        .fasilitas-badge {
            background: #F0FDFA;
            color: #14b8a6;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 12px;
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        /* --- GAYA KHUSUS SEKSI BANTUAN MODERN --- */
        #bantuan {
            /* Gradasi Halus agar tidak flat */
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            position: relative;
            overflow: hidden;
            /* Memberikan lengkungan modern di pojok seksi jika tidak full-width */
            border-radius: 30px;
            margin: 20px;
            /* Memberikan jarak dari pinggir layar */
        }

        /* Pola latar belakang samar (opsional, biar keren) */
        #bantuan::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6h-2c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4v2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.6;
        }

        /* Wadah Logo Headset di Atas Judul */
        .icon-headset-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.15);
            /* Glassmorphism effect */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            /* Tengah horizontal, jarak bawah 30px */
            font-size: 36px;
            color: #ffffff;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }

        /* Gaya Kartu Akses Cepat (FAQ) di Bawah Tombol */
        .quick-faq-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            padding: 20px;
            border: none;
            transition: all 0.3s ease;
            text-align: left;
            height: 100%;
            display: flex;
            align-items: center;
            text-decoration: none !important;
            /* Hapus underline link */
        }

        .quick-faq-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        .faq-icon-box-small {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(20, 184, 166, 0.1);
            color: #14b8a6;
            margin-right: 15px;
            font-size: 20px;
        }

        /* --- Footer --- */
        footer {
            background-color: white;
            border-top: 1px solid #E2E8F0;
            padding: 2.5rem 0;
            color: var(--text-muted);
        }

        .hover-teal {
            transition: color 0.3s ease;
        }

        .hover-teal:hover {
            color: #14b8a6 !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SIEM<span>PUS</span></a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i data-lucide="menu"></i>
            </button>
            <div class="d-none d-lg-flex gap-4 fw-semibold text-muted">
                <a href="#layanan" class="text-decoration-none text-muted hover-teal">Layanan</a>
                <a href="#dokter" class="text-decoration-none text-muted hover-teal">Dokter</a>
                <a href="#fasilitas" class="text-decoration-none text-muted hover-teal">Fasilitas</a>
                <a href="#bantuan" class="text-decoration-none text-muted hover-teal">Bantuan</a>
            </div>
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <a href="/login"
                    class="text-decoration-none text-muted small fw-semibold me-2 d-none d-lg-block hover-teal">Portal
                    Pegawai</a>

                <a href="/daftar" class="btn btn-outline-dark-modern btn-sm px-4 py-2">Daftar</a>
                <a href="/login-pasien" class="btn btn-accent btn-sm px-4 py-2">Masuk</a>
            </div>
        </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 fade-in-up">
                    <div class="hero-tagline">
                        <i data-lucide="shield-check" class="me-2" style="width: 16px; height: 16px;"></i>
                        Transformasi Digital Kesehatan
                    </div>
                    <h1 class="hero-title">Akses Kesehatan Puskesmas, Kini Lebih <span class="text-teal">Cepat.</span>
                    </h1>
                    <p class="hero-desc">
                        SIEMPUS memudahkan Anda mengambil antrean online dari rumah, pantau
                        estimasi waktu panggilan, dan lihat riwayat rekam medis Anda dalam satu genggaman.</p>
                    <div class="d-flex gap-3 flex-wrap mt-2">
                        <a href="/login-pasien" class="btn btn-accent btn-lg px-5 py-3 d-flex align-items-center">
                            Masuk & Ambil Antrean
                            <i data-lucide="arrow-right" class="ms-2" style="width: 20px; height: 20px;"></i>
                        </a>
                        <a href="/daftar" class="btn btn-outline-dark-modern btn-lg px-5 py-3">
                            Buat Akun Baru
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block fade-in-up delay-1">
                    <div class="hero-image-wrapper">
                        <img src="{{ asset('images/Logo_Puskesmas.jpg') }}" alt="Ilustrasi SIEMPUS"
                            class="img-fluid rounded-4 shadow-lg w-100 animasi-mengambang">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="layanan" class="py-5 bg-white" style="scroll-margin-top: 80px;">
        <div class="container fade-in-up delay-2">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title">Layanan Utama Digital</h2>
                <p class="text-muted mt-3 fs-5" style="max-width: 600px; margin: 0 auto;">Fasilitas utama yang bisa
                    Anda
                    akses langsung melalui sistem terpadu SIEMPUS.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="modern-card">
                        <div class="card-icon-circle">
                            <i data-lucide="smartphone" style="width: 28px; height: 28px;"></i>
                        </div>
                        <h3>Antrean Online</h3>
                        <p>Daftar dan ambil nomor antrean poliklinik dari rumah. Pantau status panggilan secara
                            real-time melalui HP Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="modern-card">
                        <div class="card-icon-circle">
                            <i data-lucide="folder-heart" style="width: 28px; height: 28px;"></i>
                        </div>
                        <h3>Rekam Medis</h3>
                        <p>Pendataan rekam medis yang terintegrasi, memudahkan dokter melihat riwayat kunjungan untuk
                            diagnosis yang tepat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="modern-card">
                        <div class="card-icon-circle">
                            <i data-lucide="pill" style="width: 28px; height: 28px;"></i>
                        </div>
                        <h3>E-Resep & Apotek</h3>
                        <p>Pengambilan resep obat digital yang mempercepat proses pelayanan dan mengurangi antrean di
                            bagian farmasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dokter" class="py-5" style="background-color: #F8FAFC; scroll-margin-top: 80px;">
        <div class="container py-5">
            <div class="mb-5 text-center">
                <h6 class="fw-bold text-uppercase text-dark mb-1" style="letter-spacing: 1px; font-size: 13px;">
                    TIM MEDIS UNGGULAN
                </h6>
                <h2 class="fw-800" style="color: #0F172A;">Dokter Profesional SIEMPUS</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="doctor-card">
                        <div class="doctor-img-wrapper shadow-sm">
                            <img src="{{ asset('images/dokter1.jpg') }}" alt="dr. Arief">
                        </div>
                        <div class="doctor-info">
                            <h4 class="doctor-name">dr. Naufal Dzaki</h4>
                            <p class="doctor-sub">(Gizi Klinik)</p>

                            <div class="text-start mt-4">
                                <p class="mb-0 text-muted" style="font-size: 0.9rem;">Poli Umum</p>
                                <div class="doctor-stats">
                                    <span>8 Tahun Pengalaman</span>
                                    <span><i class="bi bi-star-fill text-warning"></i> 5.0</span>
                                </div>
                            </div>
                            <button class="btn btn-lihat-jadwal">Lihat Jadwal</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="doctor-card">
                        <div class="doctor-img-wrapper shadow-sm">
                            <img src="{{ asset('images/dokter2.jpg') }}" alt="dr. Siti">
                        </div>
                        <div class="doctor-info">
                            <h4 class="doctor-name">dr. Arief Rahman, Sp.G.</h4>
                            <p class="doctor-sub">(Anak)</p>

                            <div class="text-start mt-4">
                                <p class="mb-0 text-muted" style="font-size: 0.9rem;">Poli KIA</p>
                                <div class="doctor-stats">
                                    <span>6 Tahun Pengalaman</span>
                                    <span><i class="bi bi-star-fill text-warning"></i> 4.9</span>
                                </div>
                            </div>
                            <button class="btn btn-lihat-jadwal">Lihat Jadwal</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="doctor-card">
                        <div class="doctor-img-wrapper shadow-sm">
                            <img src="{{ asset('images/dokter3.jpg') }}" alt="dr. Naufal">
                        </div>
                        <div class="doctor-info">
                            <h4 class="doctor-name">dr. Siti Aminah, Sp.A.</h4>
                            <p class="doctor-sub" style="opacity: 0;">(Gigi)</p>
                            <div class="text-start mt-4">
                                <p class="mb-0 text-muted" style="font-size: 0.9rem;">Poli Gigi</p>
                                <div class="doctor-stats">
                                    <span>10 Tahun Pengalaman</span>
                                    <span><i class="bi bi-star-fill text-warning"></i> 5.0</span>
                                </div>
                            </div>
                            <button class="btn btn-lihat-jadwal">Lihat Jadwal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="py-5 bg-white" style="scroll-margin-top: 80px;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="fw-bold text-uppercase text-teal mb-2" style="letter-spacing: 1px; font-size: 13px;">
                    FASILITAS KAMI</h6>
                <h2 class="fw-800 text-dark">Kenyamanan Pasien Prioritas Kami</h2>
                <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                    SIEMPUS dilengkapi dengan fasilitas fisik modern yang bersih dan nyaman untuk mendukung proses
                    penyembuhan Anda selama berada di Puskesmas.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="fasilitas-card">
                        <div class="fasilitas-img-wrapper">
                            <img src="{{ asset('images/fasilitas1.jpg') }}" alt="Ruang Tunggu">
                        </div>
                        <div class="fasilitas-info text-start">
                            <span class="fasilitas-badge"><i class="bi bi-wifi me-1"></i> Area Nyaman</span>
                            <h4 class="fw-bold mb-2">Ruang Tunggu Ber-AC</h4>
                            <p class="text-muted small mb-0">Ruang tunggu luas yang dilengkapi dengan pendingin
                                ruangan, layar monitor antrean real-time, dan tempat duduk ergonomis.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="fasilitas-card">
                        <div class="fasilitas-img-wrapper">
                            <img src="{{ asset('images/fasilitas2.jpg') }}" alt="Unit Farmasi">
                        </div>
                        <div class="fasilitas-info text-start">
                            <span class="fasilitas-badge"><i class="bi bi-capsule me-1"></i> Terintegrasi</span>
                            <h4 class="fw-bold mb-2">Apotek & Farmasi</h4>
                            <p class="text-muted small mb-0">Sistem pengambilan obat yang terhubung langsung dengan
                                E-Resep dokter, meminimalisir waktu antre di loket obat.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="fasilitas-card">
                        <div class="fasilitas-img-wrapper">
                            <img src="{{ asset('images/fasilitas3.jpg') }}" alt="Ruang Periksa">
                        </div>
                        <div class="fasilitas-info text-start">
                            <span class="fasilitas-badge"><i class="bi bi-heart-pulse me-1"></i> Steril</span>
                            <h4 class="fw-bold mb-2">Ruang Periksa Modern</h4>
                            <p class="text-muted small mb-0">Dilengkapi dengan alat medis standar nasional terkini yang
                                higienis untuk menjamin keakuratan diagnosa penyakit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="bantuan" class="py-5 shadow" style="scroll-margin-top: 80px;">
        <div class="container py-5 position-relative" style="z-index: 1;">

            <div class="text-center text-white mx-auto mb-5" style="max-width: 650px;">
                <div class="icon-headset-wrapper">
                    <i class="bi bi-headset"></i>
                </div>

                <h6 class="fw-bold text-uppercase text-white-50 mb-2" style="letter-spacing: 1px; font-size: 13px;">
                    Bantuan & FAQ</h6>
                <h2 class="fw-800 mb-3" style="letter-spacing: -1px;">Ada Kendala Pendaftaran Antrean?</h2>
                <p class="mb-4 fw-medium text-white-50" style="line-height: 1.7;">
                    Tim Customer Service SIEMPUS siap membantu Anda. Hubungi kami langsung atau jelajahi panduan cepat
                    di bawah untuk solusi instan masalah Anda.
                </p>
                <button class="btn btn-light rounded-pill px-4 py-2 fw-bold text-teal shadow-sm">
                    <i class="bi bi-chat-dots-fill me-2"></i> Hubungi CS SIEMPUS (WhatsApp)
                </button>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="quick-faq-card" data-bs-toggle="modal"
                        data-bs-target="#modalPanduan">
                        <div class="faq-icon-box-small">
                            <i class="bi bi-book"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Panduan Antrean</h6>
                            <small class="text-muted">Cara ambil nomor online</small>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="javascript:void(0)" class="quick-faq-card" data-bs-toggle="modal"
                        data-bs-target="#modalFaq">
                        <div class="faq-icon-box-small">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Pertanyaan Umum</h6>
                            <small class="text-muted">FAQ seputar layanan Poli</small>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="javascript:void(0)" class="quick-faq-card" data-bs-toggle="modal"
                        data-bs-target="#modalMasukan">
                        <div class="faq-icon-box-small">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Kirim Masukan</h6>
                            <small class="text-muted">Formulir keluhan & saran</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER MODERN ================= -->
    <!-- ================= FOOTER MODERN (CLEAN) ================= -->
    <footer class="bg-white border-top pt-5 pb-3" style="margin-top: 100px;">
        <div class="container">
            <div class="row g-4 mb-4">
                <!-- Kolom 1: Brand & Deskripsi -->
                <div class="col-lg-4 pe-lg-5">
                    <!-- Tampilan logo disamakan dengan Navbar (Tanpa ikon kotak) -->
                    <a class="navbar-brand d-inline-block mb-3" href="#">SIEM<span>PUS</span></a>
                    <p class="text-muted small mb-4" style="line-height: 1.7;">
                        Sistem Informasi Pelayanan Puskesmas terpadu. Memberikan kemudahan akses layanan kesehatan yang
                        cepat, transparan, dan terpercaya untuk masyarakat.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-light rounded-circle text-teal shadow-sm"><i
                                class="bi bi-whatsapp"></i></a>
                        <a href="#" class="btn btn-sm btn-light rounded-circle text-teal shadow-sm"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-light rounded-circle text-teal shadow-sm"><i
                                class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Kolom 2: Tautan Cepat -->
                <div class="col-lg-2 col-6">
                    <h6 class="fw-bold text-dark mb-3">Navigasi</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="#"
                                class="text-muted text-decoration-none hover-teal">Beranda</a></li>
                        <li class="mb-2"><a href="#layanan"
                                class="text-muted text-decoration-none hover-teal">Layanan Kami</a></li>
                        <li class="mb-2"><a href="#dokter" class="text-muted text-decoration-none hover-teal">Tim
                                Medis</a></li>
                        <li class="mb-2"><a href="#fasilitas"
                                class="text-muted text-decoration-none hover-teal">Fasilitas</a></li>
                        <li class="mb-0"><a href="#bantuan"
                                class="text-muted text-decoration-none hover-teal">Pusat Bantuan</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Layanan Medis -->
                <div class="col-lg-3 col-6">
                    <h6 class="fw-bold text-dark mb-3">Unit Layanan</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-teal">Poli
                                Umum</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-teal">Poli
                                Gigi</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-teal">Poli
                                KIA (Ibu & Anak)</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-teal">Unit
                                Farmasi (Apotek)</a></li>
                        <li class="mb-0"><a href="#"
                                class="text-muted text-decoration-none hover-teal">E-Rekam Medis</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Kontak & Alamat -->
                <div class="col-lg-3">
                    <h6 class="fw-bold text-dark mb-3">Hubungi Kami</h6>
                    <ul class="list-unstyled small mb-0 text-muted">
                        <li class="d-flex align-items-start mb-3">
                            <i class="bi bi-geo-alt-fill text-teal me-2 mt-1"></i>
                            <span>Jl. A.H. Nasution No. 105, Cibiru, Kota Bandung (Informatika UIN SGD)</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bi bi-telephone-fill text-teal me-2"></i>
                            <span>(022) 1234-5678</span>
                        </li>
                        <li class="d-flex align-items-center mb-0">
                            <i class="bi bi-envelope-fill text-teal me-2"></i>
                            <span>cs@siempus.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bagian Bawah / Copyright (Digabung ke tengah) -->
            <div class="row border-top pt-4">
                <div class="col-12 text-center">
                    <p class="text-muted small fw-medium mb-0">
                        &copy; {{ date('Y') }} <strong>SIEMPUS</strong>. Hak Cipta Dilindungi. Dikembangkan oleh
                        <strong>Kelompok 6 Rekayasa Perangkat Lunak</strong>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="modalPanduan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-book text-teal me-2"></i> Panduan Antrean Online</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-muted">
                    <ol class="mb-0">
                        <li class="mb-2">Klik tombol <strong>Daftar Pasien Baru</strong> jika belum memiliki
                            akun.</li>
                        <li class="mb-2">Login menggunakan email dan password yang telah didaftarkan.</li>
                        <li class="mb-2">Di Dashboard Pasien, pilih <strong>Poli Tujuan</strong>.</li>
                        <li class="mb-2">Klik <strong>Ambil Antrean</strong>. Nomor antrean Anda akan
                            otomatis tercetak di layar.</li>
                        <li>Datanglah ke Puskesmas saat status antrean Anda berubah menjadi "Dipanggil".</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFaq" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-question-circle text-teal me-2"></i> Pertanyaan yang
                        Sering Diajukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion accordion-flush" id="accordionFAQ">
                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Apakah layanan pendaftaran ini berbayar?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted small">Tidak. Pembuatan akun dan
                                    pengambilan antrean secara online di SIEMPUS 100% gratis.</div>
                            </div>
                        </div>
                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Kapan saya bisa mengambil antrean?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted small">Antrean bisa diambil pada hari H
                                    mulai pukul 06:00 WIB hingga kuota di Poli tujuan habis.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apakah nomor antrean perlu dicetak (print)?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted small">Tidak perlu. Anda cukup
                                    menunjukkan layar HP (Dashboard Pasien) kepada petugas di loket pendaftaran.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMasukan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-envelope text-teal me-2"></i> Kirim Masukan & Saran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-4">Masukan Anda sangat berarti untuk meningkatkan layanan
                        SIEMPUS Kelompok 6.</p>
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light border-0"
                                placeholder="Masukkan nama Anda">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Pesan / Saran</label>
                            <textarea class="form-control bg-light border-0" rows="4" placeholder="Ketik pesan Anda di sini..."></textarea>
                        </div>
                        <button type="button" class="btn btn-teal w-100 rounded-pill fw-bold"
                            data-bs-dismiss="modal"
                            onclick="alert('Terima kasih! Pesan Anda telah terkirim ke sistem kami.')">Kirim
                            Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
