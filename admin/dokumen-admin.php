<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Dokumen</title>
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
        .admin-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
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
            <a href="dokumen-admin.php" class="nav-admin-link active"><i class="bi bi-file-earmark-arrow-down me-3"></i> 7. Dokumen / Download</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen Dokumen / Download</h3>
                <p class="text-muted small">Kelola berkas publik, regulasi, dan laporan resmi.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalUploadDokumen">
                <i class="bi bi-cloud-upload-fill me-2"></i> Unggah Dokumen Baru
            </button>
        </header>

        <div class="row g-4">
            <div class="col-12">
                <div class="card admin-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light text-navy">
                                <tr>
                                    <th class="ps-4 py-3">Judul Dokumen</th>
                                    <th>Kategori</th>
                                    <th>Hak Akses</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger fs-4 me-3"></i>
                                            <span class="fw-bold">Rencana Strategis (RENSTRA) 2026</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">Laporan</span></td>
                                    <td><span class="small fw-semibold text-muted"><i class="bi bi-globe me-1"></i> Publik</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil-square"></i></button>
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

    <div class="modal fade" id="modalUploadDokumen" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Unggah File (PDF, DOC)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-dokumen.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control rounded-3" placeholder="Masukkan judul dokumen" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Pilih Berkas</label>
                            <input type="file" name="file_upload" class="form-control rounded-3" accept=".pdf,.doc,.docx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Hak Akses</label>
                            <select name="hak_akses" class="form-select rounded-3">
                                <option value="publik">Publik (Bisa diunduh umum)</option>
                                <option value="internal">Internal (Hanya admin)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-2 shadow">Unggah Dokumen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>