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

// Ambil data berdasarkan ID yang dipilih
if (isset($_POST['domisili_id'])) {
    $domisili_id = $_POST['domisili_id'];
    $query = "SELECT * FROM domisili WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $domisili_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Keterangan Domisili</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            text-transform: uppercase;
        }

        .content {
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Surat Keterangan Domisili</h1>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa/Kelurahan, menerangkan bahwa:</p>
            <table>
                <tr>
                    
                    <td><strong>Nama</strong></td>
                    <td>: <?= $data['nama']; ?></td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>: <?= $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td><strong>NIK</strong></td>
                    <td>: <?= $data['nik']; ?></td>
                </tr>
                <tr>
                    <td><strong>Keperluan</strong></td>
                    <td>: <?= $data['keperluan']; ?></td>
                </tr>
            </table>
            <p>Adalah benar berdomisili di alamat tersebut di atas sesuai dengan data yang ada pada kami.</p>
            <p>Demikian surat keterangan ini dibuat agar dapat digunakan sebagaimana mestinya.</p>
        </div>
        <div class="footer">
            <p>KARAWANG, <?= date('d-m-Y'); ?></p>
            <p><strong>CAMAT</strong></p>
            <br><br><br>
            <p><strong>(NAMA CAMAT)</strong></p>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
