<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pengaturan Website</title>
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
        .settings-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
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
            <a href="pengaturan-admin.php" class="nav-admin-link active"><i class="bi bi-gear me-3"></i> 10. Pengaturan Website</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5">
            <h3 class="fw-bold text-navy mb-1">Pengaturan Website</h3>
            <p class="text-muted small">Kelola identitas portal, logo, dan informasi kontak dinas.</p>
        </header>

        <form action="proses-pengaturan.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                
                <div class="col-lg-7">
                    <div class="card settings-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-info-square me-2"></i>Identitas Umum</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Website</label>
                            <input type="text" name="nama_website" class="form-control rounded-3" value="Diskominfosantik Kabupaten Bekasi">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Admin / Instansi</label>
                            <input type="email" name="email_admin" class="form-control rounded-3" value="diskominfosantik@bekasikab.go.id">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Alamat Kantor & Kontak</label>
                            <textarea name="alamat" class="form-control rounded-3" rows="3">Jl. Ahmad Yani No. 1, Komplek Perkantoran Pemkab Bekasi</textarea>
                        </div>
                    </div>

                    <div class="card settings-card p-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-share me-2"></i>Media Sosial</h5>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-facebook text-primary"></i></span>
                            <input type="text" name="facebook" class="form-control border-0 bg-light" placeholder="URL Facebook">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-instagram text-danger"></i></span>
                            <input type="text" name="instagram" class="form-control border-0 bg-light" placeholder="URL Instagram">
                        </div>
                        <div class="input-group mb-0">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-twitter-x text-dark"></i></span>
                            <input type="text" name="twitter" class="form-control border-0 bg-light" placeholder="URL Twitter/X">
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card settings-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-image me-2"></i>Logo & Favicon</h5>
                        <div class="mb-4 text-center p-3 bg-light rounded-4">
                            <div class="logo-box bg-navy text-white mx-auto mb-3 fw-bold" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">DK</div>
                            <label class="form-label small fw-bold d-block">Ganti Logo Utama</label>
                            <input type="file" name="logo" class="form-control rounded-3 shadow-sm">
                        </div>
                        <div class="mb-0 text-center p-3 bg-light rounded-4">
                            <i class="bi bi-app-indicator fs-2 text-navy mb-2 d-block"></i>
                            <label class="form-label small fw-bold d-block">Ganti Favicon</label>
                            <input type="file" name="favicon" class="form-control rounded-3 shadow-sm">
                        </div>
                    </div>

                    <div class="card settings-card p-4 bg-navy text-white shadow-lg">
                        <button type="submit" class="btn btn-warning w-100 rounded-pill py-3 fw-bold text-white shadow">
                            <i class="bi bi-save2-fill me-2"></i> Terapkan Pengaturan
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>