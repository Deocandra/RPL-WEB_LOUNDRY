<div class="sidebar">

    <h3 class="text-center mb-4">
        WEB LAUNDRY
    </h3>

    <?php if($_SESSION['role'] == 'admin') { ?>

        <a href="../admin/dashboard.php">
            Dashboard
        </a>

        <a href="../admin/layanan/index.php">
            Data Layanan
        </a>

        <a href="../admin/transaksi/index.php">
            Data Transaksi
        </a>

        <a href="../admin/laporan/index.php">
            Laporan
        </a>

    <?php } ?>

    <?php if($_SESSION['role'] == 'karyawan') { ?>

        <a href="../karyawan/dashboard.php">
            Dashboard
        </a>

        <a href="../karyawan/transaksi/index.php">
            Transaksi
        </a>

    <?php } ?>

    <?php if($_SESSION['role'] == 'customer') { ?>

        <a href="../customer/dashboard.php">
            Dashboard
        </a>

        <a href="../customer/transaksi/riwayat.php">
            Riwayat Laundry
        </a>

        <a href="../customer/profile/index.php">
            Profile
        </a>

    <?php } ?>

    <a href="../auth/logout_proses.php">
        Logout
    </a>

</div>