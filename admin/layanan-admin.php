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

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <table class="table align-middle mb-0 table-hover">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3 fw-bold">No.</th>
                        <th class="py-3 fw-bold">Nama Layanan</th>
                        <th class="py-3 fw-bold">Deskripsi Singkat</th>
                        <th class="py-3 fw-bold">Status</th>
                        <th class="py-3 fw-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 py-3"><span class="fw-bold">1</span></td>
                        <td class="py-3"><span class="fw-bold">SPBE</span></td>
                        <td class="py-3"><small class="text-muted">Sistem Pemerintahan Berbasis Elektronik...</small></td>
                        <td class="py-3"><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 fw-bold">Aktif</span></td>
                        <td class="py-3 text-center">
                            <button class="btn btn-sm btn-outline-primary rounded-2 me-1" data-bs-toggle="modal" data-bs-target="#modalEdit1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            
                            <button type="button" 
                               class="btn btn-sm btn-outline-danger rounded-2" 
                               onclick="konfirmasiHapus(1, 'SPBE')"
                               title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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

    <div class="modal fade" id="modalEdit1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Form Edit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-layanan.php" method="POST">
                        <input type="hidden" name="id_layanan" value="1">
                        <input type="hidden" name="aksi" value="update">

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control rounded-3" value="SPBE" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-start">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control rounded-3 text-start" rows="3" required>Sistem Pemerintahan Berbasis Elektronik Kabupaten Bekasi...</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Link Akses</label>
                            <input type="url" name="url" class="form-control rounded-3" value="https://bekasikab.go.id">
                        </div>
                        <div class="mb-4 text-start">
                            <label class="form-label small fw-bold">Status Tampil</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="1" selected>Aktif (Tampil)</option>
                                <option value="0">Non-Aktif (Sembunyikan)</option>
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
                window.location.href = "proses-layanan.php?aksi=hapus&id=" + id;
            }
        })
    }

    // Menampilkan Notifikasi Berhasil dari URL (Redirect dari proses-layanan.php)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        if (status === 'sukses_hapus') {
            Swal.fire({ title: 'Terhapus!', text: 'Layanan berhasil dihapus.', icon: 'success', confirmButtonColor: '#003366' });
        } else if (status === 'sukses') {
            Swal.fire({ title: 'Berhasil!', text: 'Data layanan telah disimpan.', icon: 'success', confirmButtonColor: '#003366' });
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>