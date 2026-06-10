<?php

if (!isset($_SESSION['id'])) {
    header('Location: admin');
    exit();
}

if (isset($_SESSION['waktu_login'])) {
    $waktu_login = $_SESSION['waktu_login'];
    $current_time = time();
    $time_diff = $current_time - $waktu_login;
    if ($time_diff > 3600) {
        header('Location: admin');
        exit();
    }
} else {
    header('Location: admin');
    exit();
}

$_SESSION['waktu_login'] = time();
