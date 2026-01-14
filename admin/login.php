<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Diskominfosantik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="login-page-body">

    <div class="login-container">
        <div class="card login-card">
            <div class="login-card-body">
                <div class="text-center">
                    <div class="logo-box fw-bold shadow">DK</div>
                    <h4 class="fw-bold text-navy mb-1">Admin Panel</h4>
                    <p class="text-muted small mb-4">Diskominfosantik Kabupaten Bekasi</p>
                </div>

                <form action="proses-login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Masukkan username" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-navy">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" name="password" id="passwordField" class="form-control bg-light border-start-0 border-end-0" placeholder="********" required>
                            <span class="input-group-text bg-light border-start-0 rounded-end-3" style="cursor: pointer;" onclick="togglePassword()">
                                <i class="bi bi-eye text-muted" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-navy-login w-100">
                        Masuk Sekarang <i class="bi bi-arrow-right-short ms-2"></i>
                    </button>
                    
                    <div class="text-center mt-4">
                        <a href="../index.html" class="text-decoration-none small text-muted">Kembali ke Beranda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Show/Hide Password
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        // Cek notifikasi gagal login dari URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('pesan') === 'gagal') {
            Swal.fire({
                title: 'Akses Ditolak!',
                text: 'Username atau Password salah.',
                icon: 'error',
                confirmButtonColor: '#003366',
                borderRadius: '15px'
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>