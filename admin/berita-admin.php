<?php
session_start();
if ($_SESSION['status_login'] != true) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Hubungkan ke database

// Ambil data berita, urutkan dari yang terbaru
$query = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);

// 1. HITUNG JUMLAH DATA
$jumlah_berita = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1 text-start">Manajemen Berita</h3>
                <p class="text-muted small text-start">Kelola semua konten berita Diskominfosantik di sini.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
                <i class="bi bi-plus-lg me-2"></i> Tambah Berita Baru
            </button>
        </header>

        <?php 
        // 2. CEK APAKAH ADA DATA?
        if ($jumlah_berita > 0) : 
        ?>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 fw-bold">Informasi Berita</th>
                                <th class="py-3 fw-bold">Tanggal Berita</th>
                                <th class="py-3 fw-bold">Kategori</th>
                                <th class="py-3 fw-bold">Status</th>
                                <th class="py-3 fw-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Reset pointer (opsional, untuk memastikan loop mulai dari awal)
                            mysqli_data_seek($result, 0);

                            // MULAI LOOPING DATA BERITA
                            while($row = mysqli_fetch_assoc($result)) : 
                                
                                // Cek Gambar (Jika kosong/rusak, pakai placeholder)
                                $gambar_path = "../assets/img/berita/" . $row['gambar'];
                                if ($row['gambar'] == "" || !file_exists($gambar_path)) {
                                    $gambar_tampil = "https://via.placeholder.com/100x60?text=No+Image";
                                } else {
                                    $gambar_tampil = $gambar_path;
                                }
                            ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $gambar_tampil; ?>" class="rounded-3 shadow-sm object-fit-cover me-3" width="60" height="40" alt="Thumb">
                                        <a href="../pengunjung/berita-detail.php?slug=<?php echo $row['slug']; ?>" target="_blank" class="fw-bold d-block text-truncate text-decoration-none text-navy" style="max-width: 300px;">
                                            <?php echo $row['judul']; ?> <i class="bi bi-box-arrow-up-right small text-muted ms-1" style="font-size: 10px;"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <small class="text-muted"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></small>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill">
                                        <?php echo $row['kategori']; ?>
                                    </span>
                                </td>
                                <td class="py-3">
                                    <?php if($row['status'] == 'publish') : ?>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Published</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-2 me-1" data-bs-toggle="modal" data-bs-target="#modalEditBerita<?php echo $row['id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-2" onclick="konfirmasiHapus(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars(addslashes($row['judul']), ENT_QUOTES); ?>')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditBerita<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                                        <div class="modal-header border-0 p-4 pb-0 text-start">
                                            <h5 class="modal-title fw-bold text-navy text-start">Edit Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start text-start">
                                            <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id_berita" value="<?php echo $row['id']; ?>"> 
                                                <input type="hidden" name="aksi" value="update">

                                                <div class="row text-start text-start">
                                                    <div class="col-lg-8 text-start">
                                                        <div class="mb-4 text-start">
                                                            <label class="form-label fw-bold text-navy text-start">Judul Berita</label>
                                                            <input type="text" name="judul" class="form-control rounded-3 py-2 text-start" value="<?php echo htmlspecialchars($row['judul']); ?>" required>
                                                        </div>
                                                        <div class="mb-4 text-start">
                                                            <label class="form-label fw-bold text-navy text-start">Isi Berita Lengkap</label>
                                                            <textarea name="isi" class="form-control rounded-4 text-start" rows="10" required><?php echo $row['isi']; ?></textarea>
                                                        </div>
                                                        <div class="mb-3 text-start">
                                                            <label class="form-label small fw-bold text-start">Penulis</label>
                                                            <input type="text" name="penulis" class="form-control rounded-3 py-2" value="<?php echo $row['penulis']; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 text-start">
                                                        <div class="card border-0 bg-light p-3 rounded-4 mb-3 text-start">
                                                            <h6 class="fw-bold text-navy mb-2 text-start"><i class="bi bi-image me-2 text-start"></i>Gambar Utama</h6>
                                                            <img src="<?php echo $gambar_tampil; ?>" class="img-fluid rounded-3 mb-2 shadow-sm text-start" alt="Preview">
                                                            
                                                            <label class="form-label small fw-bold text-start text-start">Ganti Gambar</label>
                                                            <input type="file" name="gambar" class="form-control form-control-sm rounded-3 text-start" accept="image/*">
                                                        </div>

                                                        <div class="card border-0 bg-light p-3 rounded-4 text-start">
                                                            <h6 class="fw-bold text-navy mb-2 text-start"><i class="bi bi-tags me-2 text-start"></i>Kategori & Status</h6>
                                                            
                                                            <div class="mb-2 text-start">
                                                                <label class="form-label small fw-bold text-start">Tanggal Tayang</label>
                                                                <input type="date" name="tanggal" class="form-control form-control-sm rounded-3" value="<?php echo date('Y-m-d', strtotime($row['tanggal'])); ?>">
                                                            </div>

                                                            <div class="mb-2 text-start">
                                                                <label class="form-label small fw-bold text-start">Kategori</label>
                                                                <select name="kategori" class="form-select form-select-sm rounded-3 text-start">
                                                                    <option value="Teknologi" <?php echo ($row['kategori'] == 'Teknologi') ? 'selected' : ''; ?>>Teknologi</option>
                                                                    <option value="Kegiatan" <?php echo ($row['kategori'] == 'Kegiatan') ? 'selected' : ''; ?>>Kegiatan</option>
                                                                    <option value="Pengumuman" <?php echo ($row['kategori'] == 'Pengumuman') ? 'selected' : ''; ?>>Pengumuman</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 text-start">
                                                                <label class="form-label small fw-bold text-start">Status</label>
                                                                <select name="status" class="form-select form-select-sm rounded-3 text-start text-start">
                                                                    <option value="1" <?php echo ($row['status'] == 'publish') ? 'selected' : ''; ?>>Terbitkan</option>
                                                                    <option value="0" <?php echo ($row['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 shadow">
                                                                Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            </tbody>
                    </table>
                </div>
            </div>

        <?php else : ?>
            
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-newspaper text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h6 class="text-muted fw-bold">Belum ada berita</h6>
                <p class="text-muted small">Silakan tambahkan berita baru melalui tombol di atas.</p>
            </div>

        <?php endif; ?>

    </div>

    <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0 text-start">
                    <h5 class="modal-title fw-bold text-navy text-start">Form Tambah Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small text-start">Judul Berita</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2 text-start" placeholder="Contoh: Peluncuran Layanan Baru" required>
                        </div>
                        <div class="row text-start">
                            <div class="col-md-6 mb-3 text-start">
                                <label class="form-label fw-semibold small text-start">Pilih Kategori</label>
                                <select name="kategori" class="form-select rounded-3 py-2 text-start">
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label class="form-label fw-semibold small text-start">Gambar Utama</label>
                                <input type="file" name="gambar" class="form-control rounded-3 py-2 text-start" accept="image/*" required>
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small text-start text-start">Isi Berita</label>
                            <textarea name="isi" class="form-control rounded-3 text-start" rows="6" placeholder="Tuliskan detail berita secara lengkap..."></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                <label class="form-label fw-semibold small text-start">Penulis</label>
                                <input type="text" name="penulis" class="form-control rounded-3 py-2 text-start" value="Admin Kominfo" required>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label class="form-label fw-semibold small text-start">Tanggal Tayang</label>
                                <input type="date" name="tanggal" class="form-control rounded-3 py-2 text-start" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="mb-4 text-start">
                            <label class="form-label fw-semibold small text-start">Status</label>
                            <select name="status" class="form-select rounded-3 py-2 text-start">
                                <option value="1">Terbitkan Langsung</option>
                                <option value="0">Simpan sebagai Draft</option>
                            </select>
                        </div>
                        <div class="d-grid text-start">
                            <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 shadow">Simpan Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    // FUNGSI KONFIRMASI HAPUS
    function konfirmasiHapus(id, judul) {
        Swal.fire({
            title: 'Hapus Berita?',
            text: "Berita '" + judul + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '15px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "proses-berita.php?aksi=hapus&id=" + id;
            }
        })
    }

    // FUNGSI MENANGKAP PESAN SUKSES/GAGAL DARI URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        let title, text, icon;

        if (status === 'sukses') {
            title = 'Berhasil!'; text = 'Data berita telah disimpan.'; icon = 'success';
        } else if (status === 'sukses_hapus') {
            title = 'Terhapus!'; text = 'Data berita berhasil dihapus.'; icon = 'success';
        } else if (status === 'gagal') {
            title = 'Gagal!'; text = decodeURIComponent(urlParams.get('msg')); icon = 'error';
        }

        if (title) {
            Swal.fire({ 
                title: title, 
                text: text, 
                icon: icon, 
                showConfirmButton: (icon === 'error'),
                confirmButtonColor: '#003366',
                timer: (icon === 'error') ? 0 : 2000 
            });
            window.history.replaceState(null, null, window.location.pathname);
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>