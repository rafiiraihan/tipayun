<?php
$queryTotal = "SELECT COUNT(*) AS total FROM tpy_rute";
$resultTotal = mysqli_query($koneksi, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalData = $rowTotal['total'];

$query = "SELECT nama FROM tpy_user";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$nama = $row['nama'];

$queryRute = "SELECT * FROM tpy_rute ORDER BY id_rute DESC LIMIT 1";
$resultRute = mysqli_query($koneksi, $queryRute);
$rowRute = mysqli_fetch_assoc($resultRute);
$idRute = $rowRute['id_rute'];
$namaRute = $rowRute['nama_rute'];
$dari = $rowRute['dari'];
$tujuan = $rowRute['tujuan'];
$jarak = $rowRute['jarak'];
$harga = $rowRute['harga'];

$queryHenti = "SELECT id_halte, nama_halte FROM tpy_halte WHERE jenis = 'Stop'";
$resultHenti = mysqli_query($koneksi, $queryHenti);

$queryDetail = "SELECT tpy_detail.urutan, tpy_halte.nama_halte
                FROM tpy_detail
                INNER JOIN tpy_halte ON tpy_detail.id_halte = tpy_halte.id_halte
                WHERE tpy_detail.id_rute = $idRute
                ORDER BY tpy_detail.urutan ASC";
$resultDetail = mysqli_query($koneksi, $queryDetail);

$limit = 11;
$jumlahHalaman = ceil($totalData / $limit);

$currentPage = 1;
if (isset($_GET['hal']) && is_numeric($_GET['hal'])) {
    $currentPage = $_GET['hal'];
    if ($currentPage < 1) {
        $currentPage = 1;
    } elseif ($currentPage > $jumlahHalaman) {
        $currentPage = $jumlahHalaman;
    }
}

$offset = ($currentPage - 1) * $limit;

$queryTotalDetail = "SELECT COUNT(*) AS total FROM tpy_detail";
$resultTotalDetail = mysqli_query($koneksi, $queryTotalDetail);
$rowTotalDetail = mysqli_fetch_assoc($resultTotalDetail);
$totalDataDetail = $rowTotalDetail['total'];

$limitDetail = 11;
$jumlahHalamanDetail = ceil($totalDataDetail / $limitDetail);

$currentPageDetail = 1;
if (isset($_GET['hal_detail']) && is_numeric($_GET['hal_detail'])) {
    $currentPageDetail = $_GET['hal_detail'];
    if ($currentPageDetail < 1) {
        $currentPageDetail = 1;
    } elseif ($currentPageDetail > $jumlahHalamanDetail) {
        $currentPageDetail = $jumlahHalamanDetail;
    }
}

$offsetDetail = ($currentPageDetail - 1) * $limitDetail;


$query = "SELECT r.id_rute, r.nama_rute, r.dari, r.tujuan, r.harga, r.jarak, l.singkatan FROM tpy_rute r JOIN tpy_layanan l ON r.id_layanan = l.id_layanan LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $query);
$rutes = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rutes[] = $row;
    }
}

$dataDitampilkan = count($rutes);

$queryLayanan = "SELECT id_layanan, singkatan FROM tpy_layanan";
$resultLayanan = mysqli_query($koneksi, $queryLayanan);

$queryHalte = "SELECT nama_halte FROM tpy_halte WHERE jenis = 'Halte'";
$resultHalte = mysqli_query($koneksi, $queryHalte);

function getLatestUrutan($koneksi, $idRute)
{
    $query = "SELECT urutan FROM tpy_detail WHERE id_rute = $idRute ORDER BY urutan DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['urutan'];
    } else {
        return 1;
    }
}

$latestUrutan = getLatestUrutan($koneksi, $idRute);


$query = "SELECT tpy_halte.lat, tpy_halte.lng
          FROM tpy_detail
          INNER JOIN tpy_halte ON tpy_detail.id_halte = tpy_halte.id_halte
          WHERE tpy_detail.id_rute = $idRute
          ORDER BY tpy_detail.urutan";
$result = mysqli_query($koneksi, $query);

