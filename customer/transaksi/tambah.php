<?php

include '../../config/koneksi.php';

$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$id_layanan = $_POST['id_layanan'];
$berat = $_POST['berat'];

$query_layanan = mysqli_query(
    $conn,
    "SELECT * FROM layanan WHERE id_layanan='$id_layanan'"
);

$data_layanan = mysqli_fetch_assoc($query_layanan);

$total_harga =
    $data_layanan['harga_per_kg'] * $berat;

mysqli_query($conn, "

    INSERT INTO booking
    (
        id_layanan,
        tanggal_booking,
        berat,
        total_harga,
        status
    )

    VALUES
    (
        '$id_layanan',
        NOW(),
        '$berat',
        '$total_harga',
        'menunggu'
    )

");

echo "
<script>
alert('Booking berhasil!');
window.location='../../index.php';
</script>
";
?>