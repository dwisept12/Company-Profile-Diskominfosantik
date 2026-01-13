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
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Manajemen Dokumen / Download</h3>
                <p class="text-muted small">Kelola berkas publik, regulasi, dan laporan resmi.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalUploadDokumen">
                <i class="bi bi-cloud-upload-fill me-2"></i> Unggah Dokumen Baru
            </button>
        </header>

        <div class="row g-4 text-start">
            <div class="col-12 text-start">
                <div class="card admin-card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive text-start">
                        <table class="table align-middle mb-0 text-start">
                            <thead class="bg-light text-navy text-start">
                                <tr>
                                    <th class="ps-4 py-3 text-start">Judul Dokumen</th>
                                    <th class="text-start">Kategori</th>
                                    <th class="text-start">Hak Akses</th>
                                    <th class="text-center text-start">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-start">
                                <tr>
                                    <td class="ps-4 py-3 text-start">
                                        <div class="d-flex align-items-center text-start">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger fs-4 me-3"></i>
                                            <span class="fw-bold">Rencana Strategis (RENSTRA) 2026</span>
                                        </div>
                                    </td>
                                    <td class="text-start"><span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">Laporan</span></td>
                                    <td class="text-start"><span class="small fw-semibold text-muted text-start"><i class="bi bi-globe me-1"></i> Publik</span></td>
                                    <td class="text-center text-start">
                                        <button class="btn btn-sm btn-light text-primary me-1 text-start" data-bs-toggle="modal" data-bs-target="#modalEditDokumen1">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-light text-danger text-start" 
                                                onclick="konfirmasiHapus(1, 'Rencana Strategis (RENSTRA) 2026')">
                                            <i class="bi bi-trash"></i>
                                        </button>
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
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0 text-start">
                    <h5 class="fw-bold text-navy text-start">Unggah File (PDF, DOC)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-dokumen.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="mb-3 text-start text-start">
                            <label class="form-label small fw-bold text-start">Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control rounded-3 text-start" placeholder="Masukkan judul dokumen" required>
                        </div>
                        <div class="mb-3 text-start text-start">
                            <label class="form-label small fw-bold text-start">Pilih Berkas</label>
                            <input type="file" name="file_upload" class="form-control rounded-3 text-start" accept=".pdf,.doc,.docx" required>
                        </div>
                        <div class="mb-3 text-start text-start">
                            <label class="form-label small fw-bold text-start">Hak Akses</label>
                            <select name="hak_akses" class="form-select rounded-3 text-start">
                                <option value="publik">Publik (Bisa diunduh umum)</option>
                                <option value="internal">Internal (Hanya admin)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white py-2 mt-2 shadow text-start">Unggah Dokumen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function konfirmasiHapus(id, judul) {
        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "Dokumen '" + judul + "' akan dihapus permanen dari server.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366', // Warna Navy Admin
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '15px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "proses-dokumen.php?aksi=hapus&id=" + id;
            }
        })
    }

    // Menampilkan Notifikasi Sukses dari URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        if (status === 'sukses_hapus') {
            Swal.fire({ title: 'Terhapus!', text: 'Dokumen telah berhasil dihapus.', icon: 'success', confirmButtonColor: '#003366' });
        } else if (status === 'sukses_unggah') {
            Swal.fire({ title: 'Berhasil!', text: 'Dokumen baru telah diunggah.', icon: 'success', confirmButtonColor: '#003366' });
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>