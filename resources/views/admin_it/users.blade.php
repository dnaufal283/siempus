<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - SIEMPUS IT</title>
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

        /* Sidebar Styling */
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

        /* Main Content Styling */
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
                <a class="nav-link" href="{{ route('it.dashboard') }}">
                    <i class="fas fa-home me-2 w-20px text-center"></i> Dashboard
                </a>
                <!-- Menu ini sekarang yang ACTIVE -->
                <a class="nav-link active" href="/dashboard-it/users"><i
                        class="fas fa-users-cog me-2 w-20px text-center"></i>
                    Manajemen User</a>
                <a class="nav-link" href="/dashboard-it/poli"><i class="fas fa-hospital me-2 w-20px text-center"></i>
                    Data Master Poli</a>
                <a class="nav-link" href="/dashboard-it/dokter"><i class="fas fa-user-md me-2 w-20px text-center"></i>
                    Data Master Dokter</a>
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
            <!-- Topbar Mirip Admin Loket -->
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm border-bottom">
                <div class="d-flex align-items-center ps-3">
                    <h4 class="mb-0 fw-bold" style="letter-spacing: 0.5px;">
                        <span style="color: var(--siempus-teal);">SIE</span><span style="color: #1f2937;">MPUS</span>
                    </h4>
                    <span class="ms-3 text-secondary border-start border-2 ps-3 mt-1" style="font-size: 1.05rem;">
                        Panel Admin IT
                    </span>
                </div>
                <div class="d-flex align-items-center pe-3 gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'Admin IT' }}
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">Puskesmas Baleendah</div>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                        style="width: 40px; height: 40px; border: 2px solid var(--siempus-teal); color: var(--siempus-teal); background-color: #f0fdfa;">
                        IT
                    </div>
                    <form action="/logout" method="POST" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4 ms-2">
                            <i class="fas fa-sign-out-alt me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Area Konten Manajemen User -->
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="fas fa-users-cog me-2 text-secondary"></i> Data Pegawai
                        & Admin</h5>
                    <button class="btn btn-sm rounded-pill px-3 shadow-sm text-white"
                        style="background-color: var(--siempus-teal);" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                        <i class="fas fa-plus me-1"></i> Tambah Pegawai
                    </button>
                </div>

                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Role / Akses</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $u)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td class="fw-medium">{{ $u->name }}</td>
                                            <td class="text-muted">{{ $u->email }}</td>
                                            <td>
                                                @if ($u->role == 'it')
                                                    <span class="badge bg-dark">Admin IT</span>
                                                @elseif($u->role == 'dokter')
                                                    <span class="badge bg-primary">Dokter</span>
                                                @elseif($u->role == 'admin')
                                                    <span class="badge bg-info text-dark">Admin Loket</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($u->role) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $u->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('it.users.destroy', $u->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus akun {{ $u->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-pill px-3"><i
                                                            class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Pegawai (Dinamis per User) -->
                                        <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1"
                                            aria-labelledby="modalEditLabel{{ $u->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header text-white bg-warning">
                                                        <h5 class="modal-title text-dark fw-bold"
                                                            id="modalEditLabel{{ $u->id }}"><i
                                                                class="fas fa-user-edit me-2"></i>Edit Data Pegawai
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('it.users.update', $u->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Wajib ada untuk proses Update di Laravel -->
                                                        <div class="modal-body text-start">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-medium text-dark">Nama
                                                                    Lengkap</label>
                                                                <input type="text" name="name"
                                                                    class="form-control" value="{{ $u->name }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-medium text-dark">Alamat
                                                                    Email</label>
                                                                <input type="email" name="email"
                                                                    class="form-control" value="{{ $u->email }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-medium text-dark">Password
                                                                    Baru <small
                                                                        class="text-danger">(Opsional)</small></label>
                                                                <input type="password" name="password"
                                                                    class="form-control"
                                                                    placeholder="Kosongkan jika tidak ingin ganti password">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-medium text-dark">Role
                                                                    Akses</label>
                                                                <select name="role" class="form-select" required>
                                                                    <option value="admin"
                                                                        {{ $u->role == 'admin' ? 'selected' : '' }}>
                                                                        Admin Loket
                                                                    </option>
                                                                    <option value="dokter"
                                                                        {{ $u->role == 'dokter' ? 'selected' : '' }}>
                                                                        Dokter</option>
                                                                    <option value="apoteker"
                                                                        {{ $u->role == 'apoteker' ? 'selected' : '' }}>
                                                                        Apoteker
                                                                    </option>
                                                                    <option value="kepala"
                                                                        {{ $u->role == 'kepala' ? 'selected' : '' }}>
                                                                        Kepala Puskesmas
                                                                    </option>
                                                                    <option value="it"
                                                                        {{ $u->role == 'it' ? 'selected' : '' }}>Admin
                                                                        IT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-warning fw-bold">Update Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data
                                                pegawai.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white" style="background-color: var(--siempus-teal);">
                    <h5 class="modal-title" id="modalTambahLabel"><i class="fas fa-user-plus me-2"></i>Tambah Pegawai
                        Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('it.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="Contoh: Haikal">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Alamat Email</label>
                            <input type="email" name="email" class="form-control" required
                                placeholder="haikal@siempus.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Password Default</label>
                            <input type="password" name="password" class="form-control" required
                                placeholder="Minimal 6 karakter">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Role Akses</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin Loket</option>
                                <option value="dokter">Dokter</option>
                                <option value="apoteker">Apoteker</option>
                                <option value="kepala">Kepala Puskesmas</option>
                                <option value="it">Admin IT</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white"
                            style="background-color: var(--siempus-teal);">Simpan Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
