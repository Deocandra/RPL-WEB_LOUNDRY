<?php

include '../auth/session.php';
include '../config/koneksi.php';

$total_customer = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM customer")
);

$total_booking = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM booking")
);

$total_layanan = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM layanan")
);

$total_pendapatan = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT SUM(total_harga) as total
        FROM booking"
    )

);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../assets/css/dashboard.css"
    >

</head>

<body>

<?php include '../templates/sidebar.php'; ?>

<div class="content">

    <h2 class="mb-4">
        Dashboard Admin
    </h2>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card card-dashboard shadow p-3">

                <h5>Total Customer</h5>

                <h2>
                    <?= $total_customer; ?>
                </h2>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card card-dashboard shadow p-3">

                <h5>Total Booking</h5>

                <h2>
                    <?= $total_booking; ?>
                </h2>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card card-dashboard shadow p-3">

                <h5>Total Layanan</h5>

                <h2>
                    <?= $total_layanan; ?>
                </h2>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card card-dashboard shadow p-3">

                <h5>Pendapatan</h5>

                <h4>
                    Rp
                    <?= number_format(
                        $total_pendapatan['total']
                    ); ?>
                </h4>

            </div>

        </div>

    </div>

</div>

</body>
</html>