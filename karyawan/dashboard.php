<?php

include '../auth/session.php';
include '../config/koneksi.php';

$diproses = mysqli_num_rows(

    mysqli_query(
        $conn,
        "SELECT * FROM booking
        WHERE status='diproses'"
    )

);

$selesai = mysqli_num_rows(

    mysqli_query(
        $conn,
        "SELECT * FROM booking
        WHERE status='selesai'"
    )

);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard Karyawan</title>

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
        Dashboard Karyawan
    </h2>

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow p-4">

                <h5>Laundry Diproses</h5>

                <h1>
                    <?= $diproses; ?>
                </h1>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow p-4">

                <h5>Laundry Selesai</h5>

                <h1>
                    <?= $selesai; ?>
                </h1>

            </div>

        </div>

    </div>

</div>

</body>
</html>