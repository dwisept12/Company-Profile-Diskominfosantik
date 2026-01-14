<?php
include 'db.php';

// 1. LOGIKA HAPUS (via URL)
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    // Eksekusi SQL: DELETE FROM pegawai WHERE id = $id
    header("Location: profil-pegawai-admin.php?status=terhapus");
    exit();
}

// 2. LOGIKA UPDATE / TAMBAH (via POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aksi = $_POST['aksi'];
    if ($aksi == 'update') {
        $id = $_POST['id_pegawai'];
        // Eksekusi SQL: UPDATE pegawai SET nama=..., tugas=... WHERE id = $id
    }
    header("Location: profil-pegawai-admin.php?status=sukses");
    exit();
}