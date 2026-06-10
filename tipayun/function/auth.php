<?php

if (isset($_SESSION['waktu_login'])) {
    $login_time = $_SESSION['waktu_login'];
    $current_time = time();
    $time_diff = $current_time - $login_time;
    if ($time_diff > 180) {
        session_unset();
        session_destroy();
        header('Location: admin');
        exit();
    } elseif (isset($_SESSION['auth_berhasil'])) {
        if ($_SESSION['auth_berhasil']) {
            header('Location: dashboard');
            exit();
        }
    } elseif (isset($_POST['gAuth'])) {
        include 'function/connect.php';
        $pin = $_POST['gAuth'];
        $id = $_SESSION['id'];
        $query = "SELECT koderahasia FROM tpy_user WHERE tip = '$id'";
        $result = $koneksi->query($query);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $secretCode = $row['koderahasia'];
            $url = "https://www.authenticatorapi.com/Validate.aspx?Pin=" . $pin . "&SecretCode=" . $secretCode;
            $verificationResult = file_get_contents($url);

            if ($verificationResult === "True") {
                $_SESSION['auth_berhasil'] = true;
                $_SESSION['waktu_login'] = time();
                header('Location: dashboard');
                exit();
            } else {
                echo '<script>console.log("Verifikasi gagal. Silakan coba lagi.");</script>';
            }
        } else {
            echo '<script>console.log("Gagal mendapatkan secret code. Silakan coba lagi.");</script>';
        }
        $koneksi->close();
    }
} else {
    header('Location: admin');
    exit();
}
