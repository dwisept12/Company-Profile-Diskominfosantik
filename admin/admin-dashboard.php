<?php
session_start();
if ($_SESSION['status_login'] != true) {
    header("Location: login.php"); // Jika belum login, paksa ke halaman login
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diskominfosantik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h3 class="fw-bold text-navy mb-1">Ringkasan Statistik</h3>
                <p class="text-muted small">Selamat datang kembali, Admin Diskominfosantik.</p>
            </div>
        </header>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-primary mb-0" style="background-color: #f0f4ff !important;"><i class="bi bi-newspaper h4 mb-0"></i></div>
                        <span class="text-success small fw-bold">+12%</span>
                    </div>
                    <h6 class="text-muted fw-semibold">Jumlah Berita</h6>
                    <h2 class="fw-bold text-navy mb-0">(bayaknya jumlah berita)</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-success mb-0" style="background-color: #f0f4ff !important;"><i class="bi bi-grid h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Layanan Aktif</h6>
                    <h2 class="fw-bold text-navy mb-0">(bayaknya layanan  Aktif)</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-warning mb-0" style="background-color: #f0f4ff !important;"><i class="bi bi-envelope h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Pesan Masuk</h6>
                    <h2 class="fw-bold text-navy mb-0">(Banyaknya Pesan Masuk)</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-info mb-0" style="background-color: #f0f4ff !important;"><i class="bi bi-people h4 mb-0"></i></div>
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