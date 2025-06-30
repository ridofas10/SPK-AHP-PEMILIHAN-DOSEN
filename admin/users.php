<?php 
include 'header.php'; 
require 'functions.php';

// Ambil semua data user dari database tanpa filter level
$query = "SELECT * FROM users ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="user.php" class="btn btn-success"><i class="fa fa-user-plus"></i>&nbsp;Tambah User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($result)) :
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['username']); ?></td>
                                    <td><?= htmlspecialchars($data['role']); ?></td>
                                    <td><?= htmlspecialchars($data['nama']); ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>&nbsp;Edit
                                        </a>
                                        <a href="hapus_user.php?id=<?= $data['id'] ?>"
                                            class="btn btn-danger btn-sm delete-btn" data-id="<?= $data['id']; ?>">
                                            <i class="fa fa-trash"></i>&nbsp;Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- SweetAlert untuk konfirmasi hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const userId = this.getAttribute("data-id");
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data pengguna akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "hapus_user.php?id=" + userId;
                }
            });
        });
    });
});
</script>

<?php include 'footer.php'; ?>