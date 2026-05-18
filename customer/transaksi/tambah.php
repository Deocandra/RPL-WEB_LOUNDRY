<?php

include '../../config/koneksi.php';

$nama_customer = $_POST['nama_customer'];
$no_hp = $_POST['no_hp'];
$id_layanan = $_POST['id_layanan'];
$berat = $_POST['berat'];

# CEK CUSTOMER

$cek = mysqli_query(
    $conn,
    "SELECT * FROM customer
    WHERE no_hp='$no_hp'"
);

$data_customer = mysqli_fetch_assoc($cek);

if($data_customer){

    $id_customer = $data_customer['id_customer'];

}else{

    mysqli_query($conn, "

        INSERT INTO customer
        (
            nama_customer,
            no_hp,
            password
        )

        VALUES
        (
            '$nama_customer',
            '$no_hp',
            MD5('12345')
        )

    ");

    $id_customer = mysqli_insert_id($conn);
}

# AMBIL HARGA LAYANAN

$layanan = mysqli_query(
    $conn,
    "SELECT * FROM layanan
    WHERE id_layanan='$id_layanan'"
);

$data_layanan = mysqli_fetch_assoc($layanan);

$total_harga =
    $data_layanan['harga_per_kg']
    * $berat;

# INSERT BOOKING

mysqli_query($conn, "

    INSERT INTO booking
    (
        id_customer,
        id_layanan,
        tanggal_booking,
        berat,
        total_harga,
        status
    )

    VALUES
    (
        '$id_customer',
        '$id_layanan',
        NOW(),
        '$berat',
        '$total_harga',
        'menunggu'
    )

");

echo "
<script>
alert('Booking berhasil');
window.location='../../index.php';
</script>
";

?>