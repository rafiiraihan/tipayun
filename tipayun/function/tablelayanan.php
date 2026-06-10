<?php

$queryTotal = "SELECT COUNT(*) AS total FROM tpy_layanan";
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

$query = "SELECT id_layanan, nama_layanan, informasi, singkatan, web FROM tpy_layanan LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $query);
$layanans = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layanans[] = $row;
    }
}

$dataDitampilkan = count($layanans);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dtl-buat'])) {
        $nama_layanan = $_POST['isi-layanan'];
        $singkatan = $_POST['isi-singkatan'];
        $informasi = $_POST['isi-informasi'];
        $web = $_POST['isi-website'];

        $queryInsert = "INSERT INTO tpy_layanan (nama_layanan, singkatan, informasi, web) VALUES ('$nama_layanan', '$singkatan', '$informasi', '$web')";
        if (mysqli_query($koneksi, $queryInsert)) {
            header("Location: layanan");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }

    if (isset($_POST['dtl-hapus'])) {
        $id_layanan = $_POST['edit-id-layanan'];

        $queryDelete = "DELETE FROM tpy_layanan WHERE id_layanan = '$id_layanan'";
        if (mysqli_query($koneksi, $queryDelete)) {
            header("Location: layanan");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }

    if (isset($_POST['dtl-simpan'])) {
        $id_layanan = $_POST['edit-id-layanan'];
        $nama_layanan = $_POST['edit-isi-layanan'];
        $singkatan = $_POST['edit-isi-singkatan'];
        $informasi = $_POST['edit-isi-informasi'];
        $web = $_POST['edit-isi-website'];

        $queryUpdate = "UPDATE tpy_layanan SET nama_layanan = '$nama_layanan', singkatan = '$singkatan', informasi = '$informasi', web = '$web' WHERE id_layanan = '$id_layanan'";
        if (mysqli_query($koneksi, $queryUpdate)) {
            header("Location: layanan");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }
}
