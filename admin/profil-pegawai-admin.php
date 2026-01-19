<?php
session_start();
if ($_SESSION['status_login'] != true) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Hubungkan ke Database

// Ambil data pegawai diurutkan berdasarkan 'urutan'
$query = "SELECT * FROM pegawai ORDER BY urutan ASC";
$result = mysqli_query($koneksi, $query);
?>

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
                <h3 class="fw-bold text-navy mb-1 text-start">Profil Pegawai</h3>
                <p class="text-muted small text-start">Kelola data pejabat, tugas, dan riwayat pendidikan staf.</p>
            </div>
            <button class="btn btn-navy-dark rounded-pill px-4 shadow hover-effect text-start" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Pegawai
            </button>
        </header>

        <div class="row g-4 text-start">
            
            <?php 
            // LOOPING DATA PEGAWAI DARI DATABASE
            while($row = mysqli_fetch_assoc($result)) : 
                // Cek Foto
                $foto_path = "../assets/img/pegawai/" . $row['foto'];
                if ($row['foto'] == "" || !file_exists($foto_path)) {
                    $foto_tampil = "https://via.placeholder.com/300x400?text=No+Photo"; 
                } else {
                    $foto_tampil = $foto_path;
                }

                // Decode JSON Pendidikan
                $pendidikan_array = json_decode($row['riwayat_pendidikan'], true);
            ?>

            <div class="col-xl-6 col-12 text-start">
                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden position-relative group-action text-start">
                    <div class="card-body p-4 text-start">
                        <div class="row g-4 text-start">
                            <div class="col-sm-4 text-center">
                                <div class="position-relative text-center">
                                    <img src="<?php echo $foto_tampil; ?>" 
                                         class="img-fluid rounded-4 shadow-sm object-fit-cover" 
                                         style="aspect-ratio: 3/4; width: 100%; object-position: center top;" 
                                         alt="Foto Pegawai">
                                    <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2 shadow-sm text-start">
                                        Urutan: <?php echo $row['urutan']; ?>
                                    </span>
                                </div>
                                
                                <div class="d-grid gap-2 mt-3 text-start">
                                    <button class="btn btn-sm btn-outline-navy fw-bold rounded-pill text-start" data-bs-toggle="modal" data-bs-target="#modalEditPegawai<?php echo $row['id']; ?>">
                                        <i class="bi bi-pencil-square me-1"></i> Edit Data
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-outline-danger fw-bold rounded-pill text-start" onclick="konfirmasiHapus(<?php echo $row['id']; ?>, '<?php echo addslashes($row['nama']); ?>')">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-8 text-start">
                                <div class="d-flex justify-content-between align-items-start mb-2 text-start">
                                    <div class="text-start">
                                        <h5 class="fw-bold text-navy mb-1 text-start"><?php echo $row['nama']; ?></h5>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill mb-2 text-start"><?php echo $row['jabatan']; ?></span>
                                    </div>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="small fw-bold text-muted d-block text-start">NIP</label>
                                    <span class="text-navy fw-medium text-start"><?php echo $row['nip']; ?></span>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="small fw-bold text-muted d-block text-start">Bidang Tugas</label>
                                    <p class="small text-muted mb-0 lh-sm text-start">
                                        <?php echo substr($row['bidang_tugas'], 0, 100) . '...'; ?>
                                    </p>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="small fw-bold text-muted d-block text-start">Riwayat Pendidikan</label>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <?php 
                                        if(!empty($pendidikan_array)){
                                            foreach($pendidikan_array as $edu){
                                                echo "<li class='mb-3'>"; 
                                                // BARIS 1: Ikon + Jenjang + Jurusan + (Tahun)
                                                echo "<div class='fw-bold text-navy'>";
                                                echo "<i class='bi bi-mortarboard-fill me-2 text-warning'></i>";
                                                // Contoh output: S1 Teknik Informatika (2023)
                                                echo $edu['jenjang'] . " " . $edu['jurusan'] . " <span class='text-muted fw-normal'>(" . $edu['tahun'] . ")</span>"; 
                                                echo "</div>";
                                                // BARIS 2: Nama Kampus
                                                echo "<div class='small text-muted ms-4'>"; 
                                                echo $edu['kampus'];
                                                echo "</div>";
                                                echo "</li>";
                                            }
                                        } else {
                                            echo "<li>- Belum ada data -</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEditPegawai<?php echo $row['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable text-start">
                    <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                        <div class="modal-header border-0 p-4 pb-0 text-start">
                            <h5 class="fw-bold text-navy text-start">Edit Data Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-start">
                            <form action="proses-pegawai.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_pegawai" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="aksi" value="update">
                                
                                <div class="row g-4 text-start">
                                    <div class="col-md-6 text-start">
                                        <h6 class="fw-bold text-warning mb-3 text-start">Biodata Utama</h6>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Nama Lengkap & Gelar</label>
                                            <input type="text" name="nama" class="form-control rounded-3 text-start" value="<?php echo $row['nama']; ?>" required>
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">NIP</label>
                                            <input type="text" name="nip" class="form-control rounded-3 text-start" value="<?php echo $row['nip']; ?>">
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Jabatan</label>
                                            <input type="text" name="jabatan" class="form-control rounded-3 text-start" value="<?php echo $row['jabatan']; ?>" required>
                                        </div>
                                        <div class="mb-3 text-start text-start">
                                            <label class="form-label small fw-bold text-start">Foto Profil Baru (Opsional)</label>
                                            <input type="file" name="foto" class="form-control rounded-3 text-start" accept="image/*">
                                            <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti foto.</small>
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Urutan Tampil</label>
                                            <input type="number" name="urutan" class="form-control rounded-3 text-start" value="<?php echo $row['urutan']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <h6 class="fw-bold text-warning mb-3 text-start">Detail Tugas & Pendidikan</h6>
                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold text-start">Bidang Tugas</label>
                                            <textarea name="tugas" class="form-control rounded-3 text-start" rows="3"><?php echo $row['bidang_tugas']; ?></textarea>
                                        </div>

                                        <div class="mb-3 text-start">
                                            <label class="form-label small fw-bold d-block text-start">Riwayat Pendidikan</label>
                                            <div class="p-3 bg-light rounded-3 border" id="container-pendidikan-edit-<?php echo $row['id']; ?>">  
                                                <?php 
                                                if(!empty($pendidikan_array)) :
                                                    foreach($pendidikan_array as $edu) :
                                                ?>
                                                <div class="p-3 mb-3 bg-white border rounded-3 position-relative item-pendidikan shadow-sm">
                                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="hapusElemen(this)"></button>
                                                    <div class="mb-2">
                                                        <label class="form-label small text-muted mb-1">Jenjang Pendidikan</label>
                                                        <select name="jenjang[]" class="form-select form-select-sm">
                                                            <option value="SMA" <?php echo ($edu['jenjang'] == 'SMA') ? 'selected' : ''; ?>>SMA/SMK</option>
                                                            <option value="D3" <?php echo ($edu['jenjang'] == 'D3') ? 'selected' : ''; ?>>D3</option>
                                                            <option value="D4" <?php echo ($edu['jenjang'] == 'D4') ? 'selected' : ''; ?>>D4</option>
                                                            <option value="S1" <?php echo ($edu['jenjang'] == 'S1') ? 'selected' : ''; ?>>S1</option>
                                                            <option value="S2" <?php echo ($edu['jenjang'] == 'S2') ? 'selected' : ''; ?>>S2</option>
                                                            <option value="S3" <?php echo ($edu['jenjang'] == 'S3') ? 'selected' : ''; ?>>S3</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label small text-muted mb-1">Jurusan</label>
                                                        <input type="text" name="jurusan[]" class="form-control form-control-sm" value="<?php echo $edu['jurusan']; ?>" placeholder="Jurusan">
                                                        </div>
                                                    <div class="mb-2">
                                                        <label class="form-label small text-muted mb-1">Nama Kampus</label>
                                                        <input type="text" name="kampus[]" class="form-control form-control-sm" value="<?php echo $edu['kampus']; ?>" placeholder="Kampus">
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="form-label small text-muted mb-1">Tahun Lulus</label>
                                                        <input type="number" name="tahun[]" class="form-control form-control-sm" value="<?php echo $edu['tahun']; ?>" placeholder="Tahun">
                                                    </div>
                                                </div>
                                                <?php endforeach; else: ?>
                                                    <div class="p-3 mb-3 bg-white border rounded-3 position-relative item-pendidikan shadow-sm">
                                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="hapusElemen(this)"></button>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">Jenjang Pendidikan</label>
                                                            <select name="jenjang[]" class="form-select form-select-sm">
                                                                <option value="S1">S1</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2"><input type="text" name="jurusan[]" class="form-control form-control-sm" placeholder="Jurusan"></div>
                                                        <div class="mb-2"><input type="text" name="kampus[]" class="form-control form-control-sm" placeholder="Kampus"></div>
                                                        <div class="mb-0"><input type="number" name="tahun[]" class="form-control form-control-sm" placeholder="Tahun"></div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-end text-start mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="tambahPendidikan('container-pendidikan-edit-<?php echo $row['id']; ?>')">
                                                    <i class="bi bi-plus-lg me-1"></i> Tambah Pendidikan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 px-0 pb-0 mt-3 text-start">
                                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-start" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-navy-dark rounded-pill px-4 fw-bold text-white shadow text-start">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; ?> 

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
                                    <div class="p-3 bg-light rounded-3 border" id="container-pendidikan-tambah">
                                        <div class="p-3 mb-3 bg-white border rounded-3 position-relative item-pendidikan shadow-sm">
                                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="hapusElemen(this)"></button>
                                            <div class="mb-2">
                                                <label class="form-label small text-muted mb-1">Jenjang Pendidikan</label>
                                                <select name="jenjang[]" class="form-select form-select-sm">
                                                    <option value="SMA">SMA/SMK</option>
                                                    <option value="D3">D3</option>
                                                    <option value="D4">D4</option>
                                                    <option value="S1" selected>S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small text-muted mb-1">Jurusan</label>
                                                <input type="text" name="jurusan[]" class="form-control form-control-sm" placeholder="Contoh: Teknik Informatika">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small text-muted mb-1">Nama Kampus / Sekolah</label>
                                                <input type="text" name="kampus[]" class="form-control form-control-sm" placeholder="Contoh: Universitas Indonesia">
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label small text-muted mb-1">Tahun Lulus</label>
                                                <input type="number" name="tahun[]" class="form-control form-control-sm" placeholder="Contoh: 2023">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end text-start mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="tambahPendidikan('container-pendidikan-tambah')">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Pendidikan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 px-0 pb-0 mt-3 text-start">
                            <button type="submit" class="btn btn-navy-dark rounded-pill px-4 fw-bold text-white shadow text-start">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function tambahPendidikan(containerId) {
        const container = document.getElementById(containerId);
        const newRow = document.createElement('div');
        newRow.className = 'p-3 mb-3 bg-white border rounded-3 position-relative item-pendidikan shadow-sm';
        newRow.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="hapusElemen(this)" title="Hapus"></button>
            <div class="mb-2">
                <label class="form-label small text-muted mb-1">Jenjang Pendidikan</label>
                <select name="jenjang[]" class="form-select form-select-sm">
                    <option value="SMA">SMA/SMK</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label small text-muted mb-1">Jurusan</label>
                <input type="text" name="jurusan[]" class="form-control form-control-sm" placeholder="Contoh: Teknik Informatika">
            </div>
            <div class="mb-2">
                <label class="form-label small text-muted mb-1">Nama Kampus / Sekolah</label>
                <input type="text" name="kampus[]" class="form-control form-control-sm" placeholder="Contoh: Universitas Indonesia">
            </div>
            <div class="mb-0">
                <label class="form-label small text-muted mb-1">Tahun Lulus</label>
                <input type="number" name="tahun[]" class="form-control form-control-sm" placeholder="Contoh: 2023">
            </div>
        `;
        container.appendChild(newRow);
    }
    function hapusElemen(button) {
        button.closest('.item-pendidikan').remove();
    }

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
        let title = '';
        let text = '';
        let icon = '';

        if (status === 'sukses_hapus') {
            title = 'Terhapus!';
            text = 'Data pegawai telah berhasil dihapus.';
            icon = 'success';
        } else if (status === 'sukses') {
            title = 'Berhasil!';
            text = 'Data pegawai telah disimpan.';
            icon = 'success';
        } else if (status === 'gagal') {
            const errorCode = urlParams.get('code'); 
            const errorMsg = decodeURIComponent(urlParams.get('msg'));
            title = 'Gagal Menyimpan!';
            text = 'Error (' + errorCode + '): ' + errorMsg;
            icon = 'error';
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