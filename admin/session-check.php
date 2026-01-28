<?php
// admin/session_check.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ATURAN WAKTU (30 MENIT)
$timeout_duration = 1800; 

// 1. Cek Login Dasar
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
    header("Location: login.php");
    exit();
}

// 2. Cek Timeout
if (isset($_SESSION['LAST_ACTIVITY'])) {
    if ((time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        // Jika waktu habis
        session_unset();
        session_destroy();
        header("Location: login.php?pesan=timeout");
        exit();
    }
}

// 3. Reset Waktu (User melakukan aktivitas baru)
$_SESSION['LAST_ACTIVITY'] = time();
?>