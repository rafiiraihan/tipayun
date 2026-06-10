<?php
session_start();

include 'function/setsesi.php';
include 'function/connect.php';
include 'function/tablerute.php';

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
  <title>TPY Command Center - Rute</title>
</head>

<body class="acc">
  <div class="redup"></div>
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
            <a class="acc-list" href="dashboard"><i tpy="home"></i>Beranda</a>
            <a class="acc-list active" href="rute"><i tpy="rute2"></i>Rute</a>
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
        <div class="acc-menu-profile">
          <div class="acc-profile-ctr">
            <img src="assets/content/profile.png" alt="" /><?php echo $nama; ?>
            <a href="logout"><i tpy="logout"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="acc-konten-area">
      <div class="acc-konten-title">
        <h1>Rute</h1>
        <span id="tgl"></span>
      </div>
      <div class="acc-rute">
        <div class="table-head">
          <h2>Daftar Rute</h2>
          <input class="table-search" type="text" id="searchInput" placeholder="Cari Data">
        </div>
        <table>
          <thead id="rute">
            <tr>
              <th>No</th>
              <th>Nama Rute</th>
              <th>Dari</th>
              <th>Tujuan</th>
              <th>Harga</th>
              <th>Jarak</th>
              <th>Layanan</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="rute" class="tbody-rute">
            <?php if (!empty($rutes)) { ?>
              <?php foreach ($rutes as $rute) { ?>
                <tr>
                  <td><?php echo $rute['id_rute']; ?></td>
                  <td><?php echo $rute['nama_rute']; ?></td>
                  <td><?php echo $rute['dari']; ?></td>
                  <td><?php echo $rute['tujuan']; ?></td>
                  <td>Rp <?php echo $rute['harga']; ?></td>
                  <td><?php echo $rute['jarak']; ?> km</td>
                  <td>
                    <div class="tbl-trayek"><i tpy="bus"></i><?php echo $rute['singkatan']; ?></div>
                  </td>
                  <td>
                    <button class="tbl-edit" data-id="<?php echo $rute['id_rute']; ?>"><i tpy="edit"></i></button>
                  </td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="8">Tidak ada data rute yang tersedia.</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="acc-navbox">
          <div class="acc-nav-tampil">
            Menampilkan <b><?php echo $dataDitampilkan; ?></b> dari <b><?php echo $totalData; ?></b> Rute
          </div>
          <div class="acc-navigation">
            <?php if ($totalData > 0) : ?>
              <?php if ($currentPage > 1) : ?>
                <a href="rute?hal=<?php echo $currentPage - 1; ?>" class="nav-hal"><i tpy="prev"></i></a>
              <?php else : ?>
                <span class="nav-hal disabled"><i tpy="prev"></i></span>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <a href="rute?hal=<?php echo $i; ?>" class="nav-hal<?php echo ($i == $currentPage) ? ' active' : ''; ?>"><?php echo $i; ?></a>
              <?php endfor; ?>

              <?php if ($currentPage < $jumlahHalaman) : ?>
                <a href="rute?hal=<?php echo $currentPage + 1; ?>" class="nav-hal"><i tpy="next"></i></a>
              <?php else : ?>
                <span class="nav-hal disabled"><i tpy="next"></i></span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <button class="tbl-buat" id="tbl-rute">Tambah Rute</button>
        </div>

      </div>
    </div>
  </div>

  <div class="detail-box" id="buat-rute">
    <form method="post" id="form-rute" action="">
      <div class="detail-box-isi">
        <div class="detail-box-judul">
          <h1>Buat Rute Baru</h1>
          <button class="detail-box-tutup"><i tpy="batal"></i></button>
        </div>
        <div class="detail-box-konten">
          <div class="detail-box-isian">
            <label for="isi-layanan">Layanan:</label>
            <select id="isi-layanan" name="isi-layanan" class="detail-box-field">
              <option value="" selected disabled>Pilih Layanan Bus</option>
              <?php
              while ($rowLayanan = mysqli_fetch_assoc($resultLayanan)) {
                echo '<option value="' . $rowLayanan['id_layanan'] . '">' . $rowLayanan['singkatan'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="detail-box-isian">
            <label for="isi-rute">Nama Rute:</label>
            <input type="text" id="isi-rute" name="isi-rute" class="detail-box-field" />
          </div>
          <div class="detail-box-isian">
            <label for="isi-dari">Dari:</label>
            <select id="isi-dari" name="isi-dari" class="detail-box-field">
              <option value="" selected disabled>Pilih Halte/Terminal Keberangkatan</option>
              <?php
              while ($rowHalte = mysqli_fetch_assoc($resultHalte)) {
                echo '<option value="' . $rowHalte['nama_halte'] . '">' . $rowHalte['nama_halte'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="detail-box-isian">
            <label for="isi-tujuan">Tujuan:</label>
            <select id="isi-tujuan" name="isi-tujuan" class="detail-box-field">
              <option value="" selected disabled>Pilih Halte/Terminal Tujuan</option>
              <?php
              mysqli_data_seek($resultHalte, 0);
              while ($rowHalte = mysqli_fetch_assoc($resultHalte)) {
                echo '<option value="' . $rowHalte['nama_halte'] . '">' . $rowHalte['nama_halte'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="detail-box-isian">
            <label for="isi-harga">Harga:</label>
            <input type="text" id="isi-harga" name="isi-harga" class="detail-box-field" />
          </div>
        </div>
        <div class="detail-box-kontrol">
          <button class="tbl-dtl" id="dtl-bersih">Bersihkan</button>
          <button class="tbl-dtl" id="dtl-buat" name="dtl-buat">Buat</button>
        </div>
      </div>
    </form>
  </div>

  <div class="detail-box" id="ubah-rute">
    <form method="post" id="form-ubah-rute" action="">
      <div class="detail-box-isi">
        <div class="detail-box-judul">
          <h1>Ubah Rute</h1>
          <button class="detail-box-tutup"><i tpy="batal"></i></button>
        </div>
        <div class="detail-box-konten">
          <div class="detail-box-isian">
            <label for="ubah-layanan">Layanan:</label>
            <select id="ubah-layanan" name="ubah-layanan" class="detail-box-field">
              <option value="" selected disabled>Pilih Layanan Bus</option>
              <?php
              mysqli_data_seek($resultLayanan, 0);
              while ($rowLayanan = mysqli_fetch_assoc($resultLayanan)) {
                echo '<option value="' . $rowLayanan['id_layanan'] . '">' . $rowLayanan['singkatan'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="detail-box-isian">
            <label for="ubah-nama">Nama Rute:</label>
            <input type="text" id="ubah-nama" name="ubah-nama" class="detail-box-field" />
          </div>
          <div class="detail-box-isian">
            <label for="ubah-dari">Dari:</label>
            <select id="ubah-dari" name="ubah-dari" class="detail-box-field">
              <option value="" selected disabled>Pilih Halte/Terminal Keberangkatan</option>
              <?php
              mysqli_data_seek($resultHalte, 0);
              while ($rowHalte = mysqli_fetch_assoc($resultHalte)) {
                echo '<option value="' . $rowHalte['nama_halte'] . '">' . $rowHalte['nama_halte'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="detail-box-isian">
            <label for="ubah-tujuan">Tujuan:</label>
            <select id="ubah-tujuan" name="ubah-tujuan" class="detail-box-field">
              <option value="" selected disabled>Pilih Halte/Terminal Tujuan</option>
              <?php
              mysqli_data_seek($resultHalte, 0);
              while ($rowHalte = mysqli_fetch_assoc($resultHalte)) {
                echo '<option value="' . $rowHalte['nama_halte'] . '">' . $rowHalte['nama_halte'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="detail-box-isian">
            <label for="ubah-harga">Harga:</label>
            <input type="text" id="ubah-harga" name="ubah-harga" class="detail-box-field" />
          </div>
          <input type="hidden" id="ubah-id-rute" name="ubah-id-rute" value="" />
        </div>
        <div class="detail-box-kontrol">
          <button class="tbl-dtl" id="dtl-hapus" name="dtl-hapus">Hapus</button>
          <button class="tbl-dtl" id="dtl-simpan" name="dtl-simpan">Simpan</button>
        </div>
      </div>
    </form>
  </div>

  <div class="redup-rutedt">
    <div class="rutedt-box">
      <div class="rutedt-kiri">
        <div class="konten-kiri">
          <div class="judul-rutedt">
            <h1>Buat Detail Rute</h1>
            <h2><?php echo $namaRute; ?></h2>
          </div>
          <table class="tabel-rutedt">
            <thead id="thead-rutedt">
              <tr>
                <th>#</th>
                <th>Pemberhentian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody-rutedt">
              <?php if (mysqli_num_rows($resultDetail) > 0) { ?>
                <?php $index = 1; ?>
                <?php while ($rowDetail = mysqli_fetch_assoc($resultDetail)) { ?>
                  <tr>
                    <td><?php echo $rowDetail['urutan']; ?></td>
                    <td><?php echo $rowDetail['nama_halte']; ?></td>
                    <td>
                      <button class="tbl-edit"><i tpy="hapus"></i></button>
                    </td>
                  </tr>
                  <?php $index++; ?>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="3">Tidak ada data pemberhentian yang tersedia.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="footer-rutedt" id="footer-rutedt-container">
            <button class="tbh-rutedt">Tambah Pemberhentian</button>
          </div>
        </div>
      </div>
      <div class="rutedt-kanan">
        <div class="map-rutedt" id="map">
        </div>
        <div class="info-rutedt">
          <div class="info-rutedt-konten">
            <h2>Informasi Rute</h2>
            <div class="info-rute">
              <div class="minfo-rutedt">
                <span>DARI</span> <?php echo $dari; ?>
              </div>
              <div class="minfo-rutedt">
                <span>TUJUAN</span> <?php echo $tujuan; ?>
              </div>
            </div>
            <div class="info-rute-pjg">
              <div class="minfo-rutedt">
                <span>HARGA TIKET</span> Rp <?php echo $harga; ?>
              </div>
            </div>
            <div class="btn-rute">
              <button class="tbh-btn" id="tbh-batal">Batal</button>
              <button class="tbh-btn" id="tbh-buat">Buat Rute</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="redup-henti">
    <div class="box-henti">
      <input class="cari-henti" type="text" id="cariHenti" placeholder="Cari Data" />
      <table class="tabel-henti">
        <tbody id="henti" class="tbody-henti">
          <tr>
            <?php while ($rowHenti = mysqli_fetch_assoc($resultHenti)) { ?>
              <td data-id="<?php echo $rowHenti['id_halte']; ?>" onclick="submitForm(this)">
                <div class="henti-label"><i tpy="bus"></i></div><?php echo $rowHenti['nama_halte']; ?>
                <form method="POST" id="form-henti" action="">
                  <input name="urutan" value="<?php echo $latestUrutan; ?>" type="hidden">
                  <input name="id_halte" value="<?php echo $rowHenti['id_halte']; ?>" type="hidden">
                  <input name="id_rute" value="<?php echo $idRute; ?>" type="hidden">
                </form>
              </td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
  <script src="src/js/ikon.js"></script>
  <script src="src/js/tablerute.js"></script>
  <script src="src/js/tpy.js"></script>
</body>

</html>