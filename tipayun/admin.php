<?php
session_start();
include 'function/connect.php';

if (isset($_SESSION['auth_berhasil'])) {
  if (isset($_SESSION['waktu_login'])) {
    $waktu_login = $_SESSION['waktu_login'];
    $current_time = time();
    $time_diff = $current_time - $waktu_login;
    if ($time_diff > 3600) {
      session_unset();
      session_destroy();
      header('Location: admin');
      exit();
    } else {
      header('Location: dashboard');
      exit();
    }
  } else {
    header('Location: admin');
    exit();
  }
}

include 'function/login.php';

$koneksi->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="src/css/tpy.css" />
  <link rel="icon" type="image/x-icon" href="assets/img/fav/favicon.ico" />
  <title>TIPAYUN - Login TCC</title>
</head>

<body class="accl">
  <div class="acc-box-login">
    <div class="acc-login-header">
      <img src="assets/img/logo.png" alt="TIPAYUN" />
      <h1>Tipayun Command Center</h1>
    </div>
    <form method="POST">
      <div class="acc-login-detail">
        <div class="acc-login-input">
          <label for="id">TIP ID</label>
          <input class="acc-login-field" type="text" id="id" name="id" placeholder="ID" />
        </div>
        <div class="acc-login-input">
          <label for="password">Password</label>
          <input class="acc-login-field" type="password" id="password" name="password" placeholder="Password" />
        </div>
      </div>
      <button type="submit">Login</button>
    </form>
    <span>
      Kehilangan Akses TIP ID ? <br />
      Hubungi <a href="">Tipayun Help</a>
    </span>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
  <script src="src/js/ikon.js"></script>
  <script src="src/js/gmaps.js"></script>
  <script src="src/js/tpy.js"></script>
</body>

</html>