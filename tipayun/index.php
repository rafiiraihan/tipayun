<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="src/css/tpy.css" />
  <link rel="icon" type="image/x-icon" href="assets/img/fav/favicon.ico" />
  <title>TIPAYUN - Jadwal Bus Dalam Kota</title>
</head>

<body>
  <div class="navbar">
    <div class="navbar-content">
      <div class="logo">
        <img src="assets/img/logo.png" alt="TIPAYUN" /><span>Tipayun</span>
      </div>
      <div class="box-menu">
        <a href="#" class="menu"><i tpy="rute"></i>Cari Rute</a>
        <a href="#" class="menu"><i tpy="bus"></i>Daftar Layanan Bus</a>
        <a href="#" class="menu"><i tpy="tiket"></i>Tarif Bus</a>
        <a href="#" class="menu"><i tpy="help"></i>Bantuan</a>
      </div>
      <div class="login"><i tpy="map"></i>Buka Map</div>
    </div>
  </div>
  <div class="banner">
    <div class="banner-content">
      <div class="heading">
        <h1>Naik Bus kini lebih mudah</h1>
        <span>
          Tidak perlu khawatir menentukan rute perjalanan dalam kota Anda!<br />
          Tipayun hadir untuk memberikan kenyamanan pada pengalaman
          transportasi Kota
        </span>
      </div>
      <div class="box-search">
        <form action="">
          <input type="text" class="search" placeholder="Cari rute perjalanan Anda" />
          <button type="submit">Cari Rute</button>
        </form>
      </div>
      <div class="box-suggest">
        <div class="suggest"><i tpy="bus"></i>Trans Metro Bandung</div>
        <div class="suggest"><i tpy="bus"></i>DAMRI</div>
        <div class="suggest"><i tpy="bus"></i>Trans Metro Pasundan</div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
  <script src="src/js/ikon.js"></script>
  <script src="src/js/gmaps.js"></script>
  <script src="src/js/tpy.js"></script>
</body>

</html>