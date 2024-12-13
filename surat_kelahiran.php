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

// Ambil data kelahiran untuk dropdown
$query = "SELECT id, nama FROM kelahiran";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kelahiran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        select, button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color: #fff; background-color: #3498db; padding: 10px; border-radius: 5px;">Su-Ket Kelahiran</h2>
        <form action="cetak_surat_kelahiran.php" method="post">
            <div class="form-group">
                <label for="kelahiran">Kelahiran</label>
                <select name="kelahiran_id" id="kelahiran" required>
                    <option value="">- Pilih Data -</option>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Cetak</button>
        </form>
    </div>
</body>
</html>