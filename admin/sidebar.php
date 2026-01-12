<style>
    :root { --sidebar-width: 280px; }
</style>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
$nav_items = [
    'admin-dashboard.php' => 'Dashboard',
    'manajemen-beranda.php' => 'Manajemen Beranda',
    'tentang-kami-admin.php' => 'Tentang Kami',
    'layanan-admin.php' => 'Manajemen Layanan',
    'tambah-berita-admin.php' => 'Berita',
    'profil-pegawai-admin.php' => 'Profil Pegawai',
    'dokumen-admin.php' => 'Dokumen',
    'pengaturan-admin.php' => 'Pengaturan Web',
];
?>

<div class="sidebar shadow">
    <div class="p-4 d-flex align-items-center mb-3">
        <div class="logo-box bg-white text-primary me-2 fw-bold">DK</div>
        <span class="fw-bold h5 mb-0">Admin Panel</span>
    </div>
    
    <nav class="d-grid">
        <?php foreach ($nav_items as $file => $label): ?>
            <a href="<?php echo $file; ?>" class="nav-admin-link <?php echo ($current_page === $file) ? 'active' : ''; ?>">
                <?php echo $label; ?>
            </a>
        <?php endforeach; ?>
        <div class="mt-4 px-3"><hr class="text-white opacity-25"></div>
        <a href="../index.html" class="nav-admin-link text-danger fw-bold"><i class="bi bi-box-arrow-right me-3"></i> Logout</a>
    </nav>
</div>
