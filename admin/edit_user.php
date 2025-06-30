<?php
session_start();
require 'functions.php';

// Cek apakah ada ID user yang dikirim
if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID user tidak ditemukan!');
            window.location.href = 'users.php';
          </script>";
    exit;
}

$id = intval($_GET['id']); // pastikan ID dalam bentuk integer

// Ambil data user berdasarkan ID
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<script>
            alert('User tidak ditemukan!');
            window.location.href = 'users.php';
          </script>";
    exit;
}

// Jika tombol simpan ditekan
if (isset($_POST['update'])) {
    $nama = trim(mysqli_real_escape_string($koneksi, $_POST['nama']));
    $username = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
    $role = trim(mysqli_real_escape_string($koneksi, $_POST['role']));

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query_update = "UPDATE users SET nama = '$nama', username = '$username', password = '$password', role = '$role' WHERE id = '$id'";
    } else {
        $query_update = "UPDATE users SET nama = '$nama', username = '$username', role = '$role' WHERE id = '$id'";
    }

    $update = mysqli_query($koneksi, $query_update);

    if ($update) {
        echo "<script>
                alert('Data user berhasil diperbarui!');
                window.location.href = 'users.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data user!');
                window.location.href = 'users.php';
              </script>";
    }
}
?>

<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control"
                        value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>"
                        required>
                </div>

                <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                <a href="users.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>