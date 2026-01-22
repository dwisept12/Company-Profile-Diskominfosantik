<?php
// 1. Hubungkan ke database (Mundur satu folder karena file ini ada di folder 'pengunjung')
include '../admin/db.php'; 

// 2. Cek apakah ada SLUG di URL?
if (isset($_GET['slug'])) {
    $slug = mysqli_real_escape_string($koneksi, $_GET['slug']);

    // 3. Ambil data berita berdasarkan SLUG dan pastikan statusnya 'publish'
    $query = "SELECT * FROM berita WHERE slug = '$slug' AND status = 'publish'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // 4. Jika berita tidak ditemukan
    if (!$data) {
        echo "<script>alert('Berita tidak ditemukan!'); window.location='index.php';</script>";
        exit();
    }
} else {
    // Jika tidak ada slug, kembalikan ke halaman depan
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['judul']; ?> - Diskominfosantik</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div data-include="navbar.html"></div>

    <article class="py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold text-navy mb-4"><?php echo $data['judul']; ?></h1>
                    
                    <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom flex-wrap">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle me-2 text-primary"></i>
                            <span class="small fw-semibold"><?php echo $data['penulis']; ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar3 me-2 text-primary"></i>
                            <span class="small">
                                <?php echo date('d F Y', strtotime($data['tanggal'])); ?>
                            </span>
                        </div>
                        <span class="badge bg-info text-white"><?php echo $data['kategori']; ?></span>
                    </div>

                    <?php 
                        $gambar_path = "../assets/img/berita/" . $data['gambar'];
                        
                        // Cek apakah file gambar ada
                        if ($data['gambar'] != "" && file_exists($gambar_path)) {
                            $img_src = $gambar_path;
                        } else {
                            // Gambar default jika file tidak ditemukan
                            $img_src = "https://via.placeholder.com/800x450?text=No+Image"; 
                        }
                    ?>
                    <img src="<?php echo $img_src; ?>" class="img-fluid rounded-4 mb-5 shadow-sm w-100" style="height: 450px; object-fit: cover;" alt="<?php echo $data['judul']; ?>">

                    <div class="article-body">
                        <div class="content-text" style="line-height: 1.8; color: #475569;">
                            <?php echo nl2br($data['isi']); ?>
                        </div>
                    </div>

                    <div class="mt-5">
                        <a href="index.php" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </article>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>