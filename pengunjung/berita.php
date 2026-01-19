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
                    <h1 class="display-5 fw-bold mb-3">Berita & Kegiatan</h1>
                    <p class="opacity-75 lead mb-0">Ikuti perkembangan transformasi digital dan informasi resmi pemerintah Kabupaten Bekasi.</p>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="input-group shadow-lg rounded-pill overflow-hidden">
                        <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 py-3" placeholder="Cari berita..." id="search-input-berita" data-search="berita">
                        <button class="btn btn-warning px-4" id="search-button-berita"><i class="bi bi-search text-white"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="d-flex gap-2 mb-5 overflow-auto pb-2 flex-nowrap">
                <a href="#" class="btn btn-navy-dark rounded-pill px-4 shadow-sm">Semua</a>
                <a href="#" class="btn btn-outline-secondary rounded-pill px-4">Teknologi</a>
                <a href="#" class="btn btn-outline-secondary rounded-pill px-4">Kegiatan</a>
                <a href="#" class="btn btn-outline-secondary rounded-pill px-4">Infrastruktur</a>
                <a href="#" class="btn btn-outline-secondary rounded-pill px-4">Keamanan</a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative">
                            <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Thumbnail Berita">
                            <span class="badge bg-warning position-absolute top-0 start-0 m-3 px-3 py-2 text-dark shadow-sm">Teknologi</span>
                        </div>
                        <div class="card-body p-4 text-start">
                            <div class="d-flex align-items-center mb-3 text-muted small">
                                <i class="bi bi-calendar3 text-primary me-2"></i> 5 Jan 2026
                            </div>
                            <h5 class="fw-bold text-navy mb-3">Peluncuran Aplikasi Smart City Kabupaten Bekasi</h5>
                            <p class="text-muted small mb-4 lh-lg">Pemerintah Kabupaten Bekasi meluncurkan portal integrasi layanan publik guna mempercepat transformasi digital...</p>
                            <a href="berita-detail.php" class="btn btn-link text-navy p-0 fw-bold text-decoration-none">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative">
                            <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Thumbnail Berita">
                            <span class="badge bg-warning position-absolute top-0 start-0 m-3 px-3 py-2 text-dark shadow-sm">Kegiatan</span>
                        </div>
                        <div class="card-body p-4 text-start">
                            <div class="d-flex align-items-center mb-3 text-muted small">
                                <i class="bi bi-calendar3 text-primary me-2"></i> 3 Jan 2026
                            </div>
                            <h5 class="fw-bold text-navy mb-3">Sosialisasi SPBE di Lingkungan Pemda</h5>
                            <p class="text-muted small mb-4 lh-lg">Pelaksanaan sosialisasi sistem pemerintahan berbasis elektronik untuk seluruh OPD...</p>
                            <a href="berita-detail.php" class="btn btn-link text-navy p-0 fw-bold text-decoration-none">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="mt-5 pt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link rounded-circle mx-1 border-0 bg-light" href="#"><i class="bi bi-chevron-left"></i></a></li>
                    <li class="page-item active"><a class="page-link rounded-circle mx-1 bg-navy border-navy shadow-sm" href="#">1</a></li>
                    <li class="page-item"><a class="page-link rounded-circle mx-1 border-0" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 text-navy" href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>
    </section>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>