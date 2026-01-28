<?php
include 'session-check.php';
include 'db.php'; // Hubungkan ke database

// 1. Hitung Jumlah Berita
$queryBerita = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM berita");
$dataBerita = mysqli_fetch_assoc($queryBerita);

// 2. Hitung Layanan Aktif
$queryLayanan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM layanan WHERE status = 1");
$dataLayanan = mysqli_fetch_assoc($queryLayanan);

// 3. PERUBAHAN: Hitung Jumlah Dokumen
$queryDokumen = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM dokumen");
$dataDokumen = mysqli_fetch_assoc($queryDokumen);

// 4. Hitung Total Pegawai
$queryPegawai = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pegawai");
$dataPegawai = mysqli_fetch_assoc($queryPegawai);

// 5. Ambil 5 Berita Terakhir untuk Tabel
$beritaTerbaru = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 5");
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
                <p class="text-muted small">Selamat datang kembali, <?php echo isset($_SESSION['a_global']) ? $_SESSION['a_global']->admin_name : 'Admin'; ?>.</p>
            </div>
        </header>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white border-0 rounded-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-primary mb-0" style="background-color: #f0f4ff !important;"><i class="bi bi-newspaper h4 mb-0"></i></div>
                        <span class="text-success small fw-bold">+Aktif</span>
                    </div>
                    <h6 class="text-muted fw-semibold">Jumlah Berita</h6>
                    <h2 class="fw-bold text-navy mb-0"><?php echo $dataBerita['total']; ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white border-0 rounded-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-success mb-0" style="background-color: #e8f5e9 !important;"><i class="bi bi-grid h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Layanan Aktif</h6>
                    <h2 class="fw-bold text-navy mb-0"><?php echo $dataLayanan['total']; ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white border-0 rounded-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-warning mb-0" style="background-color: #fff8e1 !important;"><i class="bi bi-file-earmark-text h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Total Dokumen</h6>
                    <h2 class="fw-bold text-navy mb-0"><?php echo $dataDokumen['total']; ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-4 bg-white border-0 rounded-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="icon-box text-info mb-0" style="background-color: #e0f7fa !important;"><i class="bi bi-people h4 mb-0"></i></div>
                    </div>
                    <h6 class="text-muted fw-semibold">Total Pegawai</h6>
                    <h2 class="fw-bold text-navy mb-0"><?php echo $dataPegawai['total']; ?></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-navy mb-0">Berita Terbit Terakhir</h5>
                        <a href="berita-admin.php" class="btn btn-navy-dark btn-sm justify-content-between rounded-pill px-3">
                            <i class="bi bi-plus-lg me-2"></i>Kelola Berita</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3">Judul Berita</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($beritaTerbaru) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($beritaTerbaru)): ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold text-navy"><?php echo substr($row['judul'], 0, 50); ?>...</td>
                                        <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill"><?php echo $row['kategori']; ?></span></td>
                                        <td><small class="text-muted"><?php echo tgl_indo($row['tanggal'], true); ?></small></td>
                                        <td>
                                            <?php if($row['status'] == 'publish'): ?>
                                                <span class="text-success small fw-bold"><i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Terbit</span>
                                            <?php else: ?>
                                                <span class="text-muted small fw-bold"><i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="berita-admin.php" class="btn btn-light btn-sm text-primary"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Belum ada data berita.</td>
                                    </tr>
                                <?php endif; ?>
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