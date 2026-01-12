<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen User</title>
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
        .user-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="p-4 d-flex align-items-center mb-3">
            <div class="logo-box bg-white text-primary me-2 fw-bold">DK</div>
            <span class="fw-bold h5 mb-0">Admin Panel</span>
        </div>
        <nav class="d-grid text-start">
            <a href="admin-dashboard.php" class="nav-admin-link"><i class="bi bi-speedometer2 me-3"></i> 1. Dashboard</a>
            <a href="user-admin.php" class="nav-admin-link active"><i class="bi bi-person-lock me-3"></i> 11. Manajemen User</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen User (Admin)</h3>
                <p class="text-muted small">Kelola hak akses dan akun pengelola portal Diskominfosantik.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Admin Baru
            </button>
        </header>

        <div class="row g-4">
            <div class="col-12">
                <div class="card user-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 text-start">
                            <thead class="bg-light text-navy text-start">
                                <tr>
                                    <th class="ps-4 py-3">Username</th>
                                    <th>Role / Jabatan</th>
                                    <th>Status Akun</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-box bg-primary bg-opacity-10 text-primary me-3 mb-0" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                            <span class="fw-bold">superadmin_kominfo</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">Super Admin</span></td>
                                    <td><span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-light text-primary me-1" title="Edit Role"><i class="bi bi-shield-lock"></i></button>
                                        <button class="btn btn-sm btn-light text-warning me-1" title="Ganti Password"><i class="bi bi-key"></i></button>
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

    <div class="modal fade" id="modalTambahAdmin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 text-start">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Tambah Admin Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="proses-user.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Username</label>
                            <input type="text" name="username" class="form-control rounded-3" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Role Hak Akses</label>
                            <select name="role" class="form-select rounded-3">
                                <option value="admin">Admin (Terbatas)</option>
                                <option value="superadmin">Super Admin (Penuh)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Baru</label>
                            <input type="password" name="password" class="form-control rounded-3" placeholder="Minimal 8 karakter" required>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-2 shadow">Simpan User Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>