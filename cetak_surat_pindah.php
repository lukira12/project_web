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

// Ambil ID pindah dari POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pindah_id = $_POST['pindah_id'];

    // Ambil data pindah dari database
    $query = "SELECT * FROM pindah WHERE id = $pindah_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $pindah = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    header("Location: surat_pindah.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Keterangan Pindah</title>
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
    <h1>Surat Keterangan Pindah</h1>
    <div class="content">
        <p>Nama: <strong><?= $pindah['nama']; ?></strong></p>
        <!-- Gunakan kolom 'Tujuan' untuk alamat tujuan -->
        <p>Alamat Tujuan: <strong><?= $pindah['Tujuan']; ?></strong></p>
        <p>Tanggal Pindah: <strong><?= $pindah['tanggal_pindah']; ?></strong></p>
        <p>Keterangan: <strong><?= $pindah['keterangan']; ?></strong></p>
    </div>
    <button onclick="window.print()">Cetak</button>
</body>
</html>

   