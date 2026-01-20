<?php
include 'db.php'; // Penghubung Database

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['aksi'])) {
    
    // Tentukan aksi (apakah dari form POST atau dari link GET)
    $aksi = isset($_POST['aksi']) ? $_POST['aksi'] : (isset($_GET['aksi']) ? $_GET['aksi'] : '');

    // 1. LOGIKA UNGGAH DOKUMEN BARU
    if ($aksi == 'tambah') {
        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
        $hak_akses = $_POST['hak_akses'];
        $kategori = "Laporan"; // Default kategori sesuai tampilan tabel
        $tahun = date('Y');    // Tahun otomatis saat ini
        
        // Pengaturan File
        $nama_file_asli = $_FILES['file_upload']['name'];
        $tmp_file = $_FILES['file_upload']['tmp_name'];
        $ekstensi = pathinfo($nama_file_asli, PATHINFO_EXTENSION);
        
        // Beri nama unik agar tidak bentrok
        $nama_file_baru = uniqid() . "." . $ekstensi;
        
        // DISESUAIKAN: Path folder tujuan ke assets/document
        $target_folder = "../assets/document/" . $nama_file_baru;

        if (move_uploaded_file($tmp_file, $target_folder)) {
            // Nama kolom disesuaikan dengan db_diskominfosantik.sql
            $query = "INSERT INTO dokumen (nama, kategori, tahun, nama_file, hak_akses) 
                      VALUES ('$judul', '$kategori', '$tahun', '$nama_file_baru', '$hak_akses')";
            mysqli_query($koneksi, $query);
            
            header("Location: dokumen-admin.php?status=sukses_unggah");
        } else {
            header("Location: dokumen-admin.php?status=gagal_unggah");
        }
    }

    // 2. LOGIKA UPDATE DOKUMEN
    if ($aksi == 'update') {
        $id = $_POST['id_dokumen'];
        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
        $hak_akses = $_POST['hak_akses'];

        // Cek apakah ada file baru yang diunggah
        if (!empty($_FILES['file_upload']['name'])) {
            // Hapus file fisik lama di folder assets/document
            $lama = mysqli_query($koneksi, "SELECT nama_file FROM dokumen WHERE id='$id'");
            $dt = mysqli_fetch_array($lama);
            if($dt && !empty($dt['nama_file'])) {
                if(file_exists("../assets/document/" . $dt['nama_file'])) {
                    unlink("../assets/document/" . $dt['nama_file']);
                }
            }

            $nama_file_asli = $_FILES['file_upload']['name'];
            $tmp_file = $_FILES['file_upload']['tmp_name'];
            $nama_file_baru = uniqid() . "." . pathinfo($nama_file_asli, PATHINFO_EXTENSION);
            
            move_uploaded_file($tmp_file, "../assets/document/" . $nama_file_baru);
            
            $query = "UPDATE dokumen SET nama='$judul', hak_akses='$hak_akses', nama_file='$nama_file_baru' WHERE id='$id'";
        } else {
            $query = "UPDATE dokumen SET nama='$judul', hak_akses='$hak_akses' WHERE id='$id'";
        }
        
        mysqli_query($koneksi, $query);
        header("Location: dokumen-admin.php?status=sukses_update");
    }

    // 3. LOGIKA HAPUS DOKUMEN
    if ($aksi == 'hapus') {
        $id = $_GET['id'];

        // Ambil nama file untuk dihapus dari folder assets/document
        $data = mysqli_query($koneksi, "SELECT nama_file FROM dokumen WHERE id='$id'");
        $row = mysqli_fetch_array($data);
        if($row && !empty($row['nama_file'])) {
            if(file_exists("../assets/document/" . $row['nama_file'])) {
                unlink("../assets/document/" . $row['nama_file']); 
            }
        }

        mysqli_query($koneksi, "DELETE FROM dokumen WHERE id='$id'");
        header("Location: dokumen-admin.php?status=sukses_hapus");
    }
}
?>