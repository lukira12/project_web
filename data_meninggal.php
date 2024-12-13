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

// Ambil data kematian dari database
$query = "SELECT * FROM kematian";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kematian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .add-btn, .back-btn {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }

        .back-btn {
            background-color: #95a5a6;
            margin-left: 10px;
        }

        .add-btn:hover {
            background-color: #27ae60;
        }

        .back-btn:hover {
            background-color: #7f8c8d;
        }

        .actions {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Kematian</h2>
        <a href="add_kematian.php" class="add-btn">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Meninggal</th>
                    <th>Sebab</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil data dari database
                $conn = new mysqli("localhost", "root", "", "project_web");
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                $query = "SELECT * FROM kematian";
                $result = $conn->query($query);

                if ($result->num_rows > 0):
                    $no = 1;
                    while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['tanggal_meninggal']; ?></td>
                        <td><?= $row['sebab']; ?></td>
                        <td>
                            <a href="edit_kematian.php?id=<?= $row['id']; ?>">Edit</a> |
                            <a href="delete_kematian.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                <?php
                endif;
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="actions">
            <a href="dashboard.php" class="back-btn">Kembali</a>
        </div>
    </div>
</body>
</html>
