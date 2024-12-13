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

// Ambil data anggota KK berdasarkan no_kk
$no_kk = $_GET['no_kk'];
$query = "SELECT * FROM anggota_kk WHERE no_kk = '$no_kk'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota KK</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h2>Anggota KK</h2>
    <a href="add_anggota_kk.php?no_kk=<?= $no_kk; ?>">Tambah Anggota</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Status Keluarga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nik']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jenis_kelamin']; ?></td>
                        <td><?= $row['status_keluarga']; ?></td>
                        <td>
                            <a href="edit_anggota_kk.php?id=<?= $row['id']; ?>">Edit</a> |
                            <a href="delete_anggota_kk.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada anggota keluarga.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
