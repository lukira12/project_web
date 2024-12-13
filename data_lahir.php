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

// Ambil data kelahiran dari database
$query = "SELECT * FROM kelahiran";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lahir</title>
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
        <h2>Data Lahir</h2>
        <a href="add_lahir.php" class="add-btn">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP loop untuk data -->
                <tr>
                    <td>1</td>
                    <td>Luki</td>
                    <td>2000-01-01</td>
                    <td>Laki-laki</td>
                    <td>Dadang</td>
                    <td>Cucu</td>
                    <td>Jl. Kebon</td>
                    <td>
                        <a href="edit_lahir.php?id=1">Edit</a> |
                        <a href="delete_lahir.php?id=1" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="actions">
            <a href="dashboard.php" class="back-btn">Kembali</a>
        </div>
    </div>
</body>
</html>
