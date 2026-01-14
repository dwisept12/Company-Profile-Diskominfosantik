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

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive text-start">
                <table class="table align-middle mb-0 text-start">
                    <thead class="bg-light text-navy text-start">
                        <tr>
                            <th class="ps-4 text-start">Thumbnail</th>
                            <th class="text-start">Informasi Berita</th>
                            <th class="text-start">Kategori</th>
                            <th class="text-start">Status</th>
                            <th class="text-center text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-start">
                        <tr>
                            <td class="ps-4 text-start">
                                <img src="https://via.placeholder.com/80x50" class="rounded-3 shadow-sm" alt="Berita">
                            </td>
                            <td class="text-start">
                                <span class="fw-bold d-block text-navy text-start">Transformasi Digital Kabupaten Bekasi</span>
                                <small class="text-muted text-start">5 Januari 2026</small>
                            </td>
                            <td class="text-start"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill text-start">Teknologi</span></td>
                            <td class="text-start"><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill text-start">Published</span></td>
                            <td class="text-center text-start">
                                <button class="btn btn-sm btn-light text-primary me-1 text-start" data-bs-toggle="modal" data-bs-target="#modalEditBerita1">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <button type="button" class="btn btn-sm btn-light text-danger text-start" onclick="konfirmasiHapus(1, 'Transformasi Digital Kabupaten Bekasi')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
                        <div class="mb-4 text-start">
                            <label class="form-label fw-semibold small text-start">Status</label>
                            <select name="status" class="form-select rounded-3 py-2 text-start">
                                <option value="publish">Terbitkan Langsung</option>
                                <option value="draft">Simpan sebagai Draft</option>
                            </select>
                        </div>
                        <div class="d-grid text-start">
                            <button type="submit" class="btn btn-navy-dark py-3 fw-bold rounded-3 text-white text-start">Simpan Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditBerita1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0 text-start">
                    <h5 class="modal-title fw-bold text-navy text-start">Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-start text-start">
                    <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_berita" value="1"> 
                        <input type="hidden" name="aksi" value="update">

                        <div class="row text-start text-start">
                            <div class="col-lg-8 text-start">
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-bold text-navy text-start">Judul Berita</label>
                                    <input type="text" name="judul" class="form-control rounded-3 py-2 text-start" value="Transformasi Digital Kabupaten Bekasi" required>
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-bold text-navy text-start">Isi Berita Lengkap</label>
                                    <textarea name="isi" class="form-control rounded-4 text-start" rows="10" required>Isi berita lama akan muncul di sini secara otomatis dari database...</textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 text-start">
                                <div class="card border-0 bg-light p-3 rounded-4 mb-3 text-start">
                                    <h6 class="fw-bold text-navy mb-2 text-start"><i class="bi bi-image me-2 text-start"></i>Gambar Utama</h6>
                                    <img src="https://via.placeholder.com/400x250" class="img-fluid rounded-3 mb-2 shadow-sm text-start" alt="Preview">
                                    <label class="form-label small fw-bold text-start text-start">Ganti Gambar</label>
                                    <input type="file" name="gambar" class="form-control form-control-sm rounded-3 text-start">
                                </div>

                                <div class="card border-0 bg-light p-3 rounded-4 text-start">
                                    <h6 class="fw-bold text-navy mb-2 text-start"><i class="bi bi-tags me-2 text-start"></i>Kategori & Status</h6>
                                    <div class="mb-2 text-start">
                                        <label class="form-label small fw-bold text-start">Kategori</label>
                                        <select name="kategori" class="form-select form-select-sm rounded-3 text-start">
                                            <option value="Teknologi" selected>Teknologi</option>
                                            <option value="Kegiatan">Kegiatan</option>
                                            <option value="Pengumuman">Pengumuman</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label class="form-label small fw-bold text-start">Status</label>
                                        <select name="status" class="form-select form-select-sm rounded-3 text-start text-start">
                                            <option value="publish" selected>Terbitkan</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-navy-dark w-100 rounded-pill py-2 fw-bold text-white shadow text-start">
                                        Perbarui
                                    </button>
                                </div>
                            </div>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>