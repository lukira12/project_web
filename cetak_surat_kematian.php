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

// Ambil data dari form
if (isset($_POST['kematian_id'])) {
    $kematian_id = $_POST['kematian_id'];

    // Ambil data kematian berdasarkan ID
    $query = "SELECT * FROM kematian WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $kematian_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Kematian tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Keterangan Kematian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 5px;
        }

        h1, h2 {
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PEMERINTAH KABUPATEN KARAWANG</h1>
        <h1>KANTOR KECAMATAN KLARI</h1>
        <h2>SURAT KETERANGAN KEMATIAN</h2>
        <hr>

        <p>Yang bertanda tangan di bawah ini, Kepala Desa [Nama Desa], Kecamatan [Nama Kecamatan], Kabupaten [Nama Kabupaten], dengan ini menerangkan bahwa:</p>

        <table>
            <tr>
                <td><b>Nama</b></td>
                <td>: <?= $data['nama']; ?></td>
            </tr>
            <tr>
                <td><b>Tanggal Meninggal</b></td>
                <td>: <?= $data['tanggal_meninggal']; ?></td>
            </tr>
            <tr>
                <td><b>Sebab</b></td>
                <td>: <?= $data['sebab']; ?></td>
            </tr>
            <tr>
                <td><b>Alamat</b></td>
                <td>: <?= $data['alamat']; ?></td>
            </tr>
        </table>

        <p>Telah meninggal dunia pada tanggal tersebut di atas. Surat keterangan ini dibuat untuk keperluan yang bersangkutan.</p>

        <div class="signature">
            <p><b>[Nama camat]</b></p>
            <p>Kecamatan [Nama kecamatan]</p>
        </div>
    </div>

    <script>
        // Cetak otomatis saat halaman dibuka
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
