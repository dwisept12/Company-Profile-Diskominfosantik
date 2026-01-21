<?php
// 1. Hubungkan ke Database
include '../admin/db.php';

// 2. Logika Pencarian & Filter
$where_clauses = ["hak_akses = 'publik'"]; // Default: Hanya tampilkan dokumen publik

// Cek jika ada pencarian judul
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['q']);
    $where_clauses[] = "nama LIKE '%$keyword%'";
}

// Cek jika ada filter kategori
$kategori_pilih = isset($_GET['kategori']) ? $_GET['kategori'] : '';
if (!empty($kategori_pilih) && $kategori_pilih != 'Semua Kategori') {
    $kategori = mysqli_real_escape_string($koneksi, $kategori_pilih);
    $where_clauses[] = "kategori = '$kategori'";
}

// Gabungkan semua kondisi
$where_sql = implode(' AND ', $where_clauses);

// Query Database
$query = "SELECT * FROM dokumen WHERE $where_sql ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);

// Fungsi Format Ukuran File (Helper)
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) { $bytes = number_format($bytes / 1073741824, 2) . ' GB'; }
    elseif ($bytes >= 1048576) { $bytes = number_format($bytes / 1048576, 2) . ' MB'; }
    elseif ($bytes >= 1024) { $bytes = number_format($bytes / 1024, 2) . ' KB'; }
    elseif ($bytes > 1) { $bytes = $bytes . ' bytes'; }
    elseif ($bytes == 1) { $bytes = $bytes . ' byte'; }
    else { $bytes = '0 bytes'; }
    return $bytes;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen - Diskominfosantik Kabupaten Bekasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div data-include="navbar.html"></div>

    <section class="py-5 bg-navy text-white text-center rounded-bottom-5">
        <div class="container py-5">
            <h1 class="display-5 fw-bold mb-3">DOKUMEN</h1>
            <p class="opacity-75 lead">Akses dokumen resmi, laporan, dan regulasi Diskominfosantik Kabupaten Bekasi</p>
            
            <div class="col-md-6 mx-auto mt-4">
                <form action="" method="GET">
                    <div class="input-group shadow-lg rounded-pill overflow-hidden">
                        <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-0 py-3" placeholder="Cari dokumen (misal: RENSTRA, Anggaran)..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                        <button type="submit" class="btn btn-warning px-4"><i class="bi bi-search text-white"></i></button>
                    </div>
                    <?php if(!empty($kategori_pilih)): ?>
                        <input type="hidden" name="kategori" value="<?php echo $kategori_pilih; ?>">
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            
            <form action="" method="GET" id="formFilter">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                    <h4 class="fw-bold text-navy mb-0">Daftar Dokumen Terbaru</h4>
                    <div class="d-flex gap-2">
                        <?php if(isset($_GET['q'])): ?>
                            <input type="hidden" name="q" value="<?php echo $_GET['q']; ?>">
                        <?php endif; ?>

                        <select name="kategori" class="form-select border-0 bg-light rounded-pill px-4" onchange="document.getElementById('formFilter').submit();">
                            <option value="Semua Kategori">Semua Kategori</option>
                            <option value="Profil" <?php if($kategori_pilih == 'Profil') echo 'selected'; ?>>Profil</option>
                            <option value="Laporan" <?php if($kategori_pilih == 'Laporan') echo 'selected'; ?>>Laporan</option>
                            <option value="Peraturan" <?php if($kategori_pilih == 'Peraturan') echo 'selected'; ?>>Peraturan</option>
                            <option value="SK" <?php if($kategori_pilih == 'SK') echo 'selected'; ?>>SK</option>
                            <option value="Renstra" <?php if($kategori_pilih == 'Renstra') echo 'selected'; ?>>Renstra</option>
                        </select>
                    </div>
                </div>
            </form>

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
                            <?php if(mysqli_num_rows($result) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <?php 
                                        // 1. Cek Ekstensi untuk Ikon
                                        $ext = strtolower(pathinfo($row['nama_file'], PATHINFO_EXTENSION));
                                        $icon = "bi-file-earmark-text"; $color = "text-secondary";
                                        
                                        if(in_array($ext, ['pdf'])) { $icon = "bi-file-earmark-pdf-fill"; $color = "text-danger"; }
                                        elseif(in_array($ext, ['doc','docx'])) { $icon = "bi-file-earmark-word-fill"; $color = "text-primary"; }
                                        elseif(in_array($ext, ['xls','xlsx'])) { $icon = "bi-file-earmark-excel-fill"; $color = "text-success"; }
                                        elseif(in_array($ext, ['ppt','pptx'])) { $icon = "bi-file-earmark-ppt-fill"; $color = "text-warning"; }
                                        elseif(in_array($ext, ['zip','rar'])) { $icon = "bi-file-earmark-zip-fill"; $color = "text-dark"; }

                                        // 2. Hitung Ukuran File
                                        $file_path = "../assets/document/" . $row['nama_file'];
                                        $file_size = "File tidak ditemukan";
                                        if (file_exists($file_path)) {
                                            $file_size = formatSizeUnits(filesize($file_path));
                                        }
                                    ?>
                                    <tr>
                                        <td class="ps-4 py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box <?php echo $color; ?> me-3 mb-0 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px; background-color: #f0f4ff !important; border-radius: 8px; font-size: 1.2rem;">
                                                    <i class="bi <?php echo $icon; ?>"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-bold d-block text-navy"><?php echo $row['nama']; ?></span>
                                                    <small class="text-muted">Ukuran: <?php echo $file_size; ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill"><?php echo $row['kategori']; ?></span></td>
                                        <td class="text-center fw-semibold text-secondary"><?php echo $row['tahun']; ?></td>
                                        <td class="pe-4 text-end">
                                            <a href="../assets/document/<?php echo $row['nama_file']; ?>" target="_blank" class="btn btn-navy-dark btn-sm rounded-circle shadow-sm" title="Download">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="bi bi-folder2-open text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <p class="text-muted mt-3 mb-0">Belum ada dokumen yang tersedia untuk kategori ini.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-5 p-4 bg-light rounded-4 text-center">
                <p class="text-muted mb-0">Tidak menemukan dokumen yang Anda cari? Hubungi kami melalui <a href="#" class="fw-bold text-decoration-none text-navy">Layanan Pengaduan Online</a>.</p>
            </div>
        </div>
    </section>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>