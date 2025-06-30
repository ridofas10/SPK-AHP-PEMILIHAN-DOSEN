        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-0">
                    <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Aplikasi SPK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-"></i>
                    <span>Input Data</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="data_nilai.php">
                    <i class="fas fa-graduation-cap"></i> <!-- Ikon untuk nilai atau akademik -->
                    <span>Data Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_kriteria.php">
                    <i class="fas fa-vials"></i> <!-- Ikon uji/coba/pengujian -->
                    <span>Data Kriteria</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_alternatif.php">
                    <i class="fas fa-book"></i> <!-- Ikon untuk data pelatihan/alternatif -->
                    <span>Data Alternatif</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-"></i>
                    <span>Analisa Data</span></a>
            </li>
            <!-- Nav Item - Analisa Kriteria -->
            <li class="nav-item">
                <a class="nav-link" href="analisa_kriteria.php">
                    <i class="fas fa-balance-scale"></i> <!-- Timbangan: cocok untuk analisis kriteria -->
                    <span>Analisa Kriteria</span>
                </a>
            </li>

            <!-- Nav Item - Analisa Alternatif -->
            <li class="nav-item">
                <a class="nav-link" href="analisa_alternatif.php">
                    <i class="fas fa-project-diagram"></i> <!-- Diagram: representasi hubungan antar alternatif -->
                    <span>Analisa Alternatif</span>
                </a>
            </li>

            <!-- Nav Item - Rangking -->
            <li class="nav-item">
                <a class="nav-link" href="rangking.php">
                    <i class="fas fa-sort-amount-down-alt"></i> <!-- Ranking: urutan dari atas ke bawah -->
                    <span>Rangking</span>
                </a>
            </li>

            <!-- Nav Item - Laporan -->
            <li class="nav-item">
                <a class="nav-link" href="export_preview.php">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export Rangking</span>
                </a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-"></i>
                    <span>Admin Area</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-user"></i>
                    <span>Profil</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->