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
    $tujuan = $_POST['alamat tujuan'];
    $tanggal_pindah = $_POST['tanggal_pindah'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO pindah (nama, alamat tujuan, tanggal_pindah, keterangan) 
            VALUES ('$nama', '$alamat_tujuan', '$tanggal_pindah', '$keterangan')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='data_pindah.php';</script>";
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
    <title>Tambah Data Pindah</title>
</head>
<body>
    <h1>Tambah Data Pindah</h1>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="tujuan">Tujuan:</label>
        <input type="text" id="tujuan" name="tujuan" required><br><br>

        <label for="tanggal_pindah">Tanggal Pindah:</label>
        <input type="date" id="tanggal_pindah" name="tanggal_pindah" required><br><br>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan"></textarea><br><br>

        <button type="submit">Simpan</button>
        <a href="data_pindah.php">Batal</a>
    </form>
</body>
</html>
