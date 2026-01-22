<?php
// 1. Hubungkan ke Database
include 'db.php';

// 2. Ambil data dari tabel layanan (Urutkan dari yang terbaru)
$query = "SELECT * FROM layanan ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);

// 3. Hitung jumlah data
$jumlah_layanan = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen Layanan</h3>
                <p class="text-muted small">Tambah, edit, atau hapus layanan publik digital.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-2"></i> Tambah Layanan Baru
            </button>
        </div>

        <?php if ($jumlah_layanan > 0) : ?>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 fw-bold">No.</th>
                                <th class="py-3 fw-bold" style="min-width: 150px;">Nama Layanan</th>
                                <th class="py-3 fw-bold">Link Akses</th>
                                <th class="py-3 fw-bold">Deskripsi Singkat</th>
                                <th class="py-3 fw-bold">Status</th>
                                <th class="py-3 fw-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data_layanan = []; 
                            
                            // Reset pointer (opsional)
                            mysqli_data_seek($result, 0);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_layanan[] = $row; 
                            ?>
                            <tr>
                                <td class="ps-4 py-3"><span class="fw-bold"><?php echo $no++; ?></span></td>
                                
                                <td class="py-3">
                                    <span class="fw-bold"><?php echo $row['nama_layanan']; ?></span>
                                </td>

                                <td class="py-3">
                                    <a href="<?php echo $row['url']; ?>" target="_blank" class="text-primary text-decoration-none small fw-semibold" style="display: block; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo $row['url']; ?> <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 10px;"></i>
                                    </a>
                                </td>

                                <td class="py-3">
                                    <small class="text-muted">
                                        <?php 
                                        echo substr($row['deskripsi'], 0, 50) . '...'; 
                                        ?>
                                    </small>
                                </td>
                                <td class="py-3">
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 fw-bold">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 fw-bold">Non-Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-2 me-1" data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit<?php echo $row['id']; ?>" 
                                            title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-2" 
                                       onclick="konfirmasiHapus(<?php echo $row['id']; ?>, '<?php echo $row['nama_layanan']; ?>')"
                                       title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else : ?>
            
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-hdd-stack text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h6 class="text-muted fw-bold">Belum ada layanan</h6>
                <p class="text-muted small">Silakan tambahkan layanan baru melalui tombol di atas.</p>
            </div>

        <?php endif; ?>

    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Form Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="proses-layanan.php" method="POST">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control rounded-3" placeholder="Contoh: Pengaduan Online" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Link Akses</label>
                            <input type="url" name="url" class="form-control rounded-3" placeholder="https://...">
                        </div>
                        <div class="mb-4 text-start">
                            <label class="form-label small fw-bold">Status Tampil</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="1" selected>Aktif (Tampil)</option>
                                <option value="0">Non-Aktif (Sembunyikan)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 shadow">
                            Simpan Layanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // Pastikan $data_layanan sudah terisi, jika kosong (karena masuk blok else), loop ini tidak akan jalan dan tidak error
    if (!empty($data_layanan)) {
        foreach ($data_layanan as $row): 
    ?>
    <div class="modal fade" id="modalEdit<?php echo $row['id']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Form Edit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-layanan.php" method="POST">
                        <input type="hidden" name="id_layanan" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="aksi" value="update">

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control rounded-3" value="<?php echo $row['nama_layanan']; ?>" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-start">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control rounded-3 text-start" rows="3" required><?php echo $row['deskripsi']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Link Akses</label>
                            <input type="url" name="url" class="form-control rounded-3" value="<?php echo $row['url']; ?>">
                        </div>
                        <div class="mb-4 text-start">
                            <label class="form-label small fw-bold">Status Tampil</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="1" <?php echo ($row['status'] == 1) ? 'selected' : ''; ?>>Aktif (Tampil)</option>
                                <option value="0" <?php echo ($row['status'] == 0) ? 'selected' : ''; ?>>Non-Aktif (Sembunyikan)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 shadow">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; 
    } // End if !empty
    ?>

    <script>
    function konfirmasiHapus(id, nama) {
        Swal.fire({
            title: 'Hapus Layanan?',
            text: "Layanan '" + nama + "' akan dihapus permanen dari website.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366', // Warna Navy Anda
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '15px'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke backend dengan parameter aksi=hapus
                window.location.href = "proses-layanan.php?aksi=hapus&id=" + id;
            }
        })
        window.history.replaceState(null, null, window.location.pathname);
    }

    // Menampilkan Notifikasi Berhasil dari URL (Redirect dari proses-layanan.php)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        let title = '';
        let text = '';
        let icon = '';

        if (status === 'sukses_hapus') {
            title = 'Terhapus!';
            text = 'Layanan berhasil dihapus.';
            icon = 'success';
        } else if (status === 'sukses') {
            title = 'Berhasil!';
            text = 'Layanan telah disimpan.';
            icon = 'success';
        } else if (status === 'gagal') {
            const errorCode = urlParams.get('code'); 
            const errorMsg = decodeURIComponent(urlParams.get('msg'));
            title = 'Gagal Menyimpan!';
            // Tampilkan Kode Error agar terlihat keren dan informatif
            text = 'Error (' + errorCode + '): ' + errorMsg;
            icon = 'error';
        }
        if (title) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showConfirmButton: (icon === 'error'), // Jika error, munculkan tombol OK agar admin membaca
                confirmButtonColor: '#003366',
                timer: (icon === 'error') ? 0 : 2000 // Jika error, jangan pakai timer (biar tidak hilang sendiri)
            });
            window.history.replaceState(null, null, window.location.pathname);
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>