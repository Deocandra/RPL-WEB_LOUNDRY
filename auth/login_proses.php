<?php

session_start();

include '../config/koneksi.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

# LOGIN CUSTOMER

$customer = mysqli_query(
    $conn,

    "SELECT * FROM customer
    WHERE email='$email'
    AND password='$password'"
);

$data_customer = mysqli_fetch_assoc($customer);

if($data_customer){

    $_SESSION['id_customer']
        = $data_customer['id_customer'];

    $_SESSION['nama_customer']
        = $data_customer['nama_customer'];

    $_SESSION['role']
        = 'customer';

    header(
        "Location: ../customer/dashboard.php"
    );

    exit;
}

# LOGIN ADMIN / KARYAWAN

$user = mysqli_query(
    $conn,

    "SELECT * FROM users
    WHERE username='$email'
    AND password='$password'"
);

$data_user = mysqli_fetch_assoc($user);

if($data_user){

    $_SESSION['id_user']
        = $data_user['id_user'];

    $_SESSION['nama']
        = $data_user['nama'];

    $_SESSION['role']
        = $data_user['role'];

    if($data_user['role'] == 'admin'){

        header(
            "Location: ../admin/dashboard.php"
        );

    }else{

        header(
            "Location: ../karyawan/dashboard.php"
        );

    }

}else{

    echo "
    <script>
    alert('Login gagal');
    window.location='../login.php';
    </script>
    ";

}

?>