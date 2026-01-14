<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['aksi'])) {
    
    // Tentukan aksi (apakah dari form POST atau dari link GET)
    $aksi = isset($_POST['aksi']) ? $_POST['aksi'] : (isset($_GET['aksi']) ? $_GET['aksi'] : '');

    // 1. LOGIKA UNGGAH DOKUMEN BARU
    if ($aksi == 'tambah') {
        $judul = $_POST['judul'];
        $hak_akses = $_POST['hak_akses'];
        
        // Pengaturan File
        $nama_file = $_FILES['file_upload']['name'];
        $tmp_file = $_FILES['file_upload']['tmp_name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        
        // Beri nama unik agar tidak bentrok
        $nama_file_baru = uniqid() . "." . $ekstensi;
        $target_folder = "../uploads/dokumen/" . $nama_file_baru;

        if (move_uploaded_file($tmp_file, $target_folder)) {
            // Jalankan Query Insert
            // $query = "INSERT INTO dokumen (judul, file, hak_akses) VALUES ('$judul', '$nama_file_baru', '$hak_akses')";
            // mysqli_query($koneksi, $query);
            
            header("Location: dokumen-admin.php?status=sukses_unggah");
        } else {
            header("Location: dokumen-admin.php?status=gagal_unggah");
        }
    }

    // 2. LOGIKA UPDATE DOKUMEN
    if ($aksi == 'update') {
        $id = $_POST['id_dokumen'];
        $judul = $_POST['judul'];
        $hak_akses = $_POST['hak_akses'];

        // Cek apakah ada file baru yang diunggah
        if (!empty($_FILES['file_upload']['name'])) {
            $nama_file = $_FILES['file_upload']['name'];
            $tmp_file = $_FILES['file_upload']['tmp_name'];
            $nama_file_baru = uniqid() . "." . pathinfo($nama_file, PATHINFO_EXTENSION);
            
            move_uploaded_file($tmp_file, "../uploads/dokumen/" . $nama_file_baru);
            
            // Query Update dengan file baru
            // $query = "UPDATE dokumen SET judul='$judul', hak_akses='$hak_akses', file='$nama_file_baru' WHERE id='$id'";
        } else {
            // Query Update tanpa ganti file
            // $query = "UPDATE dokumen SET judul='$judul', hak_akses='$hak_akses' WHERE id='$id'";
        }
        
        // mysqli_query($koneksi, $query);
        header("Location: dokumen-admin.php?status=sukses_update");
    }

    // 3. LOGIKA HAPUS DOKUMEN
    if ($aksi == 'hapus') {
        $id = $_GET['id'];

        // Ambil nama file dari database untuk dihapus dari folder
        // $data = mysqli_query($koneksi, "SELECT file FROM dokumen WHERE id='$id'");
        // $row = mysqli_fetch_array($data);
        // unlink("../uploads/dokumen/" . $row['file']); // Menghapus file fisik

        // Hapus data dari database
        // mysqli_query($koneksi, "DELETE FROM dokumen WHERE id='$id'");
        
        header("Location: dokumen-admin.php?status=sukses_hapus");
    }
}
?>