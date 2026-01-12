<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Berita</title>
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
            <a href="tambah-berita-admin.php" class="nav-admin-link active"><i class="bi bi-newspaper me-3"></i> 5. Berita / Artikel</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen Berita / Artikel</h3>
                <p class="text-muted small">Tulis dan publikasikan berita terbaru ke masyarakat.</p>
            </div>
            <a href="berita.php" class="btn btn-outline-navy rounded-pill px-4">
                <i class="bi bi-eye me-2"></i> Lihat Semua Berita
            </a>
        </header>

        <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                
                <div class="col-lg-8">
                    <div class="card editor-card p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-navy">Judul Berita</label>
                            <input type="text" name="judul" class="form-control form-control-lg rounded-3" placeholder="Masukkan judul berita yang informatif..." required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-navy">Isi Berita Lengkap</label>
                            <textarea name="isi_berita" class="form-control rounded-4" rows="12" placeholder="Tuliskan detail berita di sini..." required></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card editor-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-image me-2"></i>Gambar Utama</h5>
                        <div class="mb-3">
                            <input type="file" name="gambar_berita" class="form-control rounded-3" accept="image/*" required>
                            <small class="text-muted mt-2 d-block italic">Format: JPG, PNG, WEBP (Maks 2MB).</small>
                        </div>
                    </div>

                    <div class="card editor-card p-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-tags me-2"></i>Kategori & Status</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Pilih Kategori</label>
                            <select name="kategori" class="form-select rounded-3">
                                <option value="Teknologi">Teknologi</option>
                                <option value="Kegiatan">Kegiatan</option>
                                <option value="Keamanan">Keamanan Informasi</option>
                                <option value="Infrastruktur">Infrastruktur Digital</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Status Publikasi</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="publish" checked>
                                <label class="form-check-label">Langsung Terbitkan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="draft">
                                <label class="form-check-label">Simpan sebagai Draft</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill py-3 fw-bold text-white shadow-sm">
                            <i class="bi bi-cloud-arrow-up me-2"></i> Publikasikan Berita
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>