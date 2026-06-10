<?php
session_start();

include 'function/setsesi.php';
include 'function/connect.php';
include 'function/tablelayanan.php';

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
    <title>TPY Command Center - Layanan</title>
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
                        <a class="acc-list" href="halte"><i tpy="stop"></i>Halte / Stop</a>
                        <a class="acc-list active" href="layanan"><i tpy="layanan"></i>Layanan</a>
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
                <h1>Layanan</h1>
                <span id="tgl"></span>
            </div>
            <div class="acc-layanan">
                <div class="table-head">
                    <h2>Daftar Layanan</h2>
                    <input class="table-search" type="text" id="searchInput" placeholder="Cari Data">
                </div>
                <table>
                    <thead id="layanan">
                        <tr>
                            <th>ID Layanan</th>
                            <th>Nama Layanan</th>
                            <th>Informasi</th>
                            <th>Singkatan</th>
                            <th>Website</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="layanan" class="tbody-layanan">
                        <?php if (!empty($layanans)) { ?>
                            <?php foreach ($layanans as $layanan) { ?>
                                <tr>
                                    <td><?php echo $layanan['id_layanan']; ?></td>
                                    <td><?php echo $layanan['nama_layanan']; ?></td>
                                    <td><?php echo $layanan['informasi']; ?></td>
                                    <td>
                                        <div class="tbl-trayek"><?php echo $layanan['singkatan']; ?></div>
                                    </td>
                                    <td><?php echo $layanan['web']; ?></td>
                                    <td>
                                        <button class="tbl-edit" data-id="<?php echo $layanan['id_layanan']; ?>"><i tpy="edit"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7">Tidak ada data layanan yang tersedia.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="acc-navbox">
                    <div class="acc-nav-tampil">
                        Menampilkan <b><?php echo $dataDitampilkan; ?></b> dari <b><?php echo $totalData; ?></b> Layanan
                    </div>
                    <div class="acc-navigation">
                        <?php if ($totalData > 0) : ?>
                            <?php if ($currentPage > 1) : ?>
                                <a href="halte?hal=<?php echo $currentPage - 1; ?>" class="nav-hal"><i tpy="prev"></i></a>
                            <?php else : ?>
                                <span class="nav-hal disabled"><i tpy="prev"></i></span>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <a href="halte?hal=<?php echo $i; ?>" class="nav-hal<?php echo ($i == $currentPage) ? ' active' : ''; ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>

                            <?php if ($currentPage < $jumlahHalaman) : ?>
                                <a href="halte?hal=<?php echo $currentPage + 1; ?>" class="nav-hal"><i tpy="next"></i></a>
                            <?php else : ?>
                                <span class="nav-hal disabled"><i tpy="next"></i></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <button class="tbl-buat" id="tbl-layanan">Tambah Layanan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-box" id="buat-layanan">
        <form method="post" id="form-layanan" action="">
            <div class="detail-box-isi">
                <div class="detail-box-judul">
                    <h1>Buat Layanan Baru</h1>
                    <button class="detail-box-tutup"><i tpy="batal"></i></button>
                </div>
                <div class="detail-box-konten">
                    <div class="detail-box-isian">
                        <label for="isi-layanan">Nama Layanan:</label>
                        <input type="text" id="isi-layanan" name="isi-layanan" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="isi-singkatan">Singkatan:</label>
                        <input type="text" id="isi-singkatan" name="isi-singkatan" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="isi-informasi">Informasi:</label>
                        <textarea id="isi-informasi" name="isi-informasi" class="detail-box-field"></textarea>
                    </div>
                    <div class="detail-box-isian">
                        <label for="isi-website">Website:</label>
                        <input type="text" id="isi-website" name="isi-website" class="detail-box-field" />
                    </div>
                </div>
                <div class="detail-box-kontrol">
                    <button class="tbl-dtl" id="dtl-bersih">Bersihkan</button>
                    <button class="tbl-dtl" id="dtl-buat" name="dtl-buat">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <div class="detail-box" id="edit-layanan">
        <form method="post" id="form-edit-layanan" action="">
            <div class="detail-box-isi">
                <div class="detail-box-judul">
                    <h1>Edit Layanan</h1>
                    <button class="detail-box-tutup"><i tpy="batal"></i></button>
                </div>
                <div class="detail-box-konten">
                    <div class="detail-box-isian">
                        <label for="edit-isi-layanan">Nama Layanan:</label>
                        <input type="text" id="edit-isi-layanan" name="edit-isi-layanan" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="edit-isi-singkatan">Singkatan:</label>
                        <input type="text" id="edit-isi-singkatan" name="edit-isi-singkatan" class="detail-box-field" />
                    </div>
                    <div class="detail-box-isian">
                        <label for="edit-isi-informasi">Informasi:</label>
                        <textarea id="edit-isi-informasi" name="edit-isi-informasi" class="detail-box-field"></textarea>
                    </div>
                    <div class="detail-box-isian">
                        <label for="edit-isi-website">Website:</label>
                        <input type="text" id="edit-isi-website" name="edit-isi-website" class="detail-box-field" />
                    </div>
                    <input type="hidden" id="edit-id-layanan" name="edit-id-layanan" value="" />
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
    <script src="src/js/tablelayanan.js"></script>
    <script src="src/js/tpy.js"></script>
</body>

</html>