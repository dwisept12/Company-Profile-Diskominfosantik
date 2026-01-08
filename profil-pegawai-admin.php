<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div data-include="navbar.html"></div>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold text-navy mb-4">Input Data Pegawai</h5>
                    <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">NIP</label>
                            <input type="text" name="nip" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-navy-dark w-100 rounded-pill fw-bold text-white mt-2">Simpan Data</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <table class="table align-middle mb-0">
                        <thead class="bg-white border-bottom text-navy">
                            <tr>
                                <th class="ps-4 py-3">Pegawai</th>
                                <th>Jabatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" class="rounded-circle me-3">
                                        <div>
                                            <span class="fw-bold d-block">Dr. Ahmad Fauzi, M.Kom</span>
                                            <small class="text-muted">NIP. 19800101XXXXXXXX</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Kepala Dinas</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light text-primary me-2"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div data-include="footer.html"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>