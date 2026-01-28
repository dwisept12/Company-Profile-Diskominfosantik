<?php
// 1. Hubungkan ke Database
include '../admin/db.php'; 

// 2. Ambil data Kepala Dinas
$queryKadin = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE jabatan LIKE 'Kepala Dinas' LIMIT 1");
$dataKadin  = mysqli_fetch_assoc($queryKadin);

// 3. Ambil data Layanan (HANYA 3 TERBARU)
$queryLayanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE status = 1 ORDER BY id DESC LIMIT 3");

// 4. Ambil Berita Terbaru (Berita ke-1) UNTUK HIGHLIGHT KIRI
$queryNewsMain = mysqli_query($koneksi, "SELECT * FROM berita WHERE status = 'publish' ORDER BY tanggal DESC LIMIT 1");
$newsMain      = mysqli_fetch_assoc($queryNewsMain);

// 5. Ambil Berita Lainnya (Berita ke 2, 3, 4) UNTUK LIST KANAN
$queryNewsList = mysqli_query($koneksi, "SELECT * FROM berita WHERE status = 'publish' ORDER BY tanggal DESC LIMIT 1, 3");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskominfosantik Kabupaten Bekasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css" />
    
    <style>
        .service-card { transition: none !important; }
        .service-card:hover { transform: none !important; }

        /* --- CSS KHUSUS BERITA UTAMA (HIGHLIGHT) --- */
        .news-card-main {
            position: relative;
            width: 100%;
            min-height: 450px; /* Tinggi agar terlihat Besar */
            height: 100%;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            align-items: flex-end; /* Posisi teks di bawah */
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease;
        }
        .news-card-main:hover {
            transform: translateY(-5px);
        }
        .news-overlay {
            width: 100%;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); /* Gradasi hitam ke transparan */
            color: white;
            z-index: 2;
        }
        .news-overlay a:hover {
            color: #ffc107 !important; /* Warna kuning saat hover judul */
        }
    </style>
