<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pesan Masuk</title>
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
        .message-card { border: none; border-radius: 20px; transition: 0.3s; }
        .unread { border-left: 5px solid #FFB800 !important; background: #fff; }
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
            <a href="pesan-admin.php" class="nav-admin-link active"><i class="bi bi-chat-left-dots me-3"></i> 8. Pesan Masuk (Kontak)</a>
            <a href="index.html" class="nav-admin-link text-danger mt-5"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Pesan Masuk (Kontak Kami)</h3>
                <p class="text-muted small">Lihat dan tindak lanjuti aspirasi serta pertanyaan dari masyarakat.</p>
            </div>
            <div class="dropdown">
                <button class="btn btn-white shadow-sm dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                    Filter: Semua Pesan
                </button>
                <ul class="dropdown-menu border-0 shadow-lg">
                    <li><a class="dropdown-item" href="#">Belum Dibaca</a></li>
                    <li><a class="dropdown-item" href="#">Sudah Dibaca</a></li>
                </ul>
            </div>
        </header>

        <div class="row g-4">
            <div class="col-12">
                <div class="card message-card shadow-sm unread p-4 mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-2 fw-bold text-navy">
                            <i class="bi bi-person-circle me-2"></i> Budi Santoso
                        </div>
                        <div class="col-md-2 small text-muted">
                            <i class="bi bi-envelope me-1"></i> budi@email.com
                        </div>
                        <div class="col-md-5">
                            <span class="fw-semibold">Pertanyaan Layanan SPBE</span>
                            <p class="text-muted small mb-0 text-truncate">Mohon informasi mengenai prosedur pengajuan sertifikat elektronik untuk desa...</p>
                        </div>
                        <div class="col-md-1 small text-muted">
                            10:45 AM
                        </div>
                        <div class="col-md-2 text-end">
                            <button class="btn btn-sm btn-light text-primary" title="Tandai Sudah Dibaca"><i class="bi bi-check-all"></i></button>
                            <button class="btn btn-sm btn-light text-danger" title="Hapus Pesan"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card message-card shadow-sm p-4 opacity-75">
                    <div class="row align-items-center text-start">
                        <div class="col-md-2 fw-bold">
                            Anisa Putri
                        </div>
                        <div class="col-md-2 small">
                            anisa@email.com
                        </div>
                        <div class="col-md-5">
                            <span class="fw-semibold text-navy">Apresiasi Portal Baru</span>
                            <p class="text-muted small mb-0">Portal Diskominfosantik sekarang jauh lebih modern dan informatif, terima kasih!</p>
                        </div>
                        <div class="col-md-1 small">
                            Kemarin
                        </div>
                        <div class="col-md-2 text-end">
                            <span class="badge bg-secondary rounded-pill me-2">Dibaca</span>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>