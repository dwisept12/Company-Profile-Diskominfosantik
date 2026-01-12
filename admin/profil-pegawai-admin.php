<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Profil Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        :root { --sidebar-width: 280px; }
        body { background-color: #f1f5f9; }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #003366;
            color: white;
            z-index: 1000;
        }
        .main-content { margin-left: var(--sidebar-width); padding: 30px; }
        .nav-admin-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            border-radius: 10px;
            margin: 4px 15px;
        }
        .nav-admin-link.active { background: rgba(255,255,255,0.1); color: #FFB800; }
        .admin-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="p-4 d-flex align-items-center mb-3">
            <div class="logo-box bg-white text-primary me-2 fw-bold">DK</div>
            <span class="fw-bold h5 mb-0">Admin Panel</span>
        </div>
        <nav class="d-grid">
            <a href="admin-dashboard.php" class="nav-admin-link"><i class="bi bi-speedometer2 me-3"></i> 1. Dashboard</a>
            <a href="profil-pegawai-admin.php" class="nav-admin-link active"><i class="bi bi-people me-3"></i> 6. Profil Tim / Pegawai</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Profil Tim / Pegawai</h3>
                <p class="text-muted small">Kelola data pejabat dan staf Diskominfosantik Kabupaten Bekasi.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Pegawai Baru
            </button>
        </header>

        <div class="row g-4">
            <div class="col-12">
                <div class="card admin-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light text-navy">
                                <tr>
                                    <th class="ps-4 py-3">Foto & Nama</th>
                                    <th>Jabatan</th>
                                    <th>NIP</th>
                                    <th class="text-center">Urutan Tampil</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3 border shadow-sm">
                                            <span class="fw-bold">Dr. Ahmad Fauzi, M.Kom</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Kepala Dinas</span></td>
                                    <td>19800101XXXXXXXX</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahPegawai" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Input Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control rounded-3" placeholder="Contoh: Dr. Ahmad Fauzi, M.Kom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">NIP</label>
                            <input type="text" name="nip" class="form-control rounded-3" placeholder="Masukkan NIP 18 digit">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control rounded-3" placeholder="Contoh: Kepala Bidang TIK" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                            <small class="text-muted italic">Maksimal ukuran file 1MB.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Urutan Tampil (Prioritas)</label>
                            <input type="number" name="urutan" class="form-control rounded-3" value="1">
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-2 shadow">Simpan Data Pegawai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>