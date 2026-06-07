<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Dokter - SIEMPUS IT</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--siempus-teal-hover);
            color: #ffffff;
            font-weight: 500;
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
        <!-- Sidebar -->
        <div class="sidebar shadow-sm">
            <div class="p-4 text-center mb-3" style="background: rgba(0,0,0,0.05);">
                <h5 class="fw-bold mb-0 text-white"><i class="fas fa-server me-2"></i> PANEL IT</h5>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('it.dashboard') }}"><i
                        class="fas fa-home me-2 w-20px text-center"></i> Dashboard</a>
                <a class="nav-link" href="/dashboard-it/users"><i class="fas fa-users-cog me-2 w-20px text-center"></i>
                    Manajemen User</a>
                <a class="nav-link" href="/dashboard-it/poli"><i class="fas fa-hospital me-2 w-20px text-center"></i>
                    Data Master Poli</a>
                <a class="nav-link active" href="/dashboard-it/dokter"><i
                        class="fas fa-user-md me-2 w-20px text-center"></i> Data Master Dokter</a>
                <a class="nav-link {{ request()->is('dashboard-it/config*') ? 'active' : '' }}"
                    href="/dashboard-it/config">
                    <i class="fas fa-cogs me-2 w-20px text-center"></i> Konfigurasi Sistem
                </a>
                <a class="nav-link" href="/dashboard-it/backup"><i class="fas fa-database me-2 w-20px text-center"></i>
                    Backup Data</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">Panel
                        Admin IT</span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Admin IT' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Puskesmas Baleendah</div>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                        style="width: 40px; height: 40px; border: 2px solid var(--siempus-teal); color: var(--siempus-teal); background-color: #f0fdfa;">
                        IT</div>
                </div>
            </div>

            <!-- Area Konten Master Dokter -->
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="fas fa-user-md me-2 text-secondary"></i> Data Master
                        Dokter</h5>
                    <button class="btn btn-sm rounded-pill px-3 shadow-sm text-white"
                        style="background-color: var(--siempus-teal);" data-bs-toggle="modal"
                        data-bs-target="#modalTambahDokter">
                        <i class="fas fa-plus me-1"></i> Tambah Dokter
                    </button>
                </div>

                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="align-middle" style="height: 50px;">
                                        <th class="ps-4" width="5%">No</th>
                                        <th width="30%">Nama Dokter</th>
                                        <th width="25%">Poliklinik</th>
                                        <th width="20%">No. Telepon</th>
                                        <th class="text-center" width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dokters as $index => $d)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td class="fw-bold text-dark">{{ $d->nama_dokter }}</td>
                                            <td><span
                                                    class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">{{ $d->poli->nama_poli ?? 'Poli Tidak Ditemukan' }}</span>
                                            </td>
                                            <td class="text-muted">{{ $d->no_telp ?? '-' }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditDokter{{ $d->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('it.dokter.destroy', $d->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus Dokter {{ $d->nama_dokter }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Dokter -->
                                        <div class="modal fade" id="modalEditDokter{{ $d->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header text-white bg-warning">
                                                        <h5 class="modal-title text-dark fw-bold"><i
                                                                class="fas fa-edit me-2"></i>Edit Data Dokter</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('it.dokter.update', $d->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body text-start">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-medium text-dark">Nama
                                                                    Dokter</label>
                                                                <input type="text" name="nama_dokter"
                                                                    class="form-control"
                                                                    value="{{ $d->nama_dokter }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label fw-medium text-dark">Penempatan
                                                                    Poliklinik</label>
                                                                <select name="poli_id" class="form-select" required>
                                                                    @foreach ($polis as $p)
                                                                        <option value="{{ $p->id }}"
                                                                            {{ $d->poli_id == $p->id ? 'selected' : '' }}>
                                                                            {{ $p->nama_poli }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-medium text-dark">No.
                                                                    Telepon <small
                                                                        class="text-muted">(Opsional)</small></label>
                                                                <input type="text" name="no_telp"
                                                                    class="form-control" value="{{ $d->no_telp }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-warning fw-bold">Update Dokter</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data
                                                Master Dokter yang ditambahkan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Dokter -->
            <div class="modal fade" id="modalTambahDokter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header text-white" style="background-color: var(--siempus-teal);">
                            <h5 class="modal-title"><i class="fas fa-user-md me-2"></i>Tambah Dokter Baru</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('it.dokter.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nama Dokter</label>
                                    <input type="text" name="nama_dokter" class="form-control" required
                                        placeholder="Contoh: dr. Budi Santoso">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Penempatan Poliklinik</label>
                                    <select name="poli_id" class="form-select" required>
                                        <option value="">-- Pilih Poli --</option>
                                        @foreach ($polis as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">No. Telepon <small
                                            class="text-muted">(Opsional)</small></label>
                                    <input type="text" name="no_telp" class="form-control"
                                        placeholder="08123456789">
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn text-white"
                                    style="background-color: var(--siempus-teal);">Simpan Dokter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
