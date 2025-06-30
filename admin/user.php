<?php 
session_start();
require 'functions.php';

$message = ""; // Variabel untuk menampung pesan alert

if (isset($_POST["register"])) {
    $result = registrasi($_POST);

    if ($result === "success") {
        $message = "Swal.fire('Berhasil!', 'User baru berhasil ditambahkan!', 'success');";
    } else {
        $message = "Swal.fire('Oops...', '$result', 'error');";
    }
}
?>

<?php include 'header.php'; ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (!empty($message)): ?>
<script>
<?= $message ?>
</script>
<?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registrasi User</h1>
    </div>

    <div class="row">
        <div class="container">
            <h2>Form Registrasi</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password2">Konfirmasi Password:</label>
                    <input type="password" name="password2" id="password2" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>