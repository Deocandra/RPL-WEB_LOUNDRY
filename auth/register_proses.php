<?php

include '../config/koneksi.php';

$nama_customer = $_POST['nama_customer'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

$query = mysqli_query($conn, "

    INSERT INTO customer
    (
        nama_customer,
        email,
        password,
        alamat,
        no_hp
    )

    VALUES
    (
        '$nama_customer',
        '$email',
        '$password',
        '$alamat',
        '$no_hp'
    )

");

if($query){

    echo "
    <script>
    alert('Registrasi berhasil');
    window.location='../login.php';
    </script>
    ";

}else{

    echo "
    <script>
    alert('Registrasi gagal');
    window.location='../register.php';
    </script>
    ";

}

?>