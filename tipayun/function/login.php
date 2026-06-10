<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $query = "SELECT * FROM tpy_user WHERE tip = '$id' AND password = '$password' AND level = 1";
    $result = $koneksi->query($query);

    if ($result->num_rows === 1) {
        $_SESSION['waktu_login'] = time();
        $_SESSION['id'] = $id;
        header('Location: auth');
        exit();
    } else {
        $error_message = 'Login gagal. Periksa kembali TIP ID dan password Anda.';
        echo "<script>console.log('$error_message');</script>";
    }
}
