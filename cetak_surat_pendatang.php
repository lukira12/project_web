<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "project_web");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID pendatang dari POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pendatang_id = $_POST['pendatang_id'];

    // Ambil data pendatang dari database
    $query = "SELECT * FROM pendatang WHERE id = $pendatang_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $pendatang = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    header("Location: surat_datang.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Keterangan Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Surat Keterangan Datang</h1>
    <div class="content">
        <p>Nama: <strong><?= $pendatang['nama']; ?></strong></p>
        <p>Alamat Asal: <strong><?= $pendatang['alamat_asal']; ?></strong></p>
        <p>Alamat Tujuan: <strong><?= $pendatang['alamat_tujuan']; ?></strong></p>
        <p>Tanggal Datang: <strong><?= $pendatang['tanggal_datang']; ?></strong></p>
        <p>Keterangan: <strong><?= $pendatang['keterangan']; ?></strong></p>
    </div>
    <button onclick="window.print()">Cetak</button>
</body>
</html>
