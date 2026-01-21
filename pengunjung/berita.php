<?php
// 1. Hubungkan ke Database
include '../admin/db.php'; 

// --- LOGIKA PAGINATION ---
$jumlahDataPerHalaman = 6; // Batasi 6 berita per halaman
$queryTotal = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM berita WHERE status = 'publish'");
$dataTotal = mysqli_fetch_assoc($queryTotal);
$totalBerita = $dataTotal['total'];
$jumlahHalaman = ceil($totalBerita / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// 2. Logika Pencarian
$keyword = "";
$condition = "WHERE status = 'publish'";

if (isset($_GET['search'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['search']);
    $condition .= " AND (judul LIKE '%$keyword%' OR isi LIKE '%$keyword%')";
    
    // Hitung ulang total untuk pencarian
    $queryTotalSearch = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM berita $condition");
    $dataTotalSearch = mysqli_fetch_assoc($queryTotalSearch);
    $jumlahHalaman = ceil($dataTotalSearch['total'] / $jumlahDataPerHalaman);
}

// 3. Ambil data berita dengan LIMIT 6
$query = "SELECT * FROM berita $condition ORDER BY tanggal DESC LIMIT $awalData, $jumlahDataPerHalaman";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Kegiatan - Diskominfosantik Kabupaten Bekasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div data-include="navbar.html"></div>

    <section class="py-5 bg-navy text-white text-center rounded-bottom-5">
        <div class="container py-5 text-center text-lg-start">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 fw-bold rounded-pill">Update Terkini</span>
                    <h1 class="display-5 fw-bold mb-3 text-white">Berita & Kegiatan</h1>
                    <p class="opacity-75 lead mb-0">Ikuti perkembangan transformasi digital dan informasi resmi pemerintah Kabupaten Bekasi.</p>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <form action="" method="GET">
                        <div class="input-group shadow-lg rounded-pill overflow-hidden">
                            <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 py-3" placeholder="Cari berita..." value="<?php echo $keyword; ?>">
                            <button type="submit" class="btn btn-warning px-4"><i class="bi bi-search text-white"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <?php 
                if (mysqli_num_rows($result) > 0) :
                    while ($row = mysqli_fetch_assoc($result)) : 
                        $gambar_path = "../assets/img/berita/" . $row['gambar'];
                        $gambar_tampil = (file_exists($gambar_path) && !empty($row['gambar'])) ? $gambar_path : "https://via.placeholder.com/400x250?text=No+Image";
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative">
                            <img src="<?php echo $gambar_tampil; ?>" class="card-img-top object-fit-cover" style="height: 200px;" alt="Thumbnail">
                            <span class="badge bg-warning position-absolute top-0 start-0 m-3 px-3 py-2 text-dark shadow-sm"><?php echo $row['kategori']; ?></span>
                        </div>
                        <div class="card-body p-4 text-start">
                            <div class="d-flex align-items-center mb-3 text-muted small">
                                <i class="bi bi-calendar3 text-primary me-2"></i> <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                            </div>
                            <h5 class="fw-bold text-navy mb-3 text-truncate-2"><?php echo $row['judul']; ?></h5>
                            <p class="text-muted small mb-4 lh-lg"><?php echo substr(strip_tags($row['isi']), 0, 100) . '...'; ?></p>
                            <a href="berita-detail.php?slug=<?php echo $row['slug']; ?>" class="btn btn-link text-navy p-0 fw-bold text-decoration-none">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <?php endwhile; else : ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Berita tidak ditemukan.</p>
                </div>
                <?php endif; ?>
            </div>

            <?php if($jumlahHalaman > 1) : ?>
            <nav class="mt-5 pt-4">
                <ul class="pagination justify-content-center">
                    <?php if($halamanAktif > 1) : ?>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 bg-light text-navy" href="?page=<?php echo $halamanAktif - 1; ?><?php echo isset($_GET['search']) ? '&search='.$_GET['search'] : ''; ?>"><i class="bi bi-chevron-left"></i></a></li>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <li class="page-item <?php echo ($i == $halamanAktif) ? 'active' : ''; ?>">
                            <a class="page-link rounded-circle mx-1 <?php echo ($i == $halamanAktif) ? 'bg-navy border-navy text-white shadow-sm' : 'border-0 text-navy'; ?>" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search='.$_GET['search'] : ''; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if($halamanAktif < $jumlahHalaman) : ?>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 text-navy" href="?page=<?php echo $halamanAktif + 1; ?><?php echo isset($_GET['search']) ? '&search='.$_GET['search'] : ''; ?>"><i class="bi bi-chevron-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </section>

    <div data-include="footer.html"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>