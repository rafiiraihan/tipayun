<?php
session_start();

include 'function/setsesi.php';
include 'function/connect.php';
include 'function/dbdasbor.php';

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
  <title>TPY Command Center</title>
</head>

<body class="acc">
  <div class="acc-tablet">
    <div class="acc-dash-menu">
      <div class="acc-menu-box">
        <div class="acc-menu-logo">
          <img src="assets/img/logo.png" alt="TIPAYUN" />
          <span><b>command</b>center</span>
        </div>
        <div class="acc-menu-content">
          <div class="acc-menu-title">TIPAYUN MANAGEMENT</div>
          <div class="acc-menu-list">
            <a class="acc-list active" href=""><i tpy="home"></i>Beranda</a>
            <a class="acc-list" href="rute"><i tpy="rute2"></i>Rute</a>
            <a class="acc-list" href="halte"><i tpy="stop"></i>Halte / Stop</a>
            <a class="acc-list" href="layanan"><i tpy="layanan"></i>Layanan</a>
          </div>
          <div class="acc-menu-title">LAINNYA</div>
          <div class="acc-menu-list">
            <a class="acc-list" href="#"><i tpy="lihat"></i>Preview Map</a>
          </div>
        </div>
      </div>
      <div class="acc-menu-profile">
        <div class="acc-profile-ctr">
          <img src="assets/content/profile.png" alt="" /><?php echo $nama; ?>
          <a href="logout"><i tpy="logout"></i></a>
        </div>
      </div>
    </div>
    <div class="acc-konten-area">
      <div class="acc-konten-title">
        <h1>Beranda</h1>
        <span id="tgl"></span>
      </div>
      <div class="acc-dashboard">
        <div class="acc-dsb-stats">
          <div class="stats-box">
            <div class="stats-box-title">Jumlah Rute<i tpy="rute2"></i></div>
            <div class="stats-box-value" id="stats-rute"><?php echo $jumlah_rute; ?> Rute</div>
          </div>
          <div class="stats-box">
            <div class="stats-box-title">Jumlah Halte<i tpy="stop"></i></div>
            <div class="stats-box-value" id="stats-halte"><?php echo $jumlah_halte; ?> Halte</div>
          </div>
          <div class="stats-box">
            <div class="stats-box-title">Jumlah Stop<i tpy="stop"></i></div>
            <div class="stats-box-value" id="stats-stop"><?php echo $jumlah_stop; ?> Stop</div>
          </div>
          <div class="stats-box">
            <div class="stats-box-title">Jumlah Layanan<i tpy="layanan"></i></div>
            <div class="stats-box-value" id="stats-layanan"><?php echo $jumlah_layanan; ?> Layanan</div>
          </div>
        </div>

        <div class="acc-dsb-info">
          <div class="info-box">
            <h2>Peta Kota Bandung</h2>
            <div class="info-map"></div>
          </div>
          <div class="info-box-extra">
            <div class="extra-info">
              <div class="extra-info-title" id="cuaca-x">
                <div class="extra-info-title-heading">
                  <h2>Cuaca</h2>
                  <span></span>
                </div>
              </div>
              <div class="extra-info-desc">
                <span></span>
                <p></p>
              </div>
            </div>
            <div class="extra-info">
              <div class="extra-info-title">
                <div class="extra-info-title-heading">
                  <h2>Kemacetan</h2>
                  <span>Kota Bandung</span>
                </div>
                <i tpy="macet2"></i>
              </div>
              <div class="extra-info-desc" id="kemacetan">
                <span class="statusMacet" id="lancar">Normal</span>
              </div>
            </div>
          </div>
        </div>
        <div class="acc-dsb-extra">
          <div class="extra-box-pjg">
            <h2>Rute Terbaru</h2>
            <div class="extra-rute">
              <?php echo $dari; ?>
              <i tpy="to"></i>
              <?php echo $tujuan; ?>
            </div>
          </div>
          <div class="extra-box-pdk">
            <h2>Harga Tiket</h2>
            <div class="extra-desc"><span><?php echo "Rp " . $harga; ?></span><?php echo $nama_rute; ?></div>
          </div>
          <div class="extra-box-pdk">
            <h2>Jarak Rute</h2>
            <div class="extra-desc"><span><?php echo $jarak; ?> km</span>Satu Arah</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
  <script src="src/js/ikon.js"></script>
  <script src="src/js/gmaps.js"></script>
  <script src="src/js/tpy.js"></script>
  <script src="src/js/cuaca.js"></script>
</body>

</html>