$stops = array();
while ($row = mysqli_fetch_assoc($result)) {
    $stops[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dtl-buat'])) {
        $id_layanan = $_POST['isi-layanan'];
        $nama_rute = $_POST['isi-rute'];
        $dari = $_POST['isi-dari'];
        $tujuan = $_POST['isi-tujuan'];
        $harga = $_POST['isi-harga'];

        $queryInsert = "INSERT INTO tpy_rute (id_layanan, nama_rute, dari, tujuan, harga) VALUES ('$id_layanan', '$nama_rute', '$dari', '$tujuan', '$harga')";
        if (mysqli_query($koneksi, $queryInsert)) {
            $id_rute_terbaru = mysqli_insert_id($koneksi);

            $queryHalteDari = "SELECT id_halte FROM tpy_halte WHERE nama_halte = '$dari' LIMIT 1";
            $resultHalteDari = mysqli_query($koneksi, $queryHalteDari);
            $rowHalteDari = mysqli_fetch_assoc($resultHalteDari);
            $id_halte_dari = $rowHalteDari['id_halte'];

            $queryHalteTujuan = "SELECT id_halte FROM tpy_halte WHERE nama_halte = '$tujuan' LIMIT 1";
            $resultHalteTujuan = mysqli_query($koneksi, $queryHalteTujuan);
            $rowHalteTujuan = mysqli_fetch_assoc($resultHalteTujuan);
            $id_halte_tujuan = $rowHalteTujuan['id_halte'];

            $queryInsertDetailDari = "INSERT INTO tpy_detail (id_rute, id_halte, urutan) VALUES ('$id_rute_terbaru', '$id_halte_dari', 1)";
            mysqli_query($koneksi, $queryInsertDetailDari);

            $queryInsertDetailTujuan = "INSERT INTO tpy_detail (id_rute, id_halte, urutan) VALUES ('$id_rute_terbaru', '$id_halte_tujuan', 2)";
            mysqli_query($koneksi, $queryInsertDetailTujuan);

            header("Location: rute?id=sukses");
            exit;
        } else {
?>
            <script>
                console.log("Terjadi kesalahan: <?php echo mysqli_error($koneksi); ?>");
            </script>
<?php
        }
    }

    if (isset($_POST['dtl-hapus'])) {

        $id_rute = $_POST['ubah-id-rute'];

        $queryDeleteDetail = "DELETE FROM tpy_detail WHERE id_rute = '$id_rute'";
        mysqli_query($koneksi, $queryDeleteDetail);

        $queryDelete = "DELETE FROM tpy_rute WHERE id_rute = '$id_rute'";
        if (mysqli_query($koneksi, $queryDelete)) {
            header("Location: rute");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }

    if (isset($_POST['dtl-simpan'])) {

        $id_rute = $_POST['ubah-id-rute'];
        $id_layanan = $_POST['ubah-layanan'];
        $nama_rute = $_POST['ubah-nama'];
        $dari = $_POST['ubah-dari'];
        $tujuan = $_POST['ubah-tujuan'];
        $harga = $_POST['ubah-harga'];

        $queryUpdate = "UPDATE tpy_rute SET id_layanan = '$id_layanan', nama_rute = '$nama_rute', dari = '$dari', tujuan = '$tujuan', harga = '$harga' WHERE id_rute = '$id_rute'";
        if (mysqli_query($koneksi, $queryUpdate)) {
            header("Location: rute");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }

    if (isset($_POST['id_halte'])) {
        $urutan = $_POST['urutan'];
        $id_halte = $_POST['id_halte'];
        $id_rute = $_POST['id_rute'];

        $queryUpdateDetail = "UPDATE tpy_detail SET urutan = urutan + 1 WHERE id_rute = '$id_rute' AND urutan >= '$urutan'";
        if (mysqli_query($koneksi, $queryUpdateDetail)) {
            $queryInsertDetail = "INSERT INTO tpy_detail (id_rute, id_halte, urutan) VALUES ('$id_rute', '$id_halte', '$urutan')";
            if (mysqli_query($koneksi, $queryInsertDetail)) {
                header("Location: rute?id=sukses");
                exit;
            } else {
                echo "Terjadi kesalahan saat memasukkan data ke tabel tpy_detail: " . mysqli_error($koneksi);
            }
        } else {
            echo "Terjadi kesalahan saat melakukan update urutan pada tabel tpy_detail: " . mysqli_error($koneksi);
        }
    }
}
