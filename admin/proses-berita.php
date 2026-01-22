<?php
include 'db.php';

// Folder penyimpanan gambar berita
$target_dir = "../assets/img/berita/";

// ==========================================
// 1. LOGIKA HAPUS DATA
// ==========================================
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = (int) $_GET['id'];

    $q_gambar = mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id = $id");
    $data_gambar = mysqli_fetch_assoc($q_gambar);

    $file_path = $target_dir . $data_gambar['gambar'];
    if (file_exists($file_path) && $data_gambar['gambar'] != '') {
        unlink($file_path);
    }

    $query = "DELETE FROM berita WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: berita-admin.php?status=sukses_hapus");
    } else {
        $error_msg = urlencode(mysqli_error($koneksi));
        header("Location: berita-admin.php?status=gagal&msg=$error_msg");
    }
    exit();
}

// ==========================================
// 2. LOGIKA TAMBAH & UPDATE
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $aksi     = $_POST['aksi'];
    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $isi      = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $penulis  = mysqli_real_escape_string($koneksi, $_POST['penulis']);
    
    // --- PERBAIKAN DI SINI ---
    $status_input = $_POST['status']; 
    // Jika value dari select adalah 'publish', maka simpan 'publish' ke database
    $status_db    = ($status_input == 'publish') ? 'publish' : 'draft';

    $tanggal = $_POST['tanggal'];
    if(empty($tanggal)) {
        $tanggal = date('Y-m-d H:i:s');
    }

    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul)));

    $nama_gambar_db = "";

    if (!empty($_FILES['gambar']['name'])) {
        $nama_file_asli = $_FILES['gambar']['name'];
        $ukuran_file    = $_FILES['gambar']['size'];
        $ext            = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));

        $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ext, $ekstensi_valid)) {
            header("Location: berita-admin.php?status=gagal&code=400&msg=" . urlencode("Format gambar harus JPG, PNG, atau WEBP."));
            exit();
        }

        if ($ukuran_file > 2097152) {
            header("Location: berita-admin.php?status=gagal&code=400&msg=" . urlencode("Ukuran gambar terlalu besar! Max 2MB."));
            exit();
        }

        $nama_baru = date("Y-m-d") . "_" . rand(100,999) . "_" . substr($slug, 0, 50) . "." . $ext;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_dir . $nama_baru)) {
            $nama_gambar_db = $nama_baru;
        } else {
            header("Location: berita-admin.php?status=gagal&code=500&msg=" . urlencode("Gagal upload gambar ke server."));
            exit();
        }
    }

    if ($aksi == 'tambah') {
        $query = "INSERT INTO berita (judul, slug, kategori, isi, gambar, tanggal, penulis, status) 
                  VALUES ('$judul', '$slug', '$kategori', '$isi', '$nama_gambar_db', '$tanggal', '$penulis', '$status_db')";

    } elseif ($aksi == 'update') {
        $id = (int) $_POST['id_berita'];

        if ($nama_gambar_db != "") {
            $q_lama = mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id = $id");
            $dt_lama = mysqli_fetch_assoc($q_lama);
            if (file_exists($target_dir . $dt_lama['gambar']) && $dt_lama['gambar'] != "") {
                unlink($target_dir . $dt_lama['gambar']);
            }

            $query = "UPDATE berita SET 
                      judul='$judul', slug='$slug', kategori='$kategori', isi='$isi', 
                      gambar='$nama_gambar_db', tanggal='$tanggal', penulis='$penulis', status='$status_db' 
                      WHERE id=$id";
        } else {
            $query = "UPDATE berita SET 
                      judul='$judul', slug='$slug', kategori='$kategori', isi='$isi', 
                      tanggal='$tanggal', penulis='$penulis', status='$status_db' 
                      WHERE id=$id";
        }
    }

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: berita-admin.php?status=sukses");
    } else {
        $error_code = mysqli_errno($koneksi);
        $error_msg  = urlencode(mysqli_error($koneksi));
        header("Location: berita-admin.php?status=gagal&code=$error_code&msg=$error_msg");
    }
    exit();
}
?>