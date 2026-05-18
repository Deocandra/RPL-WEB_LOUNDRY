<?php

include '../auth/session.php';
include '../config/koneksi.php';

$id_customer = $_SESSION['id_customer'];

$total_booking = mysqli_num_rows(

    mysqli_query(
        $conn,

        "SELECT * FROM booking
        WHERE id_customer='$id_customer'"
    )

);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard Customer</title>

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
        Dashboard Customer
    </h2>

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow p-4">

                <h5>Total Laundry</h5>

                <h1>
                    <?= $total_booking; ?>
                </h1>

            </div>

        </div>

    </div>

</div>

</body>
</html>