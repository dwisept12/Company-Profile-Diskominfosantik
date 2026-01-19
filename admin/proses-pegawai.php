<?php
include 'db.php';

// Folder tempat menyimpan foto
// Pastikan folder 'pegawai' sudah dibuat di dalam assets/img/
$target_dir = "../assets/img/pegawai/";

// ==========================================
// 1. LOGIKA HAPUS DATA
// ==========================================
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = (int) $_GET['id'];

    // A. Ambil nama foto lama dulu
    $q_foto = mysqli_query($koneksi, "SELECT foto FROM pegawai WHERE id = $id");
    $data_foto = mysqli_fetch_assoc($q_foto);

    // B. Hapus file fisik jika ada
    $file_path = $target_dir . $data_foto['foto'];
    if (file_exists($file_path) && $data_foto['foto'] != '') {
        unlink($file_path); 
    }

    // C. Hapus data dari database
    $query = "DELETE FROM pegawai WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: profil-pegawai-admin.php?status=sukses_hapus");
    } else {
        header("Location: profil-pegawai-admin.php?status=gagal&msg=" . urlencode(mysqli_error($koneksi)));
    }
    exit();
}

// ==========================================
// 2. LOGIKA TAMBAH & UPDATE
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil Data Form & Amankan
    $aksi    = $_POST['aksi'];
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nip     = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $tugas   = mysqli_real_escape_string($koneksi, $_POST['tugas']);
    $urutan  = (int) $_POST['urutan'];

    // --- A. PROSES JSON PENDIDIKAN (Update Struktur Baru) ---
    // Ambil semua array input
    $jenjang_input = $_POST['jenjang'];
    $jurusan_input = $_POST['jurusan'];
    $kampus_input  = $_POST['kampus'];
    $tahun_input   = $_POST['tahun'];
    
    $list_pendidikan = [];
    
    if (!empty($jenjang_input)) {
        foreach ($jenjang_input as $key => $val) {
            // Simpan hanya jika Jenjang & Kampus tidak kosong
            if (!empty($val) && !empty($kampus_input[$key])) {
                $list_pendidikan[] = [
                    'jenjang' => $val,                  // S1, S2, D3
                    'jurusan' => $jurusan_input[$key],  // Teknik Informatika
                    'kampus'  => $kampus_input[$key],   // Universitas Indonesia
                    'tahun'   => $tahun_input[$key]     // 2023
                ];
            }
        }
    }
    // Ubah jadi JSON
    $json_pendidikan = json_encode($list_pendidikan);

    // --- B. PROSES UPLOAD FOTO (DENGAN VALIDASI) ---
    $nama_foto_db = "";
    
    // Cek apakah ada file baru yang diupload?
    if (!empty($_FILES['foto']['name'])) {
        $nama_file_asli = $_FILES['foto']['name'];
        $ukuran_file    = $_FILES['foto']['size'];
        $tipe_file      = $_FILES['foto']['type'];
        $error          = $_FILES['foto']['error'];
        
        // Ambil Ekstensi File (jpg, png, dll) dan ubah ke huruf kecil semua
        $ext = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));

        // --- VALIDASI 1: TIPE FILE ---
        // Hanya boleh JPG, JPEG, dan PNG
        $ekstensi_diperbolehkan = ['jpg', 'jpeg', 'png'];
        
        if (!in_array($ext, $ekstensi_diperbolehkan)) {
            // Jika format salah, kembalikan ke halaman sebelumnya dengan pesan error
            header("Location: profil-pegawai-admin.php?status=gagal&code=400&msg=" . urlencode("Format file tidak valid! Hanya boleh JPG, JPEG, atau PNG."));
            exit(); 
        }

        // --- VALIDASI 2: UKURAN FILE ---
        // Maksimal 2 MB (2,097,152 Bytes)
        if ($ukuran_file > 2097152) {
            header("Location: profil-pegawai-admin.php?status=gagal&code=400&msg=" . urlencode("Ukuran file terlalu besar! Maksimal 2MB."));
            exit();
        }

        // --- JIKA LOLOS VALIDASI, LANJUT RENAME ---
        
        $nama_pegawai = $_POST['nama']; 
        $nama_bersih = preg_replace('/[^A-Za-z0-9]/', '_', $nama_pegawai);
        $nama_bersih = substr($nama_bersih, 0, 50);

        // Buat Nama Baru
        $nama_baru = date("Y-m-d") . "_" . rand(100, 999) . "_" . $nama_bersih . "." . $ext;
        
        // Pindahkan file
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $nama_baru)) {
            $nama_foto_db = $nama_baru;
        } else {
            header("Location: profil-pegawai-admin.php?status=gagal&code=500&msg=" . urlencode("Gagal mengupload file ke folder server."));
            exit();
        }
    }

    // --- C. EKSEKUSI DATABASE ---
    
    if ($aksi == 'tambah') {
        $query = "INSERT INTO pegawai (nama, nip, jabatan, foto, urutan, bidang_tugas, riwayat_pendidikan) 
                  VALUES ('$nama', '$nip', '$jabatan', '$nama_foto_db', '$urutan', '$tugas', '$json_pendidikan')";

    } elseif ($aksi == 'update') {
        $id = (int) $_POST['id_pegawai'];

        // Jika ada foto baru, HAPUS foto lama
        if ($nama_foto_db != "") {
            $q_lama = mysqli_query($koneksi, "SELECT foto FROM pegawai WHERE id = $id");
            $dt_lama = mysqli_fetch_assoc($q_lama);
            
            if (file_exists($target_dir . $dt_lama['foto']) && $dt_lama['foto'] != "") {
                unlink($target_dir . $dt_lama['foto']);
            }

            // Update data + foto baru
            $query = "UPDATE pegawai SET 
                      nama = '$nama', nip = '$nip', jabatan = '$jabatan', 
                      foto = '$nama_foto_db', urutan = '$urutan', 
                      bidang_tugas = '$tugas', riwayat_pendidikan = '$json_pendidikan'
                      WHERE id = $id";
        } else {
            // Update data saja (foto tetap yang lama)
            $query = "UPDATE pegawai SET 
                      nama = '$nama', nip = '$nip', jabatan = '$jabatan', 
                      urutan = '$urutan', 
                      bidang_tugas = '$tugas', riwayat_pendidikan = '$json_pendidikan'
                      WHERE id = $id";
        }
    }

    // Jalankan Query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: profil-pegawai-admin.php?status=sukses");
    } else {
        $error_code = mysqli_errno($koneksi); // Ambil angka error (misal: 1062)
        $error_msg  = urlencode(mysqli_error($koneksi)); // Ambil pesan teks
        // Kirim code & msg ke URL
        header("Location: profil-pegawai-admin.php?status=gagal&code=$error_code&msg=$error_msg");
    }
    exit();
}
?>