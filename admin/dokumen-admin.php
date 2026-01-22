<?php
session_start();
if ($_SESSION['status_login'] != true) {
    header("Location: login.php");
    exit();
}
include 'db.php'; // Hubungkan database

// 1. Ambil data dulu di atas untuk dicek jumlahnya
$query = mysqli_query($koneksi, "SELECT * FROM dokumen ORDER BY id DESC");
$jumlah_data = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Dokumen</title>
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
                <h3 class="fw-bold text-navy mb-1">Manajemen Dokumen</h3>
                <p class="text-muted small">Kelola berkas publik, regulasi, dan laporan resmi.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalUploadDokumen">
                <i class="bi bi-cloud-upload-fill me-2"></i> Unggah Dokumen Baru
            </button>
        </header>

        <?php if ($jumlah_data > 0) : ?>
            
            <div class="card admin-card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive text-start">
                    <table class="table align-middle mb-0 text-start table-hover">
                        <thead class="bg-light text-navy text-start">
                            <tr>
                                <th class="ps-4 py-3 fw-bold text-start">Nama Dokumen</th>
                                <th class="py-3 fw-bold text-start">Kategori</th>
                                <th class="py-3 fw-bold text-start">Tahun</th>
                                <th class="py-3 fw-bold text-start">Hak Akses</th>
                                <th class="py-3 fw-bold text-center text-start">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-start">
                            <?php
                            // Reset pointer data ke awal karena sudah dihitung di atas
                            mysqli_data_seek($query, 0);
                            
                            while($data = mysqli_fetch_array($query)) {
                                // Tentukan Ikon berdasarkan Ekstensi
                                $ext = strtolower(pathinfo($data['nama_file'], PATHINFO_EXTENSION));

                                // Default (Jika file tidak dikenali, pakai ikon kertas biasa warna abu)
                                $icon = "bi-file-earmark-text-fill"; 
                                $color = "text-secondary";
                                // Logika Ikon Khusus
                                if(in_array($ext, ['pdf'])) { 
                                    $icon = "bi-file-earmark-pdf-fill"; 
                                    $color = "text-danger"; // Merah
                                } 
                                elseif(in_array($ext, ['doc','docx'])) { 
                                    $icon = "bi-file-earmark-word-fill"; 
                                    $color = "text-primary"; // Biru
                                } 
                                elseif(in_array($ext, ['xls','xlsx'])) { 
                                    $icon = "bi-file-earmark-excel-fill"; 
                                    $color = "text-success"; // Hijau
                                } 
                                elseif(in_array($ext, ['ppt','pptx'])) { 
                                    $icon = "bi-file-earmark-ppt-fill"; 
                                    $color = "text-warning"; // Kuning/Oranye
                                }
                            ?>
                            <tr>
                                <td class="ps-4 py-3 text-start">
                                    <div class="d-flex align-items-center text-start">
                                        <i class="bi <?php echo $icon . ' ' . $color; ?> fs-4 me-3"></i>
                                        <div>
                                            <span class="fw-bold d-block"><?php echo $data['nama']; ?></span>
                                            <small class="text-muted" style="font-size: 11px;">File: <?php echo substr($data['nama_file'], 0, 30) . '...'; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-start"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill"><?php echo $data['kategori']; ?></span></td>
                                <td class="text-start fw-bold text-secondary"><?php echo $data['tahun']; ?></td>
                                <td class="text-start">
                                    <?php if($data['hak_akses'] == 'publik') : ?>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2"><i class="bi bi-globe me-1"></i> Publik</span>
                                    <?php else : ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2"><i class="bi bi-lock me-1"></i> Internal</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center text-start">
                                    <a href="../assets/document/<?php echo $data['nama_file']; ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-2 me-1" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-primary rounded-2 me-1" data-bs-toggle="modal" data-bs-target="#modalEditDokumen<?php echo $data['id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-2" onclick="konfirmasiHapus(<?php echo $data['id']; ?>, '<?php echo addslashes($data['nama']); ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditDokumen<?php echo $data['id']; ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                                        <div class="modal-header border-0 p-4 pb-0 text-start">
                                            <h5 class="fw-bold text-navy text-start">Edit Dokumen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start">
                                            <form action="proses-dokumen.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id_dokumen" value="<?php echo $data['id']; ?>">
                                                <input type="hidden" name="aksi" value="update">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Nama Dokumen</label>
                                                    <input type="text" name="judul" class="form-control rounded-3" value="<?php echo $data['nama']; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label class="form-label small fw-bold">Kategori</label>
                                                        <select name="kategori" class="form-select rounded-3">
                                                            <option value="Laporan" <?php echo ($data['kategori'] == 'Laporan') ? 'selected' : ''; ?>>Laporan</option>
                                                            <option value="Peraturan" <?php echo ($data['kategori'] == 'Peraturan') ? 'selected' : ''; ?>>Peraturan</option>
                                                            <option value="SK" <?php echo ($data['kategori'] == 'SK') ? 'selected' : ''; ?>>Surat Keputusan (SK)</option>
                                                            <option value="Renstra" <?php echo ($data['kategori'] == 'Renstra') ? 'selected' : ''; ?>>Renstra</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label class="form-label small fw-bold">Tahun</label>
                                                        <input type="number" name="tahun" class="form-control rounded-3" value="<?php echo $data['tahun']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Ganti Berkas (Opsional)</label>
                                                    <input type="file" name="file_upload" class="form-control rounded-3" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">File saat ini: <?php echo $data['nama_file']; ?></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Hak Akses</label>
                                                    <select name="hak_akses" class="form-select rounded-3">
                                                        <option value="publik" <?php echo ($data['hak_akses'] == 'publik') ? 'selected' : ''; ?>>Publik (Umum)</option>
                                                        <option value="internal" <?php echo ($data['hak_akses'] == 'internal') ? 'selected' : ''; ?>>Internal (Admin)</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 shadow">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else : ?>
            
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-folder2-open text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h6 class="text-muted fw-bold">Belum ada dokumen</h6>
                <p class="text-muted small">Silakan unggah dokumen baru melalui tombol di atas.</p>
            </div>

        <?php endif; ?>

    </div>

    <div class="modal fade" id="modalUploadDokumen" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0 text-start">
                    <h5 class="fw-bold text-navy text-start">Unggah Dokumen Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-dokumen.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Dokumen</label>
                            <input type="text" name="judul" class="form-control rounded-3" placeholder="Contoh: Laporan Keuangan 2025" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold">Kategori</label>
                                <select name="kategori" class="form-select rounded-3">
                                    <option value="Laporan">Laporan</option>
                                    <option value="Peraturan">Peraturan</option>
                                    <option value="SK">Surat Keputusan (SK)</option>
                                    <option value="Renstra">Renstra</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold">Tahun</label>
                                <input type="number" name="tahun" class="form-control rounded-3" value="<?php echo date('Y'); ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Pilih Berkas</label>
                            <input type="file" name="file_upload" class="form-control rounded-3" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                            <small class="text-muted" style="font-size: 11px;">Format: PDF, Word, Excel, PowerPoint (Max 10MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Hak Akses</label>
                            <select name="hak_akses" class="form-select rounded-3">
                                <option value="publik">Publik (Bisa diunduh umum)</option>
                                <option value="internal">Internal (Hanya admin)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-2 shadow">Unggah Dokumen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function konfirmasiHapus(id, nama) {
        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "Dokumen '" + nama + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "proses-dokumen.php?aksi=hapus&id=" + id;
            }
        })
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        let title, text, icon;

        if (status === 'sukses') {
            title = 'Berhasil!'; text = 'Dokumen telah disimpan.'; icon = 'success';
        } else if (status === 'sukses_hapus') {
            title = 'Terhapus!'; text = 'Dokumen berhasil dihapus.'; icon = 'success';
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