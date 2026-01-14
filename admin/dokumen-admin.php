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

    <div class="main-content">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen Dokumen</h3>
                <p class="text-muted small">Kelola berkas publik, regulasi, dan laporan resmi.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4 shadow hover-effect" data-bs-toggle="modal" data-bs-target="#modalUploadDokumen">
                <i class="bi bi-cloud-upload-fill me-2"></i> Unggah Dokumen Baru
            </button>
        </header>

        <div class="row g-4">
            <div class="col-12">
                <div class="card admin-card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover">
                            <thead class="bg-light border-bottom">
                                <tr>
                                    <th class="ps-4 py-3 fw-bold">Judul Dokumen</th>
                                    <th class="py-3 fw-bold">Kategori</th>
                                    <th class="py-3 fw-bold text-center">Tahun</th> <th class="py-3 fw-bold">Hak Akses</th>
                                    <th class="py-3 fw-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger fs-4 me-3"></i>
                                            <div>
                                                <span class="fw-bold d-block">Rencana Strategis (RENSTRA)</span>
                                                <small class="text-muted">2.4 MB</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill">Dokumen Profil</span>
                                    </td>
                                    <td class="text-center fw-bold text-navy">2026</td> <td>
                                        <small class="text-success fw-bold"><i class="bi bi-globe me-1"></i> Publik</small>
                                    </td>
                                    <td class="py-3 text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-2 me-1" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-outline-danger rounded-2" onclick="konfirmasiHapus(1, 'Rencana Strategis (RENSTRA)')" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-earmark-spreadsheet-fill text-success fs-4 me-3"></i>
                                            <div>
                                                <span class="fw-bold d-block">Laporan Realisasi Anggaran Q1</span>
                                                <small class="text-muted">1.1 MB</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Anggaran</span>
                                    </td>
                                    <td class="text-center fw-bold">2026</td> <td>
                                        <small class="text-warning fw-bold"><i class="bi bi-lock-fill me-1"></i> Internal</small>
                                    </td>
                                    <td class="py-3 text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-2 me-1" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-outline-danger rounded-2" onclick="konfirmasiHapus(2, 'Laporan Realisasi Anggaran Q1')" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUploadDokumen" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                
                <div class="modal-header border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-navy mb-0">Unggah File (PDF, DOC, XLS)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="proses-dokumen.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control rounded-3" placeholder="Contoh: Laporan Keuangan 2026" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Kategori</label>
                                <select name="kategori" class="form-select rounded-3">
                                    <option value="Profil">Dokumen Profil</option>
                                    <option value="Laporan">Laporan Kinerja</option>
                                    <option value="Anggaran">Data Anggaran</option>
                                    <option value="Regulasi">Regulasi / UU</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Tahun Dokumen</label>
                                <input type="number" name="tahun" class="form-control rounded-3" value="2026" min="2000" max="2099">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Pilih Berkas</label>
                            <input type="file" name="file_upload" class="form-control rounded-3" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                            <div class="form-text small">Maksimal ukuran file 5 MB.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Hak Akses</label>
                            <select name="hak_akses" class="form-select rounded-3">
                                <option value="publik">Publik (Tampil di Website)</option>
                                <option value="internal">Internal (Arsip Admin Saja)</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-3 shadow">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i> Unggah Dokumen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function konfirmasiHapus(id, judul) {
        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "Dokumen '" + judul + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // window.location.href = "proses-dokumen.php?aksi=hapus&id=" + id;
                Swal.fire('Terhapus!', 'Dokumen berhasil dihapus.', 'success');
            }
        })
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>