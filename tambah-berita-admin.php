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
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="logo-box me-2">DK</div>
                <div class="brand-text text-start">
                    <span class="fw-bold d-block h5 mb-0 text-navy">Panel Admin</span>
                    <small class="text-muted d-block kepanjangan-text">Manajemen Konten Berita</small>
                </div>
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 p-4">
                    <h4 class="fw-bold text-navy mb-4"><i class="bi bi-pencil-square me-2"></i>Tulis Berita Baru</h4>
                    
                    <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2" placeholder="Masukkan judul berita menarik..." required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="kategori" class="form-select rounded-3 py-2" required>
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Infrastruktur">Infrastruktur</option>
                                    <option value="Keamanan">Keamanan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gambar Utama (Thumbnail)</label>
                                <input type="file" name="gambar" class="form-control rounded-3 py-2" accept="image/*" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Isi Berita</label>
                            <textarea name="isi" class="form-control rounded-4" rows="10" placeholder="Tuliskan isi berita lengkap di sini..." required></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php" class="btn btn-light rounded-pill px-4">Batal</a>
                            <button type="submit" class="btn btn-navy-dark rounded-pill px-5 fw-bold text-white">Publikasikan Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>