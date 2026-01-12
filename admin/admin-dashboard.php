<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diskominfosantik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        :root { --sidebar-width: 280px; }
        body { background-color: #f1f5f9; }
        
        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #003366;
            color: white;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }
        .nav-admin-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            border-radius: 10px;
            margin: 4px 15px;
            transition: 0.3s;
        }
        .nav-admin-link:hover, .nav-admin-link.active {
            background: rgba(255,255,255,0.1);
            color: #FFB800;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
        }
        .stat-card {
            border: none;
            border-radius: 20px;
            transition: 0.3s;
        }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="p-4 d-flex align-items-center mb-3">
            <div class="logo-box bg-white text-primary me-2 fw-bold">DK</div>
            <span class="fw-bold h5 mb-0">Admin Panel</span>
        </div>
        
        <nav class="d-grid">
            <a href="#" class="nav-admin-link active"><i class="bi bi-speedometer2 me-3"></i> 1. Dashboard</a>
            <a href="manajemen-beranda.php" class="nav-admin-link"><i class="bi bi-house-gear me-3"></i> 2. Manajemen Beranda</a>
            <a href="tentang-kami-admin.php" class="nav-admin-link"><i class="bi bi-building me-3"></i> 3. Tentang Kami</a>
            <a href="layanan-admin.php" class="nav-admin-link"><i class="bi bi-grid-fill me-3"></i> 4. Manajemen Layanan</a>
            <a href="tambah-berita-admin.php" class="nav-admin-link"><i class="bi bi-newspaper me-3"></i> 5. Berita / Artikel</a>
            <a href="profil-pegawai-admin.php" class="nav-admin-link"><i class="bi bi-people me-3"></i> 6. Profil Tim / Pegawai</a>
            <a href="dokumen-admin.php" class="nav-admin-link"><i class="bi bi-file-earmark-arrow-down me-3"></i> 7. Dokumen / Download</a>
            <a href="pesan-admin.php" class="nav-admin-link"><i class="bi bi-chat-left-dots me-3"></i> 8. Pesan Masuk</a>
            <a href="galeri-admin.php" class="nav-admin-link"><i class="bi bi-images me-3"></i> 9. Manajemen Galeri</a>
            <a href="pengaturan-admin.php" class="nav-admin-link"><i class="bi bi-gear me-3"></i> 10. Pengaturan Web</a>
            <a href="user-admin.php" class="nav-admin-link"><i class="bi bi-person-lock me-3"></i> 11. Manajemen User</a>
            <div class="mt-4 px-3"><hr class="text-white opacity-25"></div>
            <a href="index.html" class="nav-admin-link text-danger fw-bold"><i class="bi bi-box-arrow-right me-3"></i> 12. Logout</a>
        </nav>
    </div>

    <div class="main-content text-start">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h3 class="fw-bold text-navy mb-1">Ringkasan Statistik</h3>
                <p class="text-muted small">Selamat datang kembali, Admin Diskominfosantik.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success bg-opacity-10 text-success p-2">Sistem Online</span>
                <img src="https://via.placeholder.com/40" class="rounded-circle shadow-sm border border-2 border-white">
            </div>
        </header>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary mb-0"><i class="bi bi-newspaper h4 mb-0"></i></div>
                        <span class="text-success small fw-bold">+12%</span>
                    </div>
                    <h6 class="text-muted fw-semibold">Jumlah Berita</h6>
                    <h2 class="fw-bold text-navy mb-0">(bayaknya jumlah berita)</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box bg-success bg-opacity-10 text-success mb-0"><i class="bi bi-grid h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Layanan Aktif</h6>
                    <h2 class="fw-bold text-navy mb-0">(bayaknya layanan  Aktif)</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning mb-0"><i class="bi bi-envelope h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Pesan Masuk</h6>
                    <h2 class="fw-bold text-navy mb-0">(Banyaknya Pesan Masuk)</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box bg-info bg-opacity-10 text-info mb-0"><i class="bi bi-people h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Total Pegawai</h6>
                    <h2 class="fw-bold text-navy mb-0">(Banyaknya total pegawai)</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-navy mb-0">Berita Terbit Terakhir</h5>
                        <a href="tambah-berita-admin.php" class="btn btn-navy-dark btn-sm rounded-pill px-3">+ Tambah Baru</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3">Judul Berita</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-3 fw-semibold">Peluncuran Smart City Bekasi</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">Teknologi</span></td>
                                    <td><span class="text-success small fw-bold"><i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Terbit</span></td>
                                    <td><button class="btn btn-light btn-sm"><i class="bi bi-pencil"></i></button></td>
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