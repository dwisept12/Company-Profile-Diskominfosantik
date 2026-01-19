<?php
include 'db.php'; 

// ==========================================
// 1. LOGIKA HAPUS DATA
// ==========================================
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    
    // Ambil ID dari URL dan pastikan aman (integer)
    $id = (int) $_GET['id'];

    // Perintah SQL Hapus
    $query = "DELETE FROM layanan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect dengan parameter 'sukses_hapus' (untuk SweetAlert)
        header("Location: layanan-admin.php?status=sukses_hapus");
    } else {
        header("Location: layanan-admin.php?status=gagal");
    }
    exit();
}

// ==========================================
// 2. LOGIKA TAMBAH & UPDATE DATA
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data dari Form & Amankan string (Cegah error tanda kutip/SQL Injection)
    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi    = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $url          = mysqli_real_escape_string($koneksi, $_POST['url']);
    $status       = (int) $_POST['status']; // Pastikan jadi angka (0 atau 1)
    $aksi         = $_POST['aksi'];

    // --- A. JIKA AKSI = UPDATE ---
    if ($aksi == 'update') {
        $id = (int) $_POST['id_layanan']; // Ambil ID dari input hidden

        $query = "UPDATE layanan SET 
                  nama_layanan = '$nama_layanan',
                  deskripsi = '$deskripsi',
                  url = '$url',
                  status = '$status'
                  WHERE id = $id";
    
    // --- B. JIKA AKSI = TAMBAH ---
    } elseif ($aksi == 'tambah') {
        $query = "INSERT INTO layanan (nama_layanan, deskripsi, url, status) 
                  VALUES ('$nama_layanan', '$deskripsi', '$url', '$status')";
    }

    // Eksekusi Query
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        if ($aksi == 'hapus') {
            header("Location: layanan-admin.php?status=sukses_hapus");
        } else {
            header("Location: layanan-admin.php?status=sukses");
        }
    } else {
        // --- LOGIKA GAGAL DIPERBARUI ---
        // 1. Ambil Angka Error (Contoh: 1062)
        $error_code = mysqli_errno($koneksi);
        // 2. Ambil Pesan Error Lengkap (Contoh: Duplicate entry 'SPBE' for key...)
        $error_msg = urlencode(mysqli_error($koneksi));
        header("Location: layanan-admin.php?status=gagal&code=$error_code&msg=$error_msg");
    }
    exit();
}
?>