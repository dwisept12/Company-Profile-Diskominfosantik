<?php
// Sertakan koneksi database

// LOGIKA HAPUS
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    // Perintah SQL: DELETE FROM layanan WHERE id = $id
    header("Location: layanan-admin.php?msg=terhapus");
    exit();
}

// LOGIKA UPDATE / TAMBAH
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aksi = $_POST['aksi'];
    if ($aksi == 'update') {
        $id = $_POST['id_layanan'];
        // Perintah SQL: UPDATE layanan SET nama_layanan=... WHERE id = $id
    } else {
        // Perintah SQL: INSERT INTO layanan ...
    }
    header("Location: layanan-admin.php?msg=sukses");
    exit();
}
?>