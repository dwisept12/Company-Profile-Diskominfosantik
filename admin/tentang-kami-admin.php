<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Tentang Kami</title>
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
        .editor-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
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
            <a href="tentang-kami-admin.php" class="nav-admin-link active"><i class="bi bi-building me-3"></i> 3. Tentang Kami</a>
            <a href="layanan-admin.php" class="nav-admin-link"><i class="bi bi-grid-fill me-3"></i> 4. Manajemen Layanan</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5">
            <h3 class="fw-bold text-navy mb-1">Manajemen Tentang Kami</h3>
            <p class="text-muted small">Kelola profil instansi, visi misi, dan sejarah Diskominfosantik.</p>
        </header>

        <form action="proses-tentang.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                
                <div class="col-lg-7">
                    <div class="card editor-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-info-circle me-2"></i>Profil & Deskripsi</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Deskripsi Instansi</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="6">Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Bekasi memiliki peran penting dalam mengakselerasi transformasi digital...</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Sejarah Singkat</label>
                            <textarea name="sejarah" class="form-control rounded-3" rows="5" placeholder="Tuliskan sejarah berdirinya instansi..."></textarea>
                        </div>
                    </div>

                    <div class="card editor-card p-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-bullseye me-2"></i>Visi & Misi</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Teks Visi</label>
                            <input type="text" name="visi" class="form-control rounded-3" value="Mewujudkan Kabupaten Bekasi yang Makin Berani melalui Transformasi Digital.">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Teks Misi</label>
                            <textarea name="misi" class="form-control rounded-3" rows="5" placeholder="Gunakan baris baru untuk setiap poin misi..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card editor-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-image me-2"></i>Gambar Profil</h5>
                        <div class="mb-3 text-center">
                            <img src="https://via.placeholder.com/300x200" class="img-fluid rounded-4 mb-3 border shadow-sm">
                            <input type="file" name="gambar_tentang" class="form-control rounded-3">
                            <small class="text-muted mt-2 d-block">Unggah foto kantor atau kegiatan dinas.</small>
                        </div>
                    </div>

                    <div class="card editor-card p-4 bg-navy text-white">
                        <h5 class="fw-bold mb-4 text-gold">Nilai Perusahaan</h5>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Slogan / Core Values</label>
                            <input type="text" name="nilai" class="form-control bg-white bg-opacity-10 border-white border-opacity-25 text-white" value="Berani, Inovatif, Melayani.">
                        </div>
                        <button type="submit" class="btn btn-warning w-100 rounded-pill py-3 fw-bold text-white shadow-sm">
                            <i class="bi bi-save me-2"></i> Simpan Konten Tentang Kami
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>