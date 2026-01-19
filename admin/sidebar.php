<style>
    :root { --sidebar-width: 280px; }
</style>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
$nav_items = [
    'admin-dashboard.php' => 'Dashboard',
    'manajemen-beranda.php' => 'Beranda',
    'tentang-kami-admin.php' => 'Tentang Kami',
    'layanan-admin.php' => 'Layanan',
    'berita-admin.php' => 'Berita',
    'profil-pegawai-admin.php' => 'Profil Pegawai',
    'dokumen-admin.php' => 'Dokumen',
    'pengaturan-admin.php' => 'Pengaturan Web',
];
?>

<div class="sidebar shadow">
    <div class="p-3 d-flex align-items-center mb-1">
        <div class="logo-box bg-white text-primary me-2 fw-bold">DK</div>
        <span class="fw-bold h5 mb-0">Admin Panel</span>
    </div>
    
    <nav class="d-flex flex-column h-100 w-100">
        <div class="d-flex flex-column gap-1">
            <?php foreach ($nav_items as $file => $label): ?>
                <a href="<?php echo $file; ?>" class="nav-admin-link <?php echo ($current_page === $file) ? 'active' : ''; ?>">
                    <?php echo $label; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="mt-auto pb-3">
            
            <hr class="text-white opacity-25 my-2 mx-3">
            
            <a href="../index.html" class="nav-admin-link text-danger fw-bold">
                <i class="bi bi-box-arrow-right me-3"></i> Logout
            </a>
        </div>
    </nav>
</div>