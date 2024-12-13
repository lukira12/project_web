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
    $asal = $_POST['asal'];
    $tanggal_datang = $_POST['tanggal_datang'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO pendatang (nama, asal, tanggal_datang, keterangan) 
            VALUES ('$nama', '$asal', '$tanggal_datang', '$keterangan')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='data_pendatang.php';</script>";
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
    <title>Tambah Data Pendatang</title>
</head>
<body>
    <h1>Tambah Data Pendatang</h1>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="asal">Asal:</label>
        <input type="text" id="asal" name="asal" required><br><br>

        <label for="tanggal_datang">Tanggal Datang:</label>
        <input type="date" id="tanggal_datang" name="tanggal_datang" required><br><br>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan"></textarea><br><br>

        <button type="submit">Simpan</button>
        <a href="data_pendatang.php">Batal</a>
    </form>
</body>
</html>
