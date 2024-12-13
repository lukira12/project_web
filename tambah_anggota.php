<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli("localhost", "root", "", "project_web");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $no_kk = $_POST['no_kk'];
    $nik = $_POST['nik'];
    $hubungan_keluarga = $_POST['hubungan_keluarga'];

    $query = "INSERT INTO anggota_kk (no_kk, nik, hubungan_keluarga)
              VALUES ('$no_kk', '$nik', '$hubungan_keluarga')";
    if ($conn->query($query)) {
        header("Location: anggota_kk.php?no_kk=$no_kk");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
