<?php
include 'db.php'; // Koneksi Database

// Folder penyimpanan
$target_dir = "../assets/document/";

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['aksi'])) {
    
    $aksi = isset($_POST['aksi']) ? $_POST['aksi'] : (isset($_GET['aksi']) ? $_GET['aksi'] : '');

    // ===========================================================
    // 1. LOGIKA HAPUS
    // ===========================================================
    if ($aksi == 'hapus') {
        $id = (int) $_GET['id'];
        
        // Ambil nama file lama untuk dihapus
        $cek = mysqli_query($koneksi, "SELECT nama_file FROM dokumen WHERE id=$id");
        $data = mysqli_fetch_assoc($cek);

        if ($data && !empty($data['nama_file'])) {
            $path = $target_dir . $data['nama_file'];
            if (file_exists($path)) unlink($path);
        }

        mysqli_query($koneksi, "DELETE FROM dokumen WHERE id=$id");
        header("Location: dokumen-admin.php?status=sukses_hapus");
        exit();
    }


    // ===========================================================
    // 2. LOGIKA UPLOAD FILE
    // ===========================================================
    
    // Ambil Data Input Umum
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $hak_akses = mysqli_real_escape_string($koneksi, $_POST['hak_akses']);
    $kategori  = isset($_POST['kategori']) ? mysqli_real_escape_string($koneksi, $_POST['kategori']) : "Laporan";
    $tahun     = isset($_POST['tahun']) ? mysqli_real_escape_string($koneksi, $_POST['tahun']) : date('Y');

    // Variabel penampung nama file (default kosong)
    $nama_file_ready = ""; 

    // Cek apakah user mengupload file?
    if (!empty($_FILES['file_upload']['name'])) {
        
        $nama_asli   = $_FILES['file_upload']['name'];
        $tmp_file    = $_FILES['file_upload']['tmp_name'];
        $ukuran_file = $_FILES['file_upload']['size'];
        
        $ekstensi    = strtolower(pathinfo($nama_asli, PATHINFO_EXTENSION));
        // $nama_dasar = pathinfo($nama_asli, PATHINFO_FILENAME); // Tidak dipakai lagi

        // A. Validasi Format
        $ext_valid = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
        if (!in_array($ekstensi, $ext_valid)) {
            header("Location: dokumen-admin.php?status=gagal&msg=" . urlencode("Format file salah! Hanya PDF/Office."));
            exit();
        }

        // B. Validasi Ukuran (10MB)
        if ($ukuran_file > 10485760) {
            header("Location: dokumen-admin.php?status=gagal&msg=" . urlencode("File terlalu besar (Max 10MB)."));
            exit();
        }

        // =========================================================
        // C. Rename File (MODIFIKASI DI SINI)
        // =========================================================
        // Menggunakan $judul sebagai dasar nama, bukan nama file asli
        
        // 1. Bersihkan judul dari karakter aneh (spasi jadi underscore, simbol hilang)
        $judul_bersih = preg_replace('/[^A-Za-z0-9]/', '_', $judul);
        
        // 2. Batasi panjang nama file agar tidak terlalu panjang (misal 50 kar)
        $judul_bersih = substr($judul_bersih, 0, 50);
        
        // 3. Susun nama baru: TANGGAL_ACAK_JUDUL.EXT
        $nama_file_baru = date("Y-m-d") . "_" . rand(100, 999) . "_" . $judul_bersih . "." . $ekstensi;

        // D. Pindahkan File
        if (move_uploaded_file($tmp_file, $target_dir . $nama_file_baru)) {
            $nama_file_ready = $nama_file_baru; // File berhasil diupload & siap masuk DB
        } else {
            header("Location: dokumen-admin.php?status=gagal&msg=" . urlencode("Gagal upload ke server."));
            exit();
        }
    }


    // ===========================================================
    // 3. LOGIKA INPUT/UPDATE DATABASE
    // ===========================================================

    if ($aksi == 'tambah') {
        // Saat tambah, file WAJIB ada
        if ($nama_file_ready == "") {
            header("Location: dokumen-admin.php?status=gagal&msg=" . urlencode("Anda belum memilih file dokumen."));
            exit();
        }

        $query = "INSERT INTO dokumen (nama, kategori, tahun, nama_file, hak_akses) 
                  VALUES ('$judul', '$kategori', '$tahun', '$nama_file_ready', '$hak_akses')";

    } elseif ($aksi == 'update') {
        $id = (int) $_POST['id_dokumen'];

        // Jika ada file baru ($nama_file_ready terisi)
        if ($nama_file_ready != "") {
            // Hapus file lama dulu
            $cek = mysqli_query($koneksi, "SELECT nama_file FROM dokumen WHERE id=$id");
            $dt = mysqli_fetch_assoc($cek);
            if ($dt && file_exists($target_dir . $dt['nama_file'])) {
                unlink($target_dir . $dt['nama_file']);
            }

            // Update Data + Nama File Baru
            $query = "UPDATE dokumen SET nama='$judul', kategori='$kategori', tahun='$tahun', 
                      hak_akses='$hak_akses', nama_file='$nama_file_ready' WHERE id=$id";
        } else {
            // Update Data Saja (File Tetap)
            $query = "UPDATE dokumen SET nama='$judul', kategori='$kategori', tahun='$tahun', 
                      hak_akses='$hak_akses' WHERE id=$id";
        }
    }

    // Eksekusi Query Terakhir
    if (mysqli_query($koneksi, $query)) {
        header("Location: dokumen-admin.php?status=sukses");
    } else {
        header("Location: dokumen-admin.php?status=gagal&msg=" . urlencode(mysqli_error($koneksi)));
    }
}
?>