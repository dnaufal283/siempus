<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien Master - SIEMPUS</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--siempus-teal-hover);
            color: #ffffff;
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
        <!-- Sidebar Loket -->
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white"><i class="bi bi-hospital me-2"></i> LOKET PUSKESMAS</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="/dashboard-admin"><i class="bi bi-display me-2 w-20px text-center"></i>
                    Dashboard Antrean</a>
                <a class="nav-link active" href="/dashboard-admin/pasien"><i
                        class="bi bi-people-fill me-2 w-20px text-center"></i> Data Pasien Master</a>
                <a class="nav-link" href="/dashboard-admin/laporan"><i
                        class="bi bi-file-earmark-text me-2 w-20px text-center"></i>
                    Laporan Harian</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom mb-4">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">Panel
                        Admin Loket</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                            {{ Auth::user()->name ?? 'Admin Loket' }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Puskesmas Baleendah</div>
                    </div>
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-light btn-sm rounded-circle border shadow-sm"
                            style="width: 40px; height: 40px;" title="Keluar">
                            <i class="bi bi-power text-danger fw-bold"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="container-fluid px-4 pb-5">
                @if (session('sukses'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm"
                        role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1 text-dark"><i class="bi bi-folder2-open me-2 text-secondary"></i> Data
                            Pasien Master</h4>
                        <p class="text-muted mb-0 small">Basis data seluruh pasien yang pernah terdaftar di sistem.</p>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4">
                    <div
                        class="card-header bg-white p-4 border-bottom d-flex justify-content-between align-items-center">
                        <form action="" method="GET" class="d-flex gap-2 w-50">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0 bg-light"
                                    placeholder="Cari Nama Pasien / NIK..." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn text-white fw-medium px-4 rounded-3"
                                style="background-color: var(--siempus-teal);">Cari</button>
                        </form>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3" width="5%">No</th>
                                        <th class="py-3" width="30%">Nama Lengkap</th>
                                        <th class="py-3" width="20%">NIK</th>
                                        <th class="py-3" width="20%">Tanggal Daftar</th>
                                        <th class="text-center py-3" width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pasiens as $index => $p)
                                        @php
                                            // LOGIKA BARU: Ambil NIK dari kolom nik, jika kosong ambil dari email
                                            $nikTampil = $p->nik ?: explode('@', $p->email)[0];
                                        @endphp
                                        <tr>
                                            <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                            <td class="fw-bold text-dark">{{ $p->name }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    {{ $nikTampil }}
                                                </span>
                                            </td>
                                            <td class="text-muted small">
                                                {{ $p->created_at->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary rounded-pill px-3 shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailPasien{{ $p->id }}">
                                                    <i class="bi bi-eye"></i> Detail
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditPasien{{ $p->id }}">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-folder-x fs-1 d-block mb-2 opacity-50"></i>
                                                Belum ada data pasien yang terdaftar.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALS -->
            @foreach ($pasiens as $p)
                @php
                    $nikTampilModal = $p->nik ?: explode('@', $p->email)[0];
                @endphp
                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetailPasien{{ $p->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header bg-light rounded-top-4 pb-3">
                                <h5 class="modal-title fw-bold text-dark"><i
                                        class="bi bi-person-vcard me-2 text-secondary"></i> Detail Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="text-center mb-4">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                        style="width: 80px; height: 80px; font-size: 2rem;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <h4 class="fw-bold mb-0">{{ $p->name }}</h4>
                                    <p class="text-muted mb-0">Terdaftar pada:
                                        {{ $p->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted" width="45%">Email / Username</td>
                                        <td class="fw-bold">: {{ $p->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">NIK</td>
                                        <td class="fw-bold">: {{ $nikTampilModal }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer border-0 p-3 pt-0">
                                <button type="button" class="btn btn-light border rounded-pill w-100 fw-medium"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEditPasien{{ $p->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header bg-light rounded-top-4 pb-3">
                                <h5 class="modal-title fw-bold text-dark"><i
                                        class="bi bi-pencil-square me-2 text-primary"></i> Edit Data Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/dashboard-admin/pasien/{{ $p->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Nama Lengkap Pasien</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $p->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Nomor Induk Kependudukan
                                            (NIK)</label>
                                        <input type="text" name="nik" class="form-control"
                                            value="{{ $nikTampilModal }}" placeholder="16 Digit NIK" maxlength="16">
                                    </div>
                                </div>
                                <div class="modal-footer bg-light border-0 rounded-bottom-4">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn text-white rounded-pill px-4"
                                        style="background-color: var(--siempus-teal);">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
