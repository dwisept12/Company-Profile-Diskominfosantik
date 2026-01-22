<?php
// Hubungkan ke database
include '../admin/db.php'; 

// Ambil data layanan aktif
$query = "SELECT * FROM layanan WHERE status = 1 ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Digital - Diskominfosantik Kabupaten Bekasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <div data-include="navbar.html"></div>

    <section class="py-5 bg-navy text-white rounded-bottom-5">
        <div class="container py-5 text-center">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 fw-bold rounded-pill shadow-sm">Portal Layanan</span>
            <h1 class="display-5 fw-bold mb-3">Layanan Digital Terpadu</h1>
            <p class="opacity-75 lead mx-auto" style="max-width: 700px;">
                Akses berbagai fasilitas dan layanan informasi digital yang disediakan oleh Diskominfosantik Kabupaten Bekasi dalam satu pintu.
            </p>
        </div>
    </section>

    <section class="py-3">
        <div class="container py-4">
            <div class="row g-4 justify-content-center">
                
                <?php 
                if(mysqli_num_rows($result) > 0) {
                    $no = 1; 
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                
                <div class="col-md-4 col-lg-3">
                    <div class="card service-card p-4 h-100 border-0 shadow-sm text-center">
                        
                        <div class="icon-box mb-4 mx-auto d-flex align-items-center justify-content-center" 
                             style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid #003366 !important; background-color: transparent !important; box-shadow: none !important;">
                            
                            <span class="fw-bold fs-3" style="color: #003366 !important;"><?php echo $no; ?></span>
                            
                        </div>

                        <h5 class="fw-bold text-navy mb-2"><?php echo $row['nama_layanan']; ?></h5>
                        
                        <p class="small text-muted mb-4">
                            <?php echo substr($row['deskripsi'], 0, 100) . '...'; ?>
                        </p>

                        <a href="<?php echo $row['url']; ?>" target="_blank" class="btn btn-link text-navy p-0 fw-bold text-decoration-none mt-auto">
                            Akses Layanan <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>

                <?php 
                    $no++; 
                    } 
                } else {
                ?>
                    <div class="col-12 text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-hdd-stack text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                        <h6 class="text-muted fw-bold">Belum ada layanan</h6>
                        <p class="text-muted small">Layanan digital akan segera tersedia.</p>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>