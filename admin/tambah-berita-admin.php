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
                <h3 class="fw-bold text-navy mb-1">Manajemen Berita</h3>
                <p class="text-muted small">Kelola semua konten berita Diskominfosantik di sini.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
                <i class="bi bi-plus-lg me-2"></i> Tambah Berita Baru
            </button>
        </header>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light text-navy">
                        <tr>
                            <th class="ps-4">Thumbnail</th>
                            <th>Informasi Berita</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <img src="https://via.placeholder.com/80x50" class="rounded-3 shadow-sm" alt="Berita">
                            </td>
                            <td>
                                <span class="fw-bold d-block text-navy">Transformasi Digital Kabupaten Bekasi</span>
                                <small class="text-muted">5 Januari 2026</small>
                            </td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Teknologi</span></td>
                            <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Published</span></td>
                            <td class="text-center">
                                <a href="edit-berita.php?id=1" class="btn btn-sm btn-light text-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <button type="button" class="btn btn-sm btn-light text-danger" onclick="konfirmasiHapus(1, 'Transformasi Digital Kabupaten Bekasi')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 p-4 pb-0 text-start">
                    <h5 class="modal-title fw-bold text-navy" id="modalTambahBeritaLabel">Form Tambah Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-start text-start">
                    <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small">Judul Berita</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2" placeholder="Contoh: Peluncuran Layanan Baru" required>
                        </div>

                        <div class="row text-start">
                            <div class="col-md-6 mb-3 text-start">
                                <label class="form-label fw-semibold small text-start">Pilih Kategori</label>
                                <select name="kategori" class="form-select rounded-3 py-2">
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label class="form-label fw-semibold small">Gambar Utama</label>
                                <input type="file" name="gambar" class="form-control rounded-3 py-2" accept="image/*" required>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small">Isi Berita</label>
                            <textarea name="isi" class="form-control rounded-3" rows="6" placeholder="Tuliskan detail berita secara lengkap..."></textarea>
                        </div>

                        <div class="mb-4 text-start">
                            <label class="form-label fw-semibold small">Status</label>
                            <select name="status" class="form-select rounded-3 py-2">
                                <option value="publish">Terbitkan Langsung</option>
                                <option value="draft">Simpan sebagai Draft</option>
                            </select>
                        </div>

                        <div class="d-grid text-start">
                            <button type="submit" class="btn btn-navy-dark py-3 fw-bold rounded-3 text-white">Simpan Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function konfirmasiHapus(id, judul) {
        Swal.fire({
            title: 'Hapus Berita?',
            text: "Berita '" + judul + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366', // Warna Navy Admin
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

    // Menampilkan Notifikasi Berhasil setelah Redirect
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        if (status === 'sukses_hapus') {
            Swal.fire({ title: 'Terhapus!', text: 'Berita telah berhasil dihapus.', icon: 'success', confirmButtonColor: '#003366' });
        } else if (status === 'sukses_tambah') {
            Swal.fire({ title: 'Berhasil!', text: 'Berita baru telah dipublikasikan.', icon: 'success', confirmButtonColor: '#003366' });
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>