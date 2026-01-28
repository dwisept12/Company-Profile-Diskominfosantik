<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_diskominfosantik");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function tgl_indo($tanggal, $singkat = false) {
    // 1. Cek jika tanggal kosong
    if(empty($tanggal) || $tanggal == '0000-00-00') {
        return "-";
    }

    // 2. Bersihkan format jam (Penting!)
    $tanggal = date('Y-m-d', strtotime($tanggal));

    // 3. Definisi Bulan Panjang
    $bulan_panjang = array (
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    // 4. Definisi Bulan Singkat
    $bulan_pendek = array (
        1 => 'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agt', // atau Agu
        'Sep',
        'Okt',
        'Nov',
        'Des'
    );
    
    $pecahkan = explode('-', $tanggal);
    
    // 5. Logika Pemilihan Array
    if ($singkat == true) {
        $nama_bulan = $bulan_pendek[ (int)$pecahkan[1] ];
    } else {
        $nama_bulan = $bulan_panjang[ (int)$pecahkan[1] ];
    }
    
    return $pecahkan[2] . ' ' . $nama_bulan . ' ' . $pecahkan[0];
}
?>