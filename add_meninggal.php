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

// Proses form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $tanggal_meninggal = $_POST['tanggal_meninggal'];
    $tempat_meninggal = $_POST['tempat_meninggal'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO meninggal (nama, tanggal_meninggal, tempat_meninggal, keterangan) 
            VALUES ('$nama', '$tanggal_meninggal', '$tempat_meninggal', '$keterangan')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='data_meninggal.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Meninggal</title>
</head>
<body>
    <h1>Tambah Data Meninggal</h1>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="tanggal_meninggal">Tanggal Meninggal:</label>
        <input type="date" id="tanggal_meninggal" name="tanggal_meninggal" required><br><br>

        <label for="tempat_meninggal">Tempat Meninggal:</label>
        <input type="text" id="tempat_meninggal" name="tempat_meninggal" required><br><br>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan"></textarea><br><br>

        <button type="submit">Simpan</button>
        <a href="data_meninggal.php">Batal</a>
    </form>
</body>
</html>
