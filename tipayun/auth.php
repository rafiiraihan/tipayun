<?php
session_start();

include 'function/auth.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="src/css/tpy.css" />
    <link rel="icon" type="image/x-icon" href="assets/img/fav/favicon.ico" />
    <title>TIPAYUN - Autentikasi</title>
</head>

<body class="accl" id="accl-auth">
    <div class="acc-box-login">
        <div class="acc-login-header">
            <img src="assets/img/logo.png" alt="TIPAYUN" />
            <h1>Tipayun Command Center</h1>
        </div>
        <img src="assets/img/auth.png" alt="Verifikasi Kode">
        <span>Silahkan konfirmasi kode akses akun anda</span>
        <form method="POST">
            <div class="acc-login-detail">
                <div class="acc-login-input" id="gAuth">
                    <label for="gAuth">VERIFIKASI 2FA</label>
                    <input class="acc-auth-field" type="text" id="gAuth" name="gAuth" placeholder="PIN" />
                </div>
            </div>
            <button type="submit">Verifikasi</button>
        </form>
        <span>
            <a href="">Kembali</a>
        </span>
    </div>
    <script src="src/js/tpy.js"></script>
</body>

</html>