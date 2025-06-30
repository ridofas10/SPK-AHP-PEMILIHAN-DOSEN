<?php
session_start();
require 'functions.php';

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    echo "<script>
            alert('Anda harus login terlebih dahulu!');
            window.location.href = '../index.php';
          </script>";
    exit;
}

$user_id = $_SESSION['id'];

// Ambil data user yang sedang login
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<script>
            alert('Data pengguna tidak ditemukan!');
            window.location.href = 'index.php';
          </script>";
    exit;
}

// Proses update profil
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    if (!empty($nama) && !empty($username)) {
        $updateQuery = "UPDATE users SET nama = '$nama', username = '$username', password = '$password' WHERE id = '$user_id'";
        $updateResult = mysqli_query($koneksi, $updateQuery);

        if ($updateResult) {
            echo "<script>
                    alert('Profil berhasil diperbarui!');
                    window.location.href = 'profile.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal memperbarui profil!');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Nama dan username tidak boleh kosong!');
              </script>";
    }
}
include 'header.php';
?>



<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profil</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?= htmlspecialchars($user['nama']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?= htmlspecialchars($user['username']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>