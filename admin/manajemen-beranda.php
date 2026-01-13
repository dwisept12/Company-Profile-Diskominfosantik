<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="mb-5">
            <h3 class="fw-bold text-navy mb-1">Manajemen Beranda</h3>
            <p class="text-muted small">Atur konten visual dan teks utama yang muncul di halaman depan portal.</p>
        </header>

        <form action="proses-beranda.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-12">
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
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-navy-dark rounded-pill py-3 fw-bold text-white shadow px-5">
                            <i class="bi bi-check2-circle me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
</body>
</html>