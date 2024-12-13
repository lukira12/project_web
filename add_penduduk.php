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

// Proses data form ketika tombol submit diklik
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $no_kk = $_POST['no_kk']; // Perbaikan name="no_kk"
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $desa = $_POST['desa'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $alamat = $_POST['alamat']; // Perbaikan name="alamat"
    $agama = $_POST['agama'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $pekerjaan = $_POST['pekerjaan'];

    // Query Insert
    $sql = "INSERT INTO penduduk_masuk 
            (nik, no_kk, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, desa, rt, rw, alamat, agama, status_perkawinan, pekerjaan) 
            VALUES 
            ('$nik', '$no_kk', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$desa', '$rt', '$rw', '$alamat', '$agama', '$status_perkawinan', '$pekerjaan')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href = 'penduduk.php';</script>";
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
    <title>Tambah Data Penduduk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Data Penduduk</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" id="nik" name="nik" required>
            </div>
            <div class="form-group">
                <label for="no_kk">No KK</label> <!-- Perbaikan name -->
                <input type="text" id="no_kk" name="no_kk" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="desa">Desa</label>
                <input type="text" id="desa" name="desa" required>
            </div>
            <div class="form-group">
                <label for="rt_rw">RT/RW</label>
                <div style="display: flex; gap: 10px;">
                    <input type="number" id="rt" name="rt" placeholder="RT" required>
                    <input type="number" id="rw" name="rw" placeholder="RW" required>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label> <!-- Perbaikan name -->
                <input type="text" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="agama">Agama</label>
                <input type="text" id="agama" name="agama" required>
            </div>
            <div class="form-group">
                <label for="status_perkawinan">Status Perkawinan</label>
                <select id="status_perkawinan" name="status_perkawinan" required>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Cerai">Cerai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" id="pekerjaan" name="pekerjaan" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
