<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="mb-5">
            <h3 class="fw-bold text-navy mb-1">Manajemen Tentang Kami</h3>
            <p class="text-muted small">Kelola profil instansi, visi misi, dan sejarah Diskominfosantik.</p>
        </header>

        <form action="proses-tentang.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card editor-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-image me-2"></i>Gambar Profil Instansi</h5>
                        <div class="mb-3 text-center">
                            <img src="https://via.placeholder.com/400x250" class="img-fluid rounded-4 mb-3 border shadow-sm" style="max-width: 400px;">
                            <input type="file" name="gambar_tentang" class="form-control rounded-3">
                            <small class="text-muted mt-2 d-block">Unggah foto kantor atau kegiatan dinas.</small>
                        </div>
                    </div>

                    <div class="card editor-card p-4 mb-4">
                        <h5 class="fw-bold text-navy mb-4"><i class="bi bi-info-circle me-2"></i>Profil & Deskripsi</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Deskripsi Instansi</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="6">Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Bekasi memiliki peran penting dalam mengakselerasi transformasi digital...</textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Sejarah Singkat</label>
                            <textarea name="sejarah" class="form-control rounded-3" rows="5" placeholder="Tuliskan sejarah berdirinya instansi..."></textarea>
                        </div>
                    </div>

                    <div class="card editor-card p-4 mb-4">
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

                    <button type="submit" class="btn btn-navy-dark rounded-pill py-3 fw-bold text-white shadow px-5">
                        <i class="bi bi-check2-circle me-2"></i> Simpan Konten Tentang Kami
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>