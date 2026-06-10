<?php
session_start();

include 'function/setsesi.php';
include 'function/connect.php';
include 'function/tablehalte.php';

$queryLayanan = "SELECT id_layanan, singkatan FROM tpy_layanan";
$resultLayanan = mysqli_query($koneksi, $queryLayanan);

$queryHalte = "SELECT nama_halte FROM tpy_halte WHERE jenis = 'Halte'";
$resultHalte = mysqli_query($koneksi, $queryHalte);

if (isset($_POST['dtl-buat'])) {
    $id_layanan = $_POST['isi-layanan'];
    $nama_rute = $_POST['isi-rute'];
    $dari = $_POST['isi-dari'];
    $tujuan = $_POST['isi-tujuan'];
    $harga = $_POST['isi-harga'];

    $queryInsert = "INSERT INTO tpy_rute (id_layanan, nama_rute, dari, tujuan, harga) VALUES ('$id_layanan', '$nama_rute', '$dari', '$tujuan', '$harga')";
    if (mysqli_query($koneksi, $queryInsert)) {
?>
        <script>
            console.log("Data berhasil disimpan.");
        </script>
    <?php
    } else {
    ?>
        <script>
            console.log("Terjadi kesalahan: <?php echo mysqli_error($koneksi); ?>");
        </script>
<?php
    }
}

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
    <title>TPY Command Center - Halte</title>
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
                        <a class="acc-list" href="rute"><i tpy="rute2"></i>Rute</a>
                        <a class="acc-list active" href="halte"><i tpy="stop"></i>Halte / Stop</a>
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
                <h1>Halte</h1>
                <span id="tgl"></span>
            </div>
            <div class="acc-halte">
                <div class="table-head">
                    <h2>Daftar Halte</h2>
                    <input class="table-search" type="text" id="searchInput" placeholder="Cari Data">
                </div>
                <table>
                    <thead id="halte">
                        <tr>
                            <th>ID Halte</th>
                            <th>Nama Halte</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Jenis</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="halte" class="tbody-halte">
                        <?php if (!empty($haltes)) { ?>
                            <?php foreach ($haltes as $halte) { ?>
                                <tr>
                                    <td><?php echo $halte['id_halte']; ?></td>
                                    <td><?php echo $halte['nama_halte']; ?></td>
                                    <td><?php echo $halte['lat']; ?></td>
                                    <td><?php echo $halte['lng']; ?></td>
                                    <td>
                                        <div class="tbl-trayek"><?php echo $halte['jenis']; ?></div>
                                    </td>
                                    <td>
                                        <button class="tbl-edit" data-id="<?php echo $halte['id_halte']; ?>"><i tpy="edit"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7">Tidak ada data halte yang tersedia.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="acc-navbox">
                    <div class="acc-nav-tampil">
                        Menampilkan <b><?php echo $dataDitampilkan; ?></b> dari <b><?php echo $totalData; ?></b> Halte
                    </div>
                    <div class="acc-navigation">
                        <?php if ($totalData > 0) : ?>
                            <?php if ($currentPage > 1) : ?>
                                <a href="halte?hal=<?php echo $currentPage - 1; ?>" class="nav-hal"><i tpy="prev"></i></a>
                            <?php else : ?>
                                <span class="nav-hal disabled"><i tpy="prev"></i></span>
                            <?php endif; ?>

                            <?php
                            $startPage = max(1, $currentPage - 3);
                            $endPage = min($startPage + 6, $jumlahHalaman);

                            if ($startPage > 1) {
                                echo '<a href="halte?hal=1" class="nav-hal">1</a>';
                                if ($startPage > 2) {
                                    echo '<form action="halte" method="GET" class="nav-hal-go">
                                    <input type="text" name="hal" placeholder="..." class="nav-hal-isi">
                                </form>';
                                }
                            }

                            for ($i = $startPage; $i <= $endPage; $i++) {
                                echo '<a href="halte?hal=' . $i . '" class="nav-hal' . ($i == $currentPage ? ' active' : '') . '">' . $i . '</a>';
                            }

                            if ($endPage < $jumlahHalaman) {
                                if ($endPage < $jumlahHalaman - 1) {
                                    echo '<form action="halte" method="GET" class="nav-hal-go">
                                    <input type="text" name="hal" placeholder="..." class="nav-hal-isi">
                                </form>';
                                }
                                echo '<a href="halte?hal=' . $jumlahHalaman . '" class="nav-hal">' . $jumlahHalaman . '</a>';
                            }
                            ?>

                            <?php if ($currentPage < $jumlahHalaman) : ?>
                                <a href="halte?hal=<?php echo $currentPage + 1; ?>" class="nav-hal"><i tpy="next"></i></a>
                            <?php else : ?>
                                <span class="nav-hal disabled"><i tpy="next"></i></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>


                    <button class="tbl-buat" id="tbl-halte">Tambah Halte</button>
                </div>

            </div>
        </div>
    </div>

    <div class="detail-box" id="buat-halte">
        <form method="post" id="form-halte" action="">
            <div class="detail-box-isi">
                <div class="detail-box-judul">
                    <h1>Buat Halte Baru</h1>
                    <button class="detail-box-tutup"><i tpy="batal"></i></button>
                </div>
                <div class="detail-box-konten">
                    <div class="detail-box-isian">
                        <label for="isi-nama-halte">Nama Halte:</label>
                        <input type="text" id="isi-nama-halte" name="isi-nama-halte" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <button class="tbl-setlok" id="tbl-setlok"><i tpy="map2"> </i>Set Lokasi via <b>Google Map</b></button>
                    </div>
                    <div class="detail-box-isian">
                        <label for="isi-latitude">Latitude:</label>
                        <input type="text" id="isi-latitude" name="isi-latitude" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="isi-longitude">Longitude:</label>
                        <input type="text" id="isi-longitude" name="isi-longitude" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="isi-jenis">Jenis:</label>
                        <select id="isi-jenis" name="isi-jenis" class="detail-box-field">
                            <option value="" selected disabled>Pilih Jenis</option>
                            <option value="Halte">Halte</option>
                            <option value="Stop">Stop</option>
                        </select>
                    </div>
                </div>
                <div class="detail-box-kontrol">
                    <button class="tbl-dtl" id="dtl-bersih">Bersihkan</button>
                    <button class="tbl-dtl" id="dtl-buat" name="dtl-buat">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <div class="set-box">
        <div class="set-konten">
            <div class="set-map" id="map"></div>
            <div class="set-info">
                <form id="konversi" class="set-konversi">
                    <input type="text" id="set-mentah" name="set-mentah" placeholder="atau paste Lokasi Koordinat dari Google Maps kesini" />
                    <input type="submit" id="set-konversi" value="Konversi" />
                </form>
                <div class="set-btn">
                    <button id="set-batal">Batal</button>
                    <button id="set-lokasi">Set Lokasi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-box" id="ubah-halte">
        <form method="post" id="form-ubah-halte" action="">
            <div class="detail-box-isi">
                <div class="detail-box-judul">
                    <h1>Ubah Halte</h1>
                    <button class="detail-box-tutup"><i tpy="batal"></i></button>
                </div>
                <div class="detail-box-konten">
                    <div class="detail-box-isian">
                        <label for="ubah-nama-halte">Nama Halte:</label>
                        <input type="text" id="ubah-nama-halte" name="ubah-nama-halte" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <button class="tbl-setlok" id="tbl-setlok"><i tpy="map2"> </i>Set Lokasi via <b>Google Map</b></button>
                    </div>
                    <div class="detail-box-isian">
                        <label for="ubah-latitude">Latitude:</label>
                        <input type="text" id="ubah-latitude" name="ubah-latitude" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="ubah-longitude">Longitude:</label>
                        <input type="text" id="ubah-longitude" name="ubah-longitude" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="ubah-jenis">Jenis:</label>
                        <select id="ubah-jenis" name="ubah-jenis" class="detail-box-field">
                            <option value="" selected disabled>Pilih Jenis</option>
                            <option value="Halte">Halte</option>
                            <option value="Stop">Stop</option>
                        </select>
                    </div>
                    <input type="hidden" id="edit-id-halte" name="edit-id-halte" value="" />
                </div>
                <div class="detail-box-kontrol">
                    <button class="tbl-dtl" id="dtl-hapus" name="dtl-hapus">Hapus</button>
                    <button class="tbl-dtl" id="dtl-simpan" name="dtl-simpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
    <script src="src/js/ikon.js"></script>
    <script src="src/js/tablehalte.js"></script>
    <script src="src/js/tpy.js"></script>
</body>

</html>