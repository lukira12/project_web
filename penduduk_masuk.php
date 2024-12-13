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

// Ambil data penduduk
$query = "SELECT * FROM penduduk_masuk";
$result = $conn->query($query);

// Tambah Penduduk Baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_penduduk'])) {
    $nik = $_POST['nik'];
    $no_kk = $_POST['no_kk'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $gol_darah = $_POST['gol_darah'];
    $agama = $_POST['agama'];
    $status_nikah = $_POST['status_nikah'];
    $status_keluarga = $_POST['status_keluarga'];
    $alamat_asal = $_POST['alamat_asal'];
    $rt_asal = $_POST['rt_asal'];
    $rw_asal = $_POST['rw_asal'];
    $provinsi_asal = $_POST['provinsi_asal'];

    $insertQuery = "INSERT INTO penduduk_masuk 
    (nik, no_kk, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, gol_darah, agama, status_nikah, status_keluarga, alamat_asal, rt_asal, rw_asal, provinsi_asal) 
    VALUES 
    ('$nik', '$no_kk', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$gol_darah', '$agama', '$status_nikah', '$status_keluarga', '$alamat_asal', '$rt_asal', '$rw_asal', '$provinsi_asal')";

    if ($conn->query($insertQuery) === TRUE) {
        header("Location: penduduk_masuk.php");
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk Masuk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="date"><?php echo date('l, F d, Y'); ?></div>
        <div class="user">
            <div class="dropdown">
                <div class="user-profile">
                    <img src="icon/user_15194213.png" alt="Profile Picture">
                    <span>Admin</span>
                </div>
                <div class="dropdown-content">
                    <a href="profile.php"><i class="fas fa-user"></i> Profil</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="title">Data Penduduk Masuk</div>

        <!-- Form Tambah Penduduk -->
        <div class="form-container">
            <form method="POST">
                <h3>Tambah Penduduk</h3>
                <label for="nik">NIK:</label>
                <input type="text" name="nik" id="nik" maxlength="16" required>
                <label for="no_kk">No KK:</label>
                <input type="text" name="no_kk" id="no_kk" maxlength="20" required>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" required>
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
                <label for="gol_darah">Golongan Darah:</label>
                <select name="gol_darah" id="gol_darah" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
                <label for="agama">Agama:</label>
                <select name="agama" id="agama" required>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
                <label for="status_nikah">Status Nikah:</label>
                <select name="status_nikah" id="status_nikah" required>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Cerai">Cerai</option>
                </select>
                <label for="status_keluarga">Status Keluarga:</label>
                <select name="status_keluarga" id="status_keluarga" required>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Anggota Keluarga">Anggota Keluarga</option>
                </select>
                <label for="alamat_asal">Alamat Asal:</label>
                <textarea name="alamat_asal" id="alamat_asal" required></textarea>
                <label for="rt_asal">RT Asal:</label>
                <input type="number" name="rt_asal" id="rt_asal" required>
                <label for="rw_asal">RW Asal:</label>
                <input type="number" name="rw_asal" id="rw_asal" required>
                <label for="provinsi_asal">Provinsi Asal:</label>
                <input type="text" name="provinsi_asal" id="provinsi_asal" required>
                <button type="submit" name="add_penduduk">Tambah</button>
            </form>
        </div>

        <!-- Tabel Penduduk -->
        <div class="table-container">
            <h3>Daftar Penduduk</h3>
            <table>
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['nik']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['jenis_kelamin']; ?></td>
                                <td><?php echo $row['tempat_lahir']; ?></td>
                                <td><?php echo $row['tanggal_lahir']; ?></td>
                                <td><?php echo $row['agama']; ?></td>
                                <td><?php echo $row['rt_asal']; ?></td>
                                <td><?php echo $row['rw_asal']; ?></td>
                                <td>
                                    <a href="edit_penduduk.php?id=<?php echo $row['nik']; ?>">Edit</a>
                                    <a href="delete_penduduk.php?id=<?php echo $row['nik']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Tidak ada data penduduk</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
