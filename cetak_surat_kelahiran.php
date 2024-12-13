<?php
// Start session
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "project_web");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['kelahiran_id'];

    // Query untuk mendapatkan data berdasarkan ID
    $query = "SELECT * FROM kelahiran WHERE id = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Surat Keterangan Kelahiran</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    line-height: 1.6;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header h1 {
                    margin: 0;
                }
                .content {
                    margin-top: 20px;
                }
                .signature {
                    margin-top: 50px;
                    text-align: right;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Surat Keterangan Kelahiran</h1>
                <p>Sistem Informasi Administrasi Kependudukan</p>
            </div>
            <div class="content">
                <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>
                <table>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>: <?php echo htmlspecialchars($data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tempat, Tanggal Lahir</strong></td>
                        <td>: <?php echo htmlspecialchars($data['alamat']); ?>, <?php echo htmlspecialchars($data['tanggal_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Kelamin</strong></td>
                        <td>: <?php echo htmlspecialchars($data['jenis_kelamin']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Ayah</strong></td>
                        <td>: <?php echo htmlspecialchars($data['nama_ayah']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Ibu</strong></td>
                        <td>: <?php echo htmlspecialchars($data['nama_ibu']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>: <?php echo htmlspecialchars($data['alamat']); ?></td>
                    </tr>
                </table>
                <p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
            </div>
            <div class="signature">
                <p><strong>Pihak yang Bertanggung Jawab</strong></p>
                <p>______________________</p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Data tidak ditemukan!</p>";
    }
} else {
    header("Location: surat_kelahiran.php");
    exit;
}
?>
