<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Dokumen Publik</title>
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
                    <small class="text-muted d-block kepanjangan-text">Manajemen Dokumen Publik</small>
                </div>
            </a>
            <div class="ms-auto">
                <a href="index.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3 mb-0">
                            <i class="bi bi-file-earmark-arrow-up h4 mb-0"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-navy mb-0">Unggah Dokumen Baru</h4>
                            <p class="text-muted small mb-0">Dokumen ini akan tampil di halaman Informasi Publik</p>
                        </div>
                    </div>

                    <form action="proses-simpan-dokumen.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen" class="form-control rounded-3 py-2" placeholder="Contoh: Rencana Strategis 2026" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="kategori" class="form-select rounded-3 py-2" required>
                                    <option value="">Pilih Kategori...</option>
                                    <option value="Profil">Dokumen Profil</option>
                                    <option value="Laporan">Laporan Kinerja</option>
                                    <option value="Regulasi">Regulasi/Aturan</option>
                                    <option value="Anggaran">Informasi Anggaran</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tahun Dokumen</label>
                                <input type="number" name="tahun" class="form-control rounded-3 py-2" value="2026" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Berkas (PDF Max 5MB)</label>
                            <input type="file" name="file_dokumen" class="form-control rounded-3 py-2" accept=".pdf,.doc,.docx" required>
                            <small class="text-muted italic">Hanya mendukung format PDF, DOC, atau DOCX</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-light rounded-pill px-4">Batal</button>
                            <button type="submit" class="btn btn-navy-dark rounded-pill px-5 fw-bold text-white">Simpan & Publikasikan</button>
                        </div>
                    </form>
                </div>

                <div class="mt-5">
                    <h5 class="fw-bold text-navy mb-3">Daftar Dokumen Terkini</h5>
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <table class="table align-middle mb-0">
                            <thead class="bg-white border-bottom">
                                <tr>
                                    <th class="ps-4">Nama Dokumen</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 fw-semibold">RENSTRA 2026</td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info">Profil</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>