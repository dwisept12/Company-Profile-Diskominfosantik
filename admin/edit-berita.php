<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Edit Berita</h3>
                <p class="text-muted small">Perbarui informasi berita yang sudah diterbitkan.</p>
            </div>
            <a href="tambah-berita-admin.php" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </header>

        <div class="card border-0 shadow-lg rounded-4 p-4">
            <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_berita" value="1"> 
                <input type="hidden" name="aksi" value="update">

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-navy">Judul Berita</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2" value="Transformasi Digital Kabupaten Bekasi" required>
                        </div>
                        
                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold text-navy">Isi Berita Lengkap</label>
                            <textarea name="isi" class="form-control rounded-4" rows="12" required>Isi berita lama akan muncul di sini secara otomatis dari database...</textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 bg-light p-4 rounded-4 mb-4 text-start">
                            <h5 class="fw-bold text-navy mb-3"><i class="bi bi-image me-2"></i>Gambar Utama</h5>
                            <div class="mb-3">
                                <p class="small text-muted">Gambar saat ini:</p>
                                <img src="https://via.placeholder.com/400x250" class="img-fluid rounded-3 mb-3 shadow-sm" alt="Preview">
                                <label class="form-label small fw-bold">Ganti Gambar (Opsional)</label>
                                <input type="file" name="gambar" class="form-control rounded-3">
                                <small class="text-muted d-block mt-2 italic">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                            </div>
                        </div>

                        <div class="card border-0 bg-light p-4 rounded-4 text-start">
                            <h5 class="fw-bold text-navy mb-3"><i class="bi bi-tags me-2"></i>Kategori & Status</h5>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Kategori</label>
                                <select name="kategori" class="form-select rounded-3">
                                    <option value="Teknologi" selected>Teknologi</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="publish" selected>Terbitkan</option>
                                    <option value="draft">Simpan sebagai Draft</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-navy-dark w-100 rounded-pill py-3 fw-bold text-white shadow">
                                <i class="bi bi-check2-circle me-2"></i> Perbarui Berita
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>