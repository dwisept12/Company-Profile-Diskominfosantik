<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen Layanan</h3>
                <p class="text-muted small">Tambah, edit, atau hapus layanan publik digital.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-2"></i> Tambah Layanan Baru
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <table class="table align-middle mb-0">
                <thead class="bg-white border-bottom text-navy">
                    <tr>
                        <th class="ps-4 py-3">Ikon</th>
                        <th>Nama Layanan</th>
                        <th>Deskripsi Singkat</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-0" style="width: 45px; height: 45px;">
                                <i class="bi bi-diagram-3-fill"></i>
                            </div>
                        </td>
                        <td><span class="fw-bold">SPBE</span></td>
                        <td><small class="text-muted">Sistem Pemerintahan Berbasis Elektronik...</small></td>
                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light text-primary me-2"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Form Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-layanan.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control rounded-3" placeholder="Contoh: Pengaduan Online" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Pilih Ikon (Bootstrap Icon Class)</label>
                            <input type="text" name="ikon" class="form-control rounded-3" placeholder="Contoh: bi-envelope-fill">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Link Akses</label>
                            <input type="url" name="url" class="form-control rounded-3" placeholder="https://...">
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-3">Simpan Layanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>