</head>
<body>
    <div data-include="navbar.html"></div>

    <section class="hero-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <span class="badge rounded-pill bg-white text-primary mb-3 px-3 py-2">Portal Resmi Pemerintah Kabupaten Bekasi</span>
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di Portal Resmi <span class="text-gold">Diskominfosantik</span></h1>
            <p class="lead opacity-75 mb-4">Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Bekasi - Membangun tata kelola pemerintahan yang berbasis teknologi digital.</p>
            <div class="d-flex gap-3">
              <a href="layanan.php" class="btn btn-warning btn-lg px-4 rounded-pill fw-bold text-white">Jelajahi Layanan <i class="bi bi-arrow-right ms-2"></i></a>
              <a href="#" class="btn btn-outline-light btn-lg px-4 rounded-pill">Hubungi Kami</a>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1">
            <div class="hero-img-card text-center">
              <?php 
                if($dataKadin) {
                    $fotoKadin = (!empty($dataKadin['foto']) && file_exists("../assets/img/pegawai/".$dataKadin['foto'])) 
                                 ? "../assets/img/pegawai/".$dataKadin['foto'] : "../assets/img/default-user.png";
                    $namaKadin = $dataKadin['nama'];
                    $jabatanKadin = $dataKadin['jabatan'];
                } else {
                    $fotoKadin = "https://via.placeholder.com/300x400?text=Foto+Kadin";
                    $namaKadin = "Nama Kepala Dinas";
                    $jabatanKadin = "Kepala Dinas";
                }
              ?>
              <img src="<?php echo $fotoKadin; ?>" class="img-fluid rounded-4 mb-3 shadow-lg" style="aspect-ratio: 3/4; object-fit: cover;" alt="Kepala Dinas"/>
              <h5 class="mb-0 fw-bold"><?php echo $namaKadin; ?></h5>
              <small class="text-gold fw-bold"><?php echo $jabatanKadin; ?></small>
              <div class="mt-2"><span class="bg-warning d-inline-block rounded" style="width: 50px; height: 3px"></span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-3" style="margin-bottom: 0">
      <div class="container py-5">
        <div class="text-center mb-5">
          <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">Layanan Kami</span>
          <h2 class="display-6 fw-bold text-navy">Menu Layanan Digital</h2>
          <p class="text-muted">Akses layanan publik unggulan secara digital.</p>
        </div>

        <div class="row g-4 justify-content-center">
          <?php 
          $noLayanan = 1;
          while($rowL = mysqli_fetch_assoc($queryLayanan)): 
          ?>
          <div class="col-md-4">
            <div class="card service-card p-4 h-100 border-0 shadow-sm text-center">
                <div class="icon-box mb-4 mx-auto d-flex align-items-center justify-content-center" 
                     style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid #003366 !important; background-color: transparent !important; box-shadow: none !important;">
                    <span class="fw-bold fs-3" style="color: #003366 !important;"><?php echo $noLayanan++; ?></span>
                </div>
                <h5 class="fw-bold text-navy mb-2"><?php echo $rowL['nama_layanan']; ?></h5>
                <p class="small text-muted mb-4"><?php echo substr($rowL['deskripsi'], 0, 100) . '...'; ?></p>
                <a href="<?php echo $rowL['url']; ?>" target="_blank" class="btn btn-link text-navy p-0 fw-bold text-decoration-none mt-auto">
                    Akses Layanan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
          </div>
          <?php endwhile; ?>
        </div>

        <div class="text-center mt-5">
          <a href="layanan.php" class="btn btn-navy-dark rounded-pill px-5 py-3 fw-bold">Lihat Semua Layanan</a>
        </div>
      </div>
    </section>

    <section class="py-5 bg-light" style="margin-top: 20px">
      <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
          <div>
            <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2 mb-2">Berita & Update</span>
            <h2 class="fw-bold mb-0">Informasi Terkini</h2>
          </div>
          <a href="berita.php" class="text-primary text-decoration-none fw-bold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <div class="row g-4">
          
          <div class="col-lg-7">
            <?php if($newsMain): 
               $imgMain = (!empty($newsMain['gambar']) && file_exists("../assets/img/berita/".$newsMain['gambar'])) 
                          ? "../assets/img/berita/".$newsMain['gambar'] : "https://via.placeholder.com/800x400";
            ?>
            <div class="news-card-main shadow-sm" style="background-image: url('<?php echo $imgMain; ?>');">
              <div class="news-overlay">
                <span class="badge bg-warning text-dark mb-2 rounded-pill"><?php echo $newsMain['kategori']; ?></span>
                
                <h3 class="fw-bold mb-2">
                    <a href="berita-detail.php?slug=<?php echo $newsMain['slug']; ?>" class="text-white text-decoration-none stretched-link">
                        <?php echo $newsMain['judul']; ?>
                    </a>
                </h3>
                
                <p class="small opacity-75 mb-0">
                    <i class="bi bi-calendar-event me-2"></i> <?php echo tgl_indo($newsMain['tanggal']); ?>
                </p>
              </div>
            </div>
            <?php endif; ?>
          </div>

          <div class="col-lg-5">
            <?php while($newsSide = mysqli_fetch_assoc($queryNewsList)): 
                $imgSide = (!empty($newsSide['gambar']) && file_exists("../assets/img/berita/".$newsSide['gambar'])) 
                           ? "../assets/img/berita/".$newsSide['gambar'] : "https://via.placeholder.com/100";
            ?>
            <div class="card border-0 rounded-4 mb-3 shadow-sm p-3 hover-effect">
              <div class="row align-items-center g-0">
                <div class="col-4">
                  <div class="position-relative" style="padding-right: 15px;">
                    <img src="<?php echo $imgSide; ?>" class="rounded-3 w-100 object-fit-cover shadow-sm" style="height: 85px;" alt="Thumb"/>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card-body p-0">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-warning text-dark rounded-pill px-2 py-1" style="font-size: 0.65rem;">
                            <?php echo $newsSide['kategori']; ?>
                        </span>
                        <span class="mx-2 text-muted" style="font-size: 0.7rem;">•</span>
                        <small class="text-muted fw-semibold" style="font-size: 0.75rem;">
                            <?php echo tgl_indo($newsSide['tanggal'], true); ?>
                        </small>
                    </div>
                    <h6 class="fw-bold mb-0 lh-sm">
                        <a href="berita-detail.php?slug=<?php echo $newsSide['slug']; ?>" class="text-navy text-decoration-none stretched-link">
                            <?php echo $newsSide['judul']; ?>
                        </a>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </div>

        </div>
      </div>
    </section>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
  </body>
</html>