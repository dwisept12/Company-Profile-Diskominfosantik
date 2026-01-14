<?php
session_start(); // Memulai sesi keamanan
include 'db.php';

$username_admin = "admin_kominfo"; // Contoh username tetap (Ganti dengan data DB nanti)
$password_admin = "Kominfo2026!"; // Contoh password tetap (Ganti dengan data DB nanti)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Logika Pengecekan
    if ($user == $username_admin && $pass == $password_admin) {
        // Jika login berhasil
        $_SESSION['status_login'] = true;
        $_SESSION['user_admin'] = $user;
        
        header("Location: admin-dashboard.php"); // Masuk ke dashboard
    } else {
        // Jika login gagal
        header("Location: login.php?pesan=gagal");
    }
}
?>