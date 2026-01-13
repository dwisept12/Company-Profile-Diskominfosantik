<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Data Pegawai</title>
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
                <h3 class="fw-bold text-navy mb-1">Edit Profil Pegawai</h3>
                <p class="text-muted small">Perbarui informasi jabatan, tugas, atau foto staf.</p>
            </div>
            <a href="profil-pegawai-admin.php" class="btn btn-outline-secondary rounded-pill px-4">Kembali</a>
        </header>

        <div class="card border-0 shadow-lg rounded-4 p-4">
            <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_pegawai" value="1">
                <input type="hidden" name="aksi" value="update">

                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-warning mb-3">Biodata Utama</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama & Gelar</label>
                            <input type="text" name="nama" class="form-control rounded-3" value="Dr. Ahmad Fauzi, M.Kom" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Foto Saat Ini</label>
                            <div class="mb-2">
                                <img src="../assets/img/images.jpg" class="rounded-3 border shadow-sm" style="width: 80px;">
                            </div>
                            <input type="file" name="foto" class="form-control rounded-3">
                            <small class="text-muted italic">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>
                    </div>

                    <div class="col-md-6 text-start">
                        <h6 class="fw-bold text-warning mb-3">Tugas & Pendidikan</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Bidang Tugas</label>
                            <textarea name="tugas" class="form-control rounded-3" rows="4">Rumusan kebijakan teknis pimpinan dinas...</textarea>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill py-3 fw-bold text-white shadow">
                            <i class="bi bi-save me-2"></i> Perbarui Data Pegawai
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>