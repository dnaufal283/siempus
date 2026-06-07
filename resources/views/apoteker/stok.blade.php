<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Obat - Panel Farmasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --siempus-teal: #14b8a6;
            --siempus-teal-hover: #0d9488;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F4F7FE;
            color: #2B3674;
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

        .text-teal {
            color: var(--siempus-teal);
        }

        .bg-teal {
            background-color: var(--siempus-teal);
            color: white;
        }

        .card-custom {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table-custom thead th {
            background-color: #F8F9FA;
            color: #A3AED0;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: none;
            padding: 16px;
        }

        .table-custom tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #F4F7FE;
            font-weight: 500;
        }

        .table-custom tbody tr:hover {
            background-color: #F8FAFC;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mt-2 mb-2">
                <i class="bi bi-capsule-pill fs-1 text-white"></i>
                <h5 class="fw-bold mt-2 mb-0 text-white">PANEL<br>FARMASI</h5>
            </div>
            <nav class="nav flex-column mt-3">
                <a class="nav-link" href="/dashboard-apoteker"><i
                        class="bi bi-clipboard2-pulse me-2 fs-5 align-middle"></i> Dashboard Resep</a>
                <a class="nav-link active" href="/dashboard-apoteker/stok"><i
                        class="bi bi-box-seam me-2 fs-5 align-middle"></i> Stok Obat (Gudang)</a>
                <a class="nav-link" href="/dashboard-apoteker/riwayat"><i
                        class="bi bi-journal-check me-2 fs-5 align-middle"></i> Riwayat Pemberian</a>
            </nav>
        </div>

        <div class="content">
            <div
                class="bg-white p-3 shadow-sm border-bottom d-flex justify-content-between align-items-center mb-4 sticky-top">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1"
                        style="font-size: 1.05rem;">Manajemen Gudang Obat</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Apoteker' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Apoteker Penanggung Jawab</div>
                    </div>
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

                @if ($errors->any())
                    <div class="alert alert-danger rounded-4 border-0 shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-custom overflow-hidden shadow-sm">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-boxes text-teal me-2"></i>Daftar
                                Inventaris Obat</h5>
                            <p class="text-muted small mb-0">Kelola master data dan jumlah stok obat di apotek.</p>
                        </div>
                        <button class="btn bg-teal text-white fw-medium rounded-pill px-4 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#modalTambahObat">
                            <i class="bi bi-plus-lg me-2"></i>Tambah Obat Baru
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Kategori</th>
                                    <th>Sisa Stok</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semuaObat as $obat)
                                    <tr>
                                        <td class="ps-4">
                                            <span
                                                class="badge bg-light text-secondary border px-2 py-1">{{ $obat->kode_obat }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $obat->nama_obat }}</div>
                                        </td>
                                        <td>{{ $obat->kategori }}</td>
                                        <td>
                                            @if ($obat->stok <= 10)
                                                <span
                                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                                    {{ $obat->stok }} {{ $obat->satuan }} (Menipis)
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                    {{ $obat->stok }} {{ $obat->satuan }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditObat{{ $obat->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <a href="/dashboard-apoteker/stok/hapus/{{ $obat->id }}"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="return confirm('Yakin ingin menghapus obat ini? Data resep yang menggunakan obat ini mungkin akan terpengaruh.')">
                                                <i class="bi bi-trash3"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalEditObat{{ $obat->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="border-radius: 20px; border: none;">
                                                <div class="modal-header bg-light border-0"
                                                    style="border-radius: 20px 20px 0 0;">
                                                    <h5 class="modal-title fw-bold text-dark"><i
                                                            class="bi bi-pencil-square text-teal me-2"></i>Edit Data
                                                        Obat</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/dashboard-apoteker/stok/update/{{ $obat->id }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body p-4">
                                                        <div class="mb-3">
                                                            <label class="form-label small text-muted fw-bold">Nama
                                                                Obat</label>
                                                            <input type="text" name="nama_obat" class="form-control"
                                                                value="{{ $obat->nama_obat }}" required>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label small text-muted fw-bold">Kategori</label>
                                                                <select name="kategori" class="form-select" required>
                                                                    <option value="Tablet"
                                                                        {{ $obat->kategori == 'Tablet' ? 'selected' : '' }}>
                                                                        Tablet</option>
                                                                    <option value="Kapsul"
                                                                        {{ $obat->kategori == 'Kapsul' ? 'selected' : '' }}>
                                                                        Kapsul</option>
                                                                    <option value="Sirup"
                                                                        {{ $obat->kategori == 'Sirup' ? 'selected' : '' }}>
                                                                        Sirup</option>
                                                                    <option value="Salep"
                                                                        {{ $obat->kategori == 'Salep' ? 'selected' : '' }}>
                                                                        Salep</option>
                                                                    <option value="Injeksi"
                                                                        {{ $obat->kategori == 'Injeksi' ? 'selected' : '' }}>
                                                                        Injeksi</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label small text-muted fw-bold">Satuan</label>
                                                                <select name="satuan" class="form-select" required>
                                                                    <option value="Strip"
                                                                        {{ $obat->satuan == 'Strip' ? 'selected' : '' }}>
                                                                        Strip</option>
                                                                    <option value="Botol"
                                                                        {{ $obat->satuan == 'Botol' ? 'selected' : '' }}>
                                                                        Botol</option>
                                                                    <option value="Pcs"
                                                                        {{ $obat->satuan == 'Pcs' ? 'selected' : '' }}>
                                                                        Pcs</option>
                                                                    <option value="Tube"
                                                                        {{ $obat->satuan == 'Tube' ? 'selected' : '' }}>
                                                                        Tube</option>
                                                                    <option value="Ampul"
                                                                        {{ $obat->satuan == 'Ampul' ? 'selected' : '' }}>
                                                                        Ampul</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label small text-muted fw-bold">Jumlah
                                                                Stok Saat Ini</label>
                                                            <input type="number" name="stok" class="form-control"
                                                                value="{{ $obat->stok }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0 p-4 pt-0">
                                                        <button type="button" class="btn btn-light rounded-pill px-4"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit"
                                                            class="btn bg-teal text-white rounded-pill px-4 shadow-sm">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-inboxes fs-1 d-block mb-3 opacity-25"></i>
                                            Belum ada data obat di gudang. Silakan tambah obat baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <footer class="mt-4 pb-4 text-center text-muted">
                <p class="small mb-0 fw-medium">&copy; 2026 SIEMPUS System &bull; Informatics UIN Bandung</p>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="modalTambahObat" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header bg-teal text-white border-0" style="border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Obat Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="/dashboard-apoteker/stok/tambah" method="POST">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Kode Obat (Unik)</label>
                            <input type="text" name="kode_obat" class="form-control"
                                placeholder="Contoh: OBT-001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control"
                                placeholder="Contoh: Paracetamol 500mg" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label small text-muted fw-bold">Kategori</label>
                                <select name="kategori" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Sirup">Sirup</option>
                                    <option value="Salep">Salep</option>
                                    <option value="Injeksi">Injeksi</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted fw-bold">Satuan</label>
                                <select name="satuan" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Strip">Strip</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Tube">Tube</option>
                                    <option value="Ampul">Ampul</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Jumlah Stok Awal</label>
                            <input type="number" name="stok" class="form-control" placeholder="0"
                                min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 bg-light">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-teal text-white rounded-pill px-4 shadow-sm">Simpan ke
                            Gudang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
