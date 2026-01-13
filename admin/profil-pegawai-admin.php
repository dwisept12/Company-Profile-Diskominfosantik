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
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content text-start">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-navy mb-1">Profil Tim / Pegawai</h3>
                <p class="text-muted small">Kelola data pejabat, tugas, dan riwayat pendidikan staf.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4 shadow hover-effect" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Pegawai
            </button>
        </header>

        <div class="row g-4">
            
            <div class="col-xl-6 col-12">
                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden position-relative group-action">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-sm-4 text-center">
                                <div class="position-relative">
                                    <img src="../assets/img/images.jpg" 
                                         class="img-fluid rounded-4 shadow-sm object-fit-cover" 
                                         style="aspect-ratio: 3/4; width: 100%;" 
                                         alt="Foto Pegawai">
                                    
                                    <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2 shadow-sm">
                                        Urutan: 1
                                    </span>
                                </div>
                                
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-sm btn-outline-navy fw-bold rounded-pill">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger fw-bold rounded-pill">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="fw-bold text-navy mb-1">Dr. Ahmad Fauzi, M.Kom</h5>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill mb-2">Kepala Dinas</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="small fw-bold text-muted d-block">NIP</label>
                                    <span class="text-navy fw-medium">19800101 200501 1 001</span>
                                </div>

                                <div class="mb-3">
                                    <label class="small fw-bold text-muted d-block">Bidang Tugas</label>
                                    <p class="small text-muted mb-0 lh-sm">
                                        Pimpinan Dinas Komunikasi, Informatika, Statistik dan Persandian dalam merumuskan kebijakan teknis.
                                    </p>
                                </div>

                                <div>
                                    <label class="small fw-bold text-muted d-block mb-1">Pendidikan Terakhir</label>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-1">
                                            <i class="bi bi-mortarboard-fill text-warning me-2"></i>
                                            S3 Ilmu Komputer - UI (2018)
                                        </li>
                                        <li class="d-flex align-items-start mb-1">
                                            <i class="bi bi-mortarboard-fill text-warning me-2"></i>
                                            S2 Teknik Informatika - ITB (2012)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12">
                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-sm-4 text-center">
                                <div class="position-relative">
                                    <img src="https://via.placeholder.com/300x400" 
                                         class="img-fluid rounded-4 shadow-sm object-fit-cover" 
                                         style="aspect-ratio: 3/4; width: 100%;" 
                                         alt="Foto Pegawai">
                                    <span class="position-absolute top-0 start-0 badge bg-secondary text-white m-2 shadow-sm">
                                        Urutan: 2
                                    </span>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-sm btn-outline-navy fw-bold rounded-pill"><i class="bi bi-pencil-square me-1"></i> Edit</button>
                                    <button class="btn btn-sm btn-outline-danger fw-bold rounded-pill"><i class="bi bi-trash me-1"></i> Hapus</button>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div>
                                    <h5 class="fw-bold text-navy mb-1">Siti Aminah, S.Kom</h5>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 rounded-pill mb-2">Sekretaris Dinas</span>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted d-block">NIP</label>
                                    <span class="text-navy fw-medium">19850202 201001 2 005</span>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted d-block">Bidang Tugas</label>
                                    <p class="small text-muted mb-0 lh-sm">
                                        Mengelola administrasi umum, kepegawaian, dan keuangan dinas.
                                    </p>
                                </div>
                                <div>
                                    <label class="small fw-bold text-muted d-block mb-1">Pendidikan Terakhir</label>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-1">
                                            <i class="bi bi-mortarboard-fill text-warning me-2"></i>
                                            S1 Sistem Informasi - Gunadarma (2008)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalTambahPegawai" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-navy">Input Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-warning mb-3">Biodata Utama</h6>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Nama Lengkap & Gelar</label>
                                    <input type="text" name="nama" class="form-control rounded-3" placeholder="Contoh: Dr. Ahmad Fauzi, M.Kom" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">NIP</label>
                                    <input type="text" name="nip" class="form-control rounded-3" placeholder="Masukkan NIP">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control rounded-3" placeholder="Contoh: Kepala Dinas" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Foto Profil</label>
                                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                    <div class="form-text small">Rasio foto disarankan 3:4.</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Urutan Tampil</label>
                                    <input type="number" name="urutan" class="form-control rounded-3" value="1">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fw-bold text-warning mb-3">Detail & Pendidikan</h6>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Bidang Tugas (Jobdesk)</label>
                                    <textarea name="tugas" class="form-control rounded-3" rows="3" placeholder="Jelaskan tugas utama secara singkat..."></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold d-block">Riwayat Pendidikan</label>
                                    <div class="p-3 bg-light rounded-3 border">
                                        <div class="mb-2">
                                            <input type="text" name="pendidikan[]" class="form-control form-control-sm mb-1" placeholder="Jenjang & Jurusan (Cth: S2 Informatika)">
                                            <input type="text" name="kampus[]" class="form-control form-control-sm" placeholder="Nama Kampus & Tahun (Cth: ITB, 2012)">
                                        </div>
                                        <hr class="my-2">
                                        <div class="mb-2">
                                            <input type="text" name="pendidikan[]" class="form-control form-control-sm mb-1" placeholder="Jenjang & Jurusan">
                                            <input type="text" name="kampus[]" class="form-control form-control-sm" placeholder="Nama Kampus & Tahun">
                                        </div>
                                        <div class="text-end">
                                            <small class="text-primary cursor-pointer">+ Tambah Pendidikan Lain</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 px-0 pb-0 mt-3">
                            <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-navy-dark rounded-pill px-4 fw-bold text-white shadow">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>