<?php
include 'config/koneksi.php';
include 'templates/header.php';
include 'templates/navbar.php';

$query = mysqli_query($conn, "SELECT * FROM layanan");
?>

<!-- HERO SECTION -->
<section class="hero text-center text-white d-flex align-items-center">
    <div class="container">
        <h1 class="fw-bold">
            Laundry Cepat & Bersih
        </h1>

        <p>
            Solusi laundry terpercaya untuk pakaian Anda
        </p>

        <a href="#booking" class="btn btn-warning btn-lg">
            Booking Sekarang
        </a>
    </div>
</section>

<!-- LAYANAN -->
<section id="layanan" class="container mt-5">

    <h2 class="text-center mb-4">
        Layanan Kami
    </h2>

    <div class="row">

        <?php while($data = mysqli_fetch_assoc($query)) { ?>

            <div class="col-md-4 mb-4">

                <div class="card shadow">

                    <div class="card-body text-center">

                        <h4>
                            <?= $data['nama_layanan']; ?>
                        </h4>

                        <h5 class="text-primary">
                            Rp <?= number_format($data['harga_per_kg']); ?>/kg
                        </h5>

                        <p>
                            <?= $data['deskripsi']; ?>
                        </p>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</section>

<!-- BOOKING -->
<section id="booking" class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="text-center mb-4">
            Form Booking Laundry
        </h2>

        <form action="customer/transaksi/tambah.php" method="POST">

            <div class="mb-3">
                <label>Nama</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input
                    type="text"
                    name="no_hp"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label>Pilih Layanan</label>

                <select
                    name="id_layanan"
                    class="form-control"
                    required
                >

                    <option value="">
                        -- Pilih Layanan --
                    </option>

                    <?php
                    $layanan = mysqli_query(
                        $conn,
                        "SELECT * FROM layanan"
                    );

                    while($l = mysqli_fetch_assoc($layanan)) {
                    ?>

                        <option value="<?= $l['id_layanan']; ?>">
                            <?= $l['nama_layanan']; ?>
                        </option>

                    <?php } ?>

                </select>
            </div>

            <div class="mb-3">
                <label>Berat Laundry (Kg)</label>

                <input
                    type="number"
                    step="0.1"
                    name="berat"
                    class="form-control"
                    required
                >
            </div>

            <button class="btn btn-primary w-100">
                Booking Sekarang
            </button>

        </form>

    </div>

</section>

<?php include 'templates/footer.php'; ?>