<?php
// 1. Hubungkan ke Database
include '../admin/db.php';

// 2. Ambil data pegawai diurutkan berdasarkan 'urutan'
$query = "SELECT * FROM pegawai ORDER BY urutan ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pegawai - Diskominfosantik Kabupaten Bekasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div data-include="navbar.html"></div>

    <section class="py-5 bg-navy text-white text-center rounded-bottom-5">
        <div class="container py-5">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 fw-bold rounded-pill">Sumber Daya Manusia</span>
            <h1 class="display-5 fw-bold mb-3">PROFIL PEGAWAI</h1>
            <p class="opacity-75 lead">Mengenal lebih dekat sumber daya manusia Diskominfosantik Kabupaten Bekasi</p>
        </div>
    </section>

    <section class="py-3">
        <div class="container">
            <div class="row g-4">
                <?php 
                // 3. Looping data Pegawai dari Database
                if (mysqli_num_rows($result) > 0) :
                    while ($row = mysqli_fetch_assoc($result)) : 
                        
                        // Cek Foto (Path relatif dari root ke assets)
                        $foto_path = "../assets/img/pegawai/" . $row['foto'];
                        $foto_tampil = (file_exists($foto_path) && !empty($row['foto'])) ? $foto_path : "https://via.placeholder.com/300x400?text=No+Photo";

                        // Decode JSON Pendidikan
                        $pendidikan_array = json_decode($row['riwayat_pendidikan'], true);
                ?>
                <div class="col-12 mb-4">
                    <div class="card p-4 p-md-5 border-0 rounded-4 shadow-sm h-100">
                        <div class="row g-4 g-lg-5 align-items-start">
                            
                            <div class="col-md-3 text-center">
                                <img src="<?php echo $foto_tampil; ?>" 
                                     class="img-fluid rounded-4 shadow" 
                                     style="width: 100%; object-fit: cover; aspect-ratio: 3/4; object-position: center top;" 
                                     alt="<?php echo $row['nama']; ?>">
                            </div>

                            <div class="col-md-9 text-start">
                                <h2 class="fw-bold text-navy mb-1 text-start"><?php echo $row['nama']; ?></h2>
                                <p class="text-warning fw-bold fs-5 mb-3 text-start"><?php echo $row['jabatan']; ?></p>
                                <hr class="opacity-25 my-4">

                                <div class="row g-4">
                                    <div class="col-md-6 text-start">
                                        <div class="mb-4 text-start">
                                            <label class="fw-bold text-navy d-block text-start">Nomor Induk Pegawai (NIP)</label>
                                            <p class="text-muted text-start"><?php echo !empty($row['nip']) ? $row['nip'] : '-'; ?></p>
                                        </div>

                                        <div class="mb-4 text-start">
                                            <label class="fw-bold text-navy d-block mb-1 text-start">Bidang Tugas</label>
                                            <p class="text-muted text-start">
                                                <?php echo $row['bidang_tugas']; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-start">
                                        <div class="mb-4 text-start">
                                            <label class="fw-bold text-navy d-block mb-2 text-start">Riwayat Pendidikan</label>
                                            <ul class="list-unstyled d-grid gap-2 text-start">
                                                <?php 
                                                if(!empty($pendidikan_array)) :
                                                    foreach($pendidikan_array as $edu) :
                                                ?>
                                                <li class="d-flex align-items-start text-muted text-start">
                                                    <i class="bi bi-mortarboard-fill text-warning me-2 mt-1"></i>
                                                    <div class="text-start">
                                                        <strong class="text-start"><?php echo $edu['jenjang'] . " " . $edu['jurusan']; ?> (<?php echo $edu['tahun']; ?>)</strong><br>
                                                        <small class="text-start"><?php echo $edu['kampus']; ?></small>
                                                    </div>
                                                </li>
                                                <?php 
                                                    endforeach; 
                                                else: 
                                                    echo "<li class='text-muted small text-start'>- Belum ada data riwayat pendidikan -</li>";
                                                endif; 
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    endwhile; 
                else: 
                ?>
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-people text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                    <h6 class="text-muted fw-bold">Belum ada data pegawai</h6>
                    <p class="text-muted small">Saat ini data pegawai belum tersedia untuk ditampilkan. Mohon cek kembali secara berkala.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>