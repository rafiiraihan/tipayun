<?php

$queryTotal = "SELECT COUNT(*) AS total FROM tpy_halte";
$resultTotal = mysqli_query($koneksi, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalData = $rowTotal['total'];

$query = "SELECT nama FROM tpy_user";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$nama = $row['nama'];

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

$query = "SELECT id_halte, nama_halte, lat, lng, jenis FROM tpy_halte LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $query);
$haltes = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $haltes[] = $row;
    }
}

$dataDitampilkan = count($haltes);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dtl-buat'])) {
        $nama_halte = $_POST['isi-nama-halte'];
        $lat = $_POST['isi-latitude'];
        $lng = $_POST['isi-longitude'];
        $jenis = $_POST['isi-jenis'];

        $queryInsert = "INSERT INTO tpy_halte (nama_halte, lat, lng, jenis) VALUES ('$nama_halte', '$lat', '$lng', '$jenis')";
        if (mysqli_query($koneksi, $queryInsert)) {
            header("Location: halte");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }
    if (isset($_POST['dtl-hapus'])) {
        $id_halte = $_POST['edit-id-halte'];

        $queryDelete = "DELETE FROM tpy_halte WHERE id_halte = '$id_halte'";
        if (mysqli_query($koneksi, $queryDelete)) {
            header("Location: halte");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }

    if (isset($_POST['dtl-simpan'])) {
        $id_halte = $_POST['edit-id-halte'];
        $nama_halte = $_POST['ubah-nama-halte'];
        $latitude = $_POST['ubah-latitude'];
        $longitude = $_POST['ubah-longitude'];
        $jenis = $_POST['ubah-jenis'];

        $queryUpdate = "UPDATE tpy_halte SET nama_halte = '$nama_halte', lat = '$latitude', lng = '$longitude', jenis = '$jenis' WHERE id_halte = '$id_halte'";
        if (mysqli_query($koneksi, $queryUpdate)) {
            header("Location: halte");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }
}
