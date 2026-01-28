<?php
session_start(); 
include 'db.php';

// DATA DUMMY (Hardcode)
// Catatan: Lebih aman jika ambil dari database, tapi untuk contoh ini kita pakai hardcode dulu.
$username_admin = "admin_kominfo";
$password_admin = "Kominfo2026!";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil inputan user dan amankan sedikit
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = $_POST['password'];

    // LOGIKA PENGECEKAN
    if ($user == $username_admin && $pass == $password_admin) {
        
        // ==========================
        // LOGIN BERHASIL
        // ==========================
        $_SESSION['status_login'] = true;
        $_SESSION['user_admin']   = $user;
        
        // Simpan ID dummy (karena hardcode, kita buat ID manual, misal 1)
        $_SESSION['id'] = 1; 

        // ----------------------------------------------------
        // FITUR TIMEOUT (PENTING)
        // Set waktu awal aktivitas saat login sukses
        // ----------------------------------------------------
        $_SESSION['LAST_ACTIVITY'] = time(); 

        // Redirect ke Dashboard
        header("Location: admin-dashboard.php");
        exit(); // PENTING: Hentikan script setelah redirect

    } else {
        
        // ==========================
        // LOGIN GAGAL
        // ==========================
        header("Location: login.php?pesan=gagal");
        exit();
    }
}
?>