<?php

$query_rute = "SELECT COUNT(*) AS jumlah_rute FROM tpy_rute";
$result_rute = $koneksi->query($query_rute);
$row_rute = $result_rute->fetch_assoc();
$jumlah_rute = $row_rute['jumlah_rute'];

$query_halte = "SELECT COUNT(*) AS jumlah_halte FROM tpy_halte WHERE jenis = 'Halte'";
$result_halte = $koneksi->query($query_halte);
$row_halte = $result_halte->fetch_assoc();
$jumlah_halte = $row_halte['jumlah_halte'];

$query_stop = "SELECT COUNT(*) AS jumlah_stop FROM tpy_halte WHERE jenis = 'Stop'";
$result_stop = $koneksi->query($query_stop);
$row_stop = $result_stop->fetch_assoc();
$jumlah_stop = $row_stop['jumlah_stop'];

$query_layanan = "SELECT COUNT(*) AS jumlah_layanan FROM tpy_layanan";
$result_layanan = $koneksi->query($query_layanan);
$row_layanan = $result_layanan->fetch_assoc();
$jumlah_layanan = $row_layanan['jumlah_layanan'];

$query = "SELECT dari, tujuan FROM tpy_rute ORDER BY id_rute DESC LIMIT 1";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$dari = $row['dari'];
$tujuan = $row['tujuan'];

$query = "SELECT harga, nama_rute FROM tpy_rute ORDER BY id_rute DESC LIMIT 1";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$harga = $row['harga'];
$nama_rute = $row['nama_rute'];

$query = "SELECT jarak FROM tpy_rute ORDER BY id_rute DESC LIMIT 1";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$jarak = $row['jarak'];

$query = "SELECT nama FROM tpy_user";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$nama = $row['nama'];
