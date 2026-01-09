<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen - Diskominfosantik Kabupaten Bekasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div data-include="navbar.html"></div>

    <section class="py-5 bg-navy text-white text-center rounded-bottom-5">
        <div class="container py-5">
            <h1 class="display-5 fw-bold mb-3">DOKUMEN</h1>
            <p class="opacity-75 lead">Akses dokumen resmi, laporan, dan regulasi Diskominfosantik Kabupaten Bekasi</p>
            
            <div class="col-md-6 mx-auto mt-4">
                <div class="input-group shadow-lg rounded-pill overflow-hidden">
                    <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-0 py-3" placeholder="Cari dokumen (misal: RENSTRA, Anggaran)..." id="search-input-dokumen" data-search="dokumen">
                    <button class="btn btn-warning px-4" id="search-button-dokumen"><i class="bi bi-search text-white"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <h4 class="fw-bold text-navy mb-0">Daftar Dokumen Terbaru</h4>
                <div class="d-flex gap-2">
                    <select class="form-select border-0 bg-light rounded-pill px-4">
                        <option>Semua Kategori</option>
                        <option>Profil</option>
                        <option>Laporan</option>
                        <option>Regulasi</option>
                    </select>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-navy">Nama Dokumen</th>
                                <th class="py-3 text-navy">Kategori</th>
                                <th class="py-3 text-navy text-center">Tahun</th>
                                <th class="pe-4 py-3 text-navy text-end">Unduh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-danger bg-opacity-10 text-danger me-3 mb-0" style="width: 40px; height: 40px;">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block">Rencana Strategis (RENSTRA) 2024-2026</span>
                                            <small class="text-muted">Ukuran: 2.4 MB</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Dokumen Profil</span></td>
                                <td class="text-center fw-semibold">2026</td>
                                <td class="pe-4 text-end">
                                    <a href="#" class="btn btn-navy-dark btn-sm rounded-circle shadow-sm">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-success bg-opacity-10 text-success me-3 mb-0" style="width: 40px; height: 40px;">
                                            <i class="bi bi-file-earmark-spreadsheet"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block">Laporan Realisasi Anggaran Triwulan I</span>
                                            <small class="text-muted">Ukuran: 1.1 MB</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Anggaran</span></td>
                                <td class="text-center fw-semibold">2026</td>
                                <td class="pe-4 text-end">
                                    <a href="#" class="btn btn-navy-dark btn-sm rounded-circle shadow-sm">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-5 p-4 bg-light rounded-4 text-center">
                <p class="text-muted mb-0">Tidak menemukan dokumen yang Anda cari? Hubungi kami melalui <a href="#footer" class="fw-bold text-decoration-none text-navy">Layanan Pengaduan Online</a>.</p>
            </div>
        </div>
    </section>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>