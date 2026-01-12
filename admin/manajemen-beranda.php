<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Beranda</title>
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
        .card-editor { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
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
            <a href="manajemen-beranda.php" class="nav-admin-link active"><i class="bi bi-house-gear me-3"></i> 2. Manajemen Beranda</a>
            <a href="layanan-admin.php" class="nav-admin-link"><i class="bi bi-grid-fill me-3"></i> 4. Manajemen Layanan</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5">
            <h3 class="fw-bold text-navy mb-1">Manajemen Beranda</h3>
            <p class="text-muted small">Atur konten visual dan teks utama yang muncul di halaman depan portal.</p>
        </header>

        <form action="proses-beranda.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                
                <div class="col-lg-8">
                    <div class="card card-editor p-4 mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary me-3"><i class="bi bi-window-fullscreen"></i></div>
                            <h5 class="fw-bold text-navy mb-0">Hero Section (Sambutan Utama)</h5>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Judul Utama (Headline)</label>
                            <input type="text" name="headline" class="form-control rounded-3" value="Selamat Datang di Portal Resmi Diskominfosantik">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Sub-Headline (Deskripsi)</label>
                            <textarea name="subheadline" class="form-control rounded-3" rows="3">Mewujudkan Kabupaten Bekasi yang Makin Berani melalui transformasi digital yang inklusif.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Ganti Gambar Latar (Background)</label>
                            <input type="file" name="hero_bg" class="form-control rounded-3">
                            <div class="form-text">Rekomendasi ukuran: 1920x1080px.</div>
                        </div>
                    </div>

                    <div class="card card-editor p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-warning bg-opacity-10 text-warning me-3"><i class="bi bi-megaphone"></i></div>
                            <h5 class="fw-bold text-navy mb-0">Informasi Berjalan (Running Text)</h5>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Pesan Pengumuman</label>
                            <input type="text" name="running_text" class="form-control rounded-3" placeholder="Contoh: Jadwal pemeliharaan server pada tanggal 15 Januari...">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-editor p-4 h-100">
                        <h5 class="fw-bold text-navy mb-4">Statistik Beranda</h5>
                        <div class="mb-3 p-3 bg-light rounded-4">
                            <label class="form-label small fw-bold">Jumlah Penduduk</label>
                            <input type="number" name="stat_penduduk" class="form-control border-0 bg-white" value="3113017">
                        </div>
                        <div class="mb-3 p-3 bg-light rounded-4">
                            <label class="form-label small fw-bold">Luas Wilayah (Km²)</label>
                            <input type="number" name="stat_luas" class="form-control border-0 bg-white" value="127388">
                        </div>
                        <div class="mb-3 p-3 bg-light rounded-4">
                            <label class="form-label small fw-bold">Jumlah Kecamatan</label>
                            <input type="number" name="stat_kecamatan" class="form-control border-0 bg-white" value="23">
                        </div>
                        <div class="mt-auto">
                            <button type="submit" class="btn btn-navy-dark w-100 rounded-pill py-3 fw-bold text-white shadow">
                                <i class="bi bi-check2-circle me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>