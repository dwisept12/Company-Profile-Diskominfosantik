<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Profil Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center text-start">
            <div>
                <h3 class="fw-bold text-navy mb-1 text-start">Profil Tim / Pegawai</h3>
                <p class="text-muted small text-start">Kelola data pejabat, tugas, dan riwayat pendidikan staf.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4 shadow hover-effect text-start" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Pegawai
            </button>
        </header>

        <div class="row g-4 text-start">
            
            <div class="col-xl-6 col-12 text-start">
                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden position-relative group-action text-start">
                    <div class="card-body p-4 text-start">
                        <div class="row g-4 text-start">
                            <div class="col-sm-4 text-center">
                                <div class="position-relative text-center">
                                    <img src="../assets/img/images.jpg" 
                                         class="img-fluid rounded-4 shadow-sm object-fit-cover" 
                                         style="aspect-ratio: 3/4; width: 100%;" 
                                         alt="Foto Pegawai">
                                    <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2 shadow-sm text-start">
                                        Urutan: 1
                                    </span>
                                </div>
                                
                                <div class="d-grid gap-2 mt-3 text-start">
                                    <button class="btn btn-sm btn-outline-navy fw-bold rounded-pill text-start" data-bs-toggle="modal" data-bs-target="#modalEditPegawai1">
                                        <i class="bi bi-pencil-square me-1"></i> Edit Data
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-outline-danger fw-bold rounded-pill text-start" onclick="konfirmasiHapus(1, 'Dr. Ahmad Fauzi, M.Kom')">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-8 text-start">
                                <div class="d-flex justify-content-between align-items-start mb-2 text-start">
                                    <div class="text-start">
                                        <h5 class="fw-bold text-navy mb-1 text-start">Dr. Ahmad Fauzi, M.Kom</h5>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill mb-2 text-start">Kepala Dinas</span>
                                    </div>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="small fw-bold text-muted d-block text-start">NIP</label>
                                    <span class="text-navy fw-medium text-start">19800101 200501 1 001</span>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="small fw-bold text-muted d-block text-start">Bidang Tugas</label>
                                    <p class="small text-muted mb-0 lh-sm text-start">
                                        Pimpinan Dinas Komunikasi, Informatika, Statistik dan Persandian dalam merumuskan kebijakan teknis.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEditPegawai1" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable text-start">
                    <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                        <div class="modal-header border-0 p-4 pb-0 text-start">
                            <h5 class="fw-bold text-navy text-start">Edit Data Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-start">
                            <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_pegawai" value="1">
                                <input type="hidden" name="aksi" value="update">
                                <div class="row g-4 text-start">
                                    <div class="col-md-6 text-start">
                                        <h6 class="fw-bold text-warning mb-3 text-start">Biodata Utama</h6>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Nama Lengkap & Gelar</label>
                                            <input type="text" name="nama" class="form-control rounded-3 text-start" value="Dr. Ahmad Fauzi, M.Kom" required>
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">NIP</label>
                                            <input type="text" name="nip" class="form-control rounded-3 text-start" value="19800101 200501 1 001">
                                        </div>
                                        <div class="mb-3 text-start text-start">
                                            <label class="form-label small fw-bold text-start">Foto Profil Baru (Opsional)</label>
                                            <input type="file" name="foto" class="form-control rounded-3 text-start" accept="image/*">
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Urutan Tampil</label>
                                            <input type="number" name="urutan" class="form-control rounded-3 text-start" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <h6 class="fw-bold text-warning mb-3 text-start">Detail Tugas</h6>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Bidang Tugas (Jobdesk)</label>
                                            <textarea name="tugas" class="form-control rounded-3 text-start" rows="5">Pimpinan Dinas Komunikasi, Informatika, Statistik dan Persandian dalam merumuskan kebijakan teknis.</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 px-0 pb-0 mt-3 text-start">
                                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-start" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-navy-dark rounded-pill px-4 fw-bold text-white shadow text-start">Perbarui Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalTambahPegawai" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable text-start">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-0 p-4 pb-0 text-start">
                    <h5 class="fw-bold text-navy text-start">Input Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="row g-4 text-start">
                            <div class="col-md-6 text-start">
                                <h6 class="fw-bold text-warning mb-3 text-start">Biodata Utama</h6>
                                <div class="mb-3 text-start">
                                    <label class="form-label small fw-bold text-start">Nama Lengkap & Gelar</label>
                                    <input type="text" name="nama" class="form-control rounded-3 text-start" placeholder="Contoh: Dr. Ahmad Fauzi, M.Kom" required>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="form-label small fw-bold text-start">NIP</label>
                                    <input type="text" name="nip" class="form-control rounded-3 text-start" placeholder="Masukkan NIP">
                                </div>
                                <div class="mb-3 text-start text-start">
                                    <label class="form-label small fw-bold text-start">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control rounded-3 text-start" placeholder="Contoh: Kepala Dinas" required>
                                </div>
                                <div class="mb-3 text-start text-start">
                                    <label class="form-label small fw-bold text-start text-start">Foto Profil</label>
                                    <input type="file" name="foto" class="form-control rounded-3 text-start" accept="image/*">
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="form-label small fw-bold text-start">Urutan Tampil</label>
                                    <input type="number" name="urutan" class="form-control rounded-3 text-start" value="1">
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <h6 class="fw-bold text-warning mb-3 text-start">Detail & Pendidikan</h6>
                                <div class="mb-3 text-start">
                                    <label class="form-label small fw-bold text-start">Bidang Tugas (Jobdesk)</label>
                                    <textarea name="tugas" class="form-control rounded-3 text-start" rows="3" placeholder="Jelaskan tugas utama secara singkat..."></textarea>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="form-label small fw-bold d-block text-start">Riwayat Pendidikan</label>
                                    <div class="p-3 bg-light rounded-3 border text-start text-start">
                                        <div class="mb-2 text-start">
                                            <input type="text" name="pendidikan[]" class="form-control form-control-sm mb-1 text-start" placeholder="Jenjang & Jurusan">
                                            <input type="text" name="kampus[]" class="form-control form-control-sm text-start" placeholder="Nama Kampus & Tahun">
                                        </div>
                                        <div class="text-end text-start">
                                            <small class="text-primary cursor-pointer text-start">+ Tambah Pendidikan Lain</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 px-0 pb-0 mt-3 text-start">
                            <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-start" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-navy-dark rounded-pill px-4 fw-bold text-white shadow text-start">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function konfirmasiHapus(id, nama) {
        Swal.fire({
            title: 'Hapus Data Pegawai?',
            text: "Data '" + nama + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '15px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "proses-pegawai.php?aksi=hapus&id=" + id;
            }
        })
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        if (status === 'sukses_hapus') {
            Swal.fire({ title: 'Terhapus!', text: 'Data pegawai telah berhasil dihapus.', icon: 'success', confirmButtonColor: '#003366' });
        } else if (status === 'sukses') {
            Swal.fire({ title: 'Berhasil!', text: 'Data pegawai telah disimpan.', icon: 'success', confirmButtonColor: '#003366' });
